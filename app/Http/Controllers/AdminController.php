<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
// use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Agenda;
use App\Models\Barang;
use App\Models\Diskon;
use App\Models\Forgot;
use App\Models\Kurasi;
use App\Models\Pembinaan;
use App\Models\User;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        Carbon::setLocale('id');
        $this->now = config('Custom_UNS.now');
        $this->today = config('Custom_UNS.today');
        $this->yesterday = config('Custom_UNS.yesterday');
    }

    public function index()
    {
        $now = $this->now;
        $partial = 'dashboard';
        $active = '';

        $counts = array();
        /* counts */
        $c_pedagang = User::select('id');
        $c_pedagang_all = $c_pedagang->count();
        $c_pedagang_on = $c_pedagang->where('aktif', 'yes')->count();

        $c_kurasi = Kurasi::select('id');
        $c_kurasi_all = $c_kurasi->count();
        $c_kurasi_new = $c_kurasi->whereNull('kurator_markethub')->count();

        $c_forgot = Forgot::select('id');
        $c_forgot_all = $c_forgot->count();
        $c_forgot_new = $c_forgot->where('status', 1)->count();

        $c_discount = Diskon::select('id');
        $c_discount_all = $c_discount->count();
        $c_discount_active = Diskon::Join('uns_produk_umkm', 'uns_produk_umkm.id', 'uns_diskon.id_produk')
        ->rightjoin('uns_kurasi_main','uns_kurasi_main.id_produk','uns_produk_umkm.id')
        ->where('uns_kurasi_main.id_status_kurasimarkethub', '1')->select('uns_produk_umkm.id')->count();

        $c_agenda = Agenda::select('id');
        $c_agenda_all = $c_agenda->count();
        $c_agenda_active = $c_agenda->where('waktu_mulai', '<=', $now)->where('waktu_selesai', '>=', $now)->count();
        $counts = [
            "dagang_all"        => $c_pedagang_all,
            "dagang_on"         => $c_pedagang_on,
            "kur_all"           => $c_kurasi_all,
            "kur_new"           => $c_kurasi_new,
            "forgot_all"        => $c_forgot_all,
            "forgot_new"        => $c_forgot_new,
            "discount_all"      => $c_discount_all,
            "discount_active"   => $c_discount_active,
            "agenda_all"        => $c_agenda_all,
            "agenda_active"     => $c_agenda_active
        ];

        // dd($counts, $counts["ped_all"]);

        /* counts end */
        return view('admin.index-admin', compact('now', 'partial', 'counts', 'active'));
    }

    public function login()
    {
        return view('login-admin');
    }

    public function post_login(Request $request)
    {
        $request->validate([
            'nama'  =>  'required',
            'password'  =>  'required',
        ]);
        if (Auth::guard('webadmin')->attempt($request->only(['nama', 'password']))) {
            $request->session()->regenerate();
            return redirect(route('index-admin'));
            // ->intended('index-admin')
        } else {
            return back()->with('loginError', 'ID atau Password Salah');
        }

        // return view('index');
    }

    // public function pedagang_list(){
    // $today = $this->today;
    // $partial = 'pedagang_list';
    // return view('admin.index-admin',compact('today','partial'));
    // }

    public function forgot_list(Request $req)
    {
        $today = $this->today;
        $partial = 'forgot_list';
        $active = 'user';

        $show = 24;
        if (!empty($req->show)) {
            $show = $req->show;
        }
        if ($show > 32) {
            $show = 32;
        }
        
        $data_raw = Forgot::join('data_usaha', 'data_usaha.idsibakul', 'uns_lupa_password.idsibakul')
            ->join('uns_status_lupa', 'uns_status_lupa.id', 'uns_lupa_password.status')
            ->select(
                'data_usaha.idsibakul',
                'data_usaha.no_hp',
                'uns_lupa_password.status',
                'uns_status_lupa.status as status_str',
                'uns_lupa_password.link',
                'uns_lupa_password.updated_at',
                'uns_lupa_password.created_at',
                'uns_lupa_password.id'
            );

            $status = 'empty';
            $empty = '';
            $active_fr = '';
            $sent = '';
            $changed = '';
            $expired = '';
    
            switch ($req->status) {
                case 'empty';
                    $status = 'empty';
                    $empty = 'selected';
                    break;
                case 'active';
                    $status = 'active';
                    $active_fr = 'selected';
                    break;
                case 'sent':
                    $status = "sent";
                    $sent = 'selected';
                    break;
                case 'changed':
                    $status = "changed";
                    $changed = 'selected';
                    break;
                case 'expired';
                    $status = 'expired';
                    $expired = 'selected';
                    break;
                default:
                    $status = 'empty';
                    $empty = 'selected';
            }
            if ($status != 'empty') {
                $data_raw = $data_raw->where('uns_status_lupa.status', $status);
            }
        $search = '';
        if (!empty($req->search)) {
            $search = $req->search;
            $data_raw = $data_raw->where(fn ($query) => $query
                ->where('uns_produk_umkm.nama', 'LIKE', "%" . $search . "%")
                ->orWhere('uns_produk_umkm.idsibakul', 'LIKE', '%' . $search . '%')
                ->orWhere('uns_produk_umkm.verifikator', 'LIKE', '%' . $search . '%')
                ->orWhere('uns_kurasi_main.kurator_markethub', 'LIKE', '%' . $search . '%')
                ->orWhere('uns_kurasi_main.catatan_kurasimarkethub', 'LIKE', '%' . $search . '%'));
        }
        $data = $data_raw->orderBy('uns_lupa_password.updated_at', 'desc')->paginate(10);
        $status = db::table('uns_status_lupa')->get();
        return view('admin.index-admin', compact('today', 'partial', 'data', 'status', 'active','empty','active_fr','sent', 'changed','expired', 'search','show'));
    }

    public function sent($id)
    {
        $data = Forgot::where('id', $id)->first();
        $text = rawurlencode('permintaan reset password anda telah kami terima. Silahkan buka laman ini untuk melanjutkan ' . $data->link);

        $forgot           = Forgot::find($id);
        $forgot->status   = 2;
        $forgot->save();

        return redirect('https://api.whatsapp.com/send?phone=' . $data->no_hp . '&text=' . $text . '');
    }

    public function kurasi_list(Request $request)
    {
        // $today = $this->today;
        $yesterday = $this->yesterday;
        $partial = 'kurasi_list';
        $active = 'barang';
        $page = $request->page;
        if (empty($request->status)) {
            $status = 'proses';
        } else {
            $status = $request->status;
        }

        $take = 24;
        if (!empty($request['take'])) {
            $take = $request['take'];
        }
        if ($take > 32) {
            $take = 32;
        }


        $data_raw = Barang::leftjoin('data_usaha', 'data_usaha.idsibakul', 'uns_produk_umkm.idsibakul')
            ->leftjoin('uns_kurasi_main', 'uns_kurasi_main.id_produk', 'uns_produk_umkm.id')
            ->Join('uns_status_kurasi', 'uns_status_kurasi.id_status_kurasi', 'uns_kurasi_main.id_status_kurasimarkethub')
            ->leftJoin('uns_kurasireq_berat','uns_kurasireq_berat.id_kurasi','uns_kurasi_main.id_kurasi')    
            ->leftJoin('uns_kurasireq_deskripsi','uns_kurasireq_deskripsi.id_kurasi','uns_kurasi_main.id_kurasi')    
            ->leftJoin('uns_kurasireq_foto','uns_kurasireq_foto.id_kurasi','uns_kurasi_main.id_kurasi')    
            ->leftJoin('uns_kurasireq_harga','uns_kurasireq_harga.id_kurasi','uns_kurasi_main.id_kurasi')    
            ->leftJoin('uns_kurasireq_judul','uns_kurasireq_judul.id_kurasi','uns_kurasi_main.id_kurasi')    
            ->select(
                'uns_produk_umkm.*', 'uns_kurasi_main.*','uns_status_kurasi.*','uns_kurasireq_berat.weight_isset',
                'uns_kurasireq_deskripsi.deskripsi_jelas','uns_kurasireq_foto.foto_bagus','uns_kurasireq_harga.harga_isset',
                'uns_kurasireq_judul.judul_sesuai');

        $filter = '';
        if (!empty($request['filter'])) {
            $filter = $request->filter;
            $data_raw = $data_raw->where(fn ($query) => $query
                ->where('uns_produk_umkm.nama', 'LIKE', "%" . $filter . "%")
                ->orWhere('uns_produk_umkm.idsibakul', 'LIKE', '%' . $filter . '%')
                ->orWhere('uns_produk_umkm.verifikator', 'LIKE', '%' . $filter . '%')
                ->orWhere('uns_kurasi_main.kurator_markethub', 'LIKE', '%' . $filter . '%')
                ->orWhere('uns_kurasi_main.catatan_kurasimarkethub', 'LIKE', '%' . $filter . '%'));
        }

        if ($status == 'terjawab') {
            $data_raw = $data_raw->whereNotNull('kurator_markethub')->where('kurator_markethub', '!=', '')
                ->orwhere('id_status_kurasimarkethub', '1')->orderBy('uns_produk_umkm.waktu_catat', 'desc');
        } else {
            $data_raw = $data_raw->where(static function ($query) {
                $query->whereNull('kurator_markethub')
                    ->orWhere('kurator_markethub', '');
            })->where('id_status_kurasimarkethub', '4')->orderBy('uns_produk_umkm.waktu_catat', 'asc');
        }
        $data = $data_raw->distinct('uns_kurasi_main.id_kurasi')->paginate($take)->onEachSide(0);
        // dd($data);
        // dd($data_raw->where('id_kurasi')->get());
        return view('admin.index-admin', compact('partial', 'data', 'active', 'status', 'yesterday', 'filter', 'take', 'page'));
    }

    public function diskon_list(Request $request)
    {
        $yesterday = $this->yesterday;
        $partial = 'diskon_list';
        $active = 'barang';

        $take = 24;
        if (!empty($request['take'])) {
            $take = $request['take'];
        }
        if ($take > 32) {
            $take = 32;
        }

        $data_raw = Barang::rightjoin('uns_diskon', 'uns_diskon.id_produk', 'uns_produk_umkm.id')
            // ->leftjoin('uns_kurasi_main', 'uns_kurasi_main.id_produk', 'uns_produk_umkm.id')
            // ->leftJoin('uns_kurasireq_berat','uns_kurasireq_berat.id_kurasi','uns_kurasi_main.id_kurasi')    
            // ->leftJoin('uns_kurasireq_deskripsi','uns_kurasireq_deskripsi.id_kurasi','uns_kurasi_main.id_kurasi')    
            // ->leftJoin('uns_kurasireq_foto','uns_kurasireq_foto.id_kurasi','uns_kurasi_main.id_kurasi')    
            // ->leftJoin('uns_kurasireq_harga','uns_kurasireq_harga.id_kurasi','uns_kurasi_main.id_kurasi')    
            // ->leftJoin('uns_kurasireq_judul','uns_kurasireq_judul.id_kurasi','uns_kurasi_main.id_kurasi')   
            // ->select('uns_produk_umkm.*', 'uns_diskon.*', 'uns_kurasi_main.*');
            ->select('uns_produk_umkm.*', 'uns_diskon.*');

        $filter = '';
        if (!empty($request['filter'])) {
            $filter = $request->filter;
            $data_raw = $data_raw->where(fn ($query) => $query
                ->where('uns_produk_umkm.nama', 'LIKE', "%" . $filter . "%")
                ->orWhere('uns_diskon.nama_diskon', 'LIKE', '%' . $filter . '%')
                ->orWhere('uns_diskon.nominal', 'LIKE', '%' . $filter . '%')
                // ->orWhere('uns_kurasi_main.kurator_markethub', 'LIKE', '%' . $filter . '%')
                // ->orWhere('uns_kurasi_main.catatan_kurasimarkethub', 'LIKE', '%' . $filter . '%')
                // ->orWhere('uns_kurasi_main.status', 'LIKE', '%' . $filter . '%')
            );
        }

        $data = $data_raw->paginate($take)->onEachSide(0);

        return view('admin.index-admin', compact('partial', 'data', 'active', 'yesterday', 'filter', 'take'));
    }

    public function pedagang_list(Request $q)
    {
        // if(empty($q['page']) || $q['page'] == 0){
        //     $page = 1;
        // } else {
        //     $page = $q['page'];
        // }
        $today = $this->today;
        $partial = 'pedagang_list';
        $active = 'user';

        if (empty($q['show']) || $q['show'] == 0) {
            $show = 24;
        } else {
            $show = $q['show'];
            if ($show > 32) {
                $show == 32;
            }
        }

        if (empty($q['search'])) {
            $search = '';
        } else {
            $search = $q['search'];
        }

        // dd($q['page']);
        $status = 'empty';
        $empty = '';
        $test_accounts = '';
        $diterima = '';
        $ditolak = '';
        $ajuan = '';
        $disabled = '';

        switch ($q['status']) {
            case 'empty';
                $status = 'empty';
                $empty = 'selected';
                break;
            case 'test accounts';
                $status = 'test accounts';
                $test_accounts = 'selected';
                break;
            case 'diterima':
                $status = "diterima";
                $diterima = 'selected';
                $disabled = 'disabled';
                break;
            case 'ditolak':
                $status = "ditolak";
                $ditolak = 'selected';
                $disabled = 'disabled';
                break;
            case 'pengajuan';
                $status = 'pengajuan';
                $ajuan = 'selected';
                break;
            default:
                $status = 'empty';
                $empty = 'selected';
        }

        $data_raw = User::leftjoin('uns_verification', 'data_usaha.id', 'uns_verification.id_data_usaha')
            ->select('data_usaha.*', 'uns_verification.verified', 'uns_verification.catatan_verifikasi')->orderBy('waktu', 'desc');
        if (!empty($search)) {
            $data_raw = $data_raw->where(fn ($query) => $query->where('idsibakul', 'LIKE', "%" . $search . "%")
                ->orWhere('nama_usaha', 'LIKE', "%" . $search . "%")
                ->orWhere('merkdagang', 'LIKE', "%" . $search . "%")
                ->orWhere('nama_lengkap', 'LIKE', "%" . $search . "%")
                ->orWhere('alamat_ktp', 'LIKE', "%" . $search . "%"));
            // $lastid = $data_raw->orderBy('id', 'desc')->first();
            // dd($data);
        }

        if ($status != 'empty') {
            $data_raw = $data_raw->where('verified', $status)->whereNotNull('verified');
        }

        $data = $data_raw->paginate($show)->onEachSide(0);
        // dd($test_accounts, $status);
        // dd($max_page);
        return view(
            'admin.index-admin',
            compact(
                'today',
                'partial',
                'active',
                'data',
                'search',
                'show',
                'status',
                'diterima',
                'ditolak',
                'ajuan',
                'empty',
                'test_accounts',
                'disabled'
            )
        );
    }

    public function agenda_list(Request $q)
    {
        Carbon::setLocale('id');
        $today = $this->today;
        $now = $this->now;
        $partial = 'agenda_list';
        $active = 'event';
        $data_raw = Agenda::leftJoin('uns_ikut_agenda', 'uns_ikut_agenda.id_agenda', 'uns_agenda.id_agenda')
            ->select('uns_agenda.*', 'uns_ikut_agenda.id_pedagang', 'uns_ikut_agenda.date_created as join_date')
            ->orderBy('uns_agenda.date_created','desc')
            ;
        if (empty($q['show']) || $q['show'] == 0) {
            $show = 24;
        } else {
            $show = $q['show'];
            if ($show > 32) {
                $show == 32;
            }
        }

        if (empty($q['search'])) {
            $search = '';
        } else {
            $search = $q['search'];
        }

        $status = 'empty';
        $empty = '';
        $future = '';
        $history = '';
        switch ($q['status']) {
            case 'empty';
                $status = 'empty';
                $empty = 'selected';
                break;
            case 'future';
                $status = 'future';
                $future = 'selected';
                break;
            case 'history':
                $status = 'history';
                $history = 'selected';
                break;
            case 'active':
                $status = 'active';
                $active = 'selected';
                break;
            default:
                $status = 'empty';
                $empty = 'selected';
                break;
        }

        switch ($status) {
            case 'future':
                $data_raw = $data_raw->where('waktu_mulai', '>', $now);
                break;
            case 'active':
                $data_raw = $data_raw->where('waktu_mulai', '<=', $now)->where('waktu_selesai', '>=', $now);
                break;
            case 'history':
                $data_raw = $data_raw->where('waktu_selesai', '<', $now);
                break;
            default:
                break;
        }


        if (!empty($search)) {
            $data_raw = $data_raw->where(fn ($query) => $query
                ->where('nama_agenda', 'LIKE', "%" . $search . "%")
                ->orWhere('deskripsi', 'LIKE', "%" . $search . "%")
                ->orWhere('lokasi', 'LIKE', "%" . $search . "%")
                ->orWhere('nama_kontak_person', 'LIKE', "%" . $search . "%")
                ->orWhere('kontak', 'LIKE', "%" . $search . "%"));
            // $lastid = $data_raw->orderBy('id', 'desc')->first();
        }

        $data = $data_raw->paginate($show)->onEachSide(0);
        // dd($data);
        return view(
            'admin.index-admin',
            compact('today', 'partial', 'active', 'search', 'data', 'show', 'status', 'empty', 'history', 'future', 'active')
        );
    }

    public function pembinaan_list(Request $q)
    {
        $today = $this->today;
        $now = $this->now;
        $partial = 'pembinaan_list';
        $active = 'event';
        $data_raw = Pembinaan::leftJoin('uns_log_pembinaan', 'uns_log_pembinaan.id_pembinaan', 'uns_pembinaan.id_pembinaan')
            ->select('uns_pembinaan.*', 'uns_log_pembinaan.id_data_usaha', 'uns_log_pembinaan.date_created');
        if (empty($q['show']) || $q['show'] == 0) {
            $show = 24;
        } else {
            $show = $q['show'];
            if ($show > 32) {
                $show == 32;
            }
        }

        if (empty($q['search'])) {
            $search = '';
        } else {
            $search = $q['search'];
        }

        $status = 'empty';
        $empty = '';
        $daring = '';
        $luring = '';
        switch ($q['jenis']) {
            case 'daring';
                $status = 'daring';
                $daring = 'selected';
                break;
            case 'luring';
                $status = 'luring';
                $luring = 'selected';
                break;
            default:
                $status = 'empty';
                $empty = 'selected';
                break;
        }

        if ($status != 'empty') {
            $data_raw = $data_raw->where('jenis', $status);
        }



        if (!empty($search)) {
            $data_raw = $data_raw->where(fn ($query) => $query
                ->where('judul', 'LIKE', "%" . $search . "%")
                ->orWhere('lampiran', 'LIKE', "%" . $search . "%")
                ->orWhere('waktu_mulai', 'LIKE', "%" . $search . "%")
                ->orWhere('waktu_selesai', 'LIKE', "%" . $search . "%")
                ->orWhere('lokasi', 'LIKE', "%" . $search . "%")
                ->orWhere('detail', 'LIKE', "%" . $search . "%"));
            // $lastid = $data_raw->orderBy('id', 'desc')->first();
            // dd($data);
        }

        $data = $data_raw->paginate($show)->onEachSide(0);

        return view(
            'admin.index-admin',
            compact('today', 'partial', 'active', 'search', 'data', 'show', 'status', 'empty', 'luring', 'daring', 'active')
        );
    }
}
