<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kurasi;
use App\Models\Diskon;
use Carbon\Carbon;


class barangController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        // Carbon::setLocale('id');
        $this->now = config('Custom_UNS.now');
        $this->today = config('Custom_UNS.today');
        $this->yesterday = config('Custom_UNS.yesterday');
    }
    public function index(Request $req)
    {
        $status = db::table('uns_maintenance')->orderby('id', 'DESC')->first();
        $admin = db::table('uns_akses')->where('id_sibakul', auth()->user()->idsibakul)->get();
        $profil = db::table('data_usaha')
            ->where('data_usaha.idsibakul', auth()->user()->idsibakul)
            ->first();
        $id_status_kurasi = db::table('uns_status_kurasi')->get();
        $produk_raw = barang::where('uns_produk_umkm.idsibakul', auth()->user()->idsibakul)
            ->leftjoin('uns_kurasi_main', 'uns_kurasi_main.id_produk', 'uns_produk_umkm.id')
            ->leftJoin('uns_status_kurasi', 'uns_status_kurasi.id_status_kurasi', 'uns_kurasi_main.id_status_kurasimarkethub')
            ->leftjoin('uns_diskon', 'uns_diskon.id_produk', 'uns_produk_umkm.id')
            ->leftjoin('uns_jenis_produk', 'uns_produk_umkm.jenis', 'uns_jenis_produk.id_jenis')
            // ->orderby('uns_kurasi_main.id_kurasi','desc')
            ->select('uns_kurasi_main.catatan_kurasimarkethub', 'uns_kurasi_main.kurator_markethub', 'uns_kurasi_main.id_produk',
            'uns_diskon.nama_diskon', 'uns_diskon.nominal', 'uns_produk_umkm.*','uns_status_kurasi.status_kurasi', 
            'uns_status_kurasi.detail_status_kurasi', 'uns_kurasi_main.id_status_kurasimarkethub');

        //filter by status if set
        // $filter = 'empty';
        $filter = 'empty';

        if(!empty($req->filter)){
            $filter = $req->filter; 
        }

        if ($filter != 'empty') {
            $produk_raw = $produk_raw->where('uns_produk_umkm.id_status_kurasimarkethub', $filter);
        }

        // filter by keyword if set
        $search = '';
        if (!empty($req->search)) {
            $search = $req->search;
            $produk_raw = $produk_raw->where(fn ($query) => $query
                ->where('uns_produk_umkm.nama', 'LIKE', "%" . $search . "%")
                ->orWhere('uns_produk_umkm.deskripsi_produk', 'LIKE', '%' . $search . '%')
                ->orWhere('uns_produk_umkm.harga', 'LIKE', '%' . $search . '%')
                ->orWhere('uns_jenis_produk.jenis', 'LIKE', '%' . $search . '%')
                ->orWhere('uns_diskon.nama_diskon', 'LIKE', '%' . $search . '%'));
        }
        
        // show discount only if true
        $diskon = '';
        if($req->diskon){
            $diskon = 'autocompleted';
            $produk_raw = $produk_raw->whereNotNull('uns_diskon.nominal');
        }

        //set how many data shown in page based on form
        $show = 8;
        if (!empty($req->show)) {
            $show = $req->show;
        }
        if ($show > 16) {
            $show = 16;
        }
        \DB::statement("SET SQL_MODE=''");
        $produk = $produk_raw
        ->orderBy("uns_kurasi_main.id_kurasi", 'desc')
        // ->from(DB::raw('(SELECT * FROM uns_kurasi_main ORDER BY id_kurasi DESC) uns_produk_umkm'))
        // ->distinct(['uns_produk_umkm.id','uns_kurasi_main.id_produk','uns_diskon.id_produk' ])
        ->get()
        ->groupBy('id');
        // ->paginate($show);
        // dd($produk);
        return view('daganganku', 
        compact('status', 'admin', 'profil', 'show', 'produk', 'search', 'diskon', 'id_status_kurasi', 'filter'));
    }

    public function tambah_dagangan()
    {
        $back = 'daganganku';
        $data = '';
        $status = db::table('uns_maintenance')->orderby('id', 'DESC')->first();
        $admin = db::table('uns_akses')->where('id_sibakul', auth()->user()->idsibakul)->get();
        $jenis = db::table('uns_jenis_produk')->get()->except(0);
        return view('dagangan-tambah', compact('status', 'admin', 'back', 'jenis'));
    }

    public function edit_barang($id)
    {
        $back = 'daganganku';
        // $olddata = Barang::where('id', $id)->first();
        $status = db::table('uns_maintenance')->orderby('id', 'DESC')->first();
        $admin = db::table('uns_akses')->where('id_sibakul', auth()->user()->idsibakul)->get();
        $data = db::table('uns_produk_umkm')->where('id', $id)->first();
        $jenis = db::table('uns_jenis_produk')->get()->except(0);
        // dd($data);
        return view('dagangan-tambah', compact('status', 'admin', 'id', 'data', 'back', 'jenis'));
    }

    public function post_barang($id, Request $request)
    {
        Carbon::setLocale('id');
        $now = $this->now;
        if ($id == 'new') {
            $idnew = '';
            $request->validate([
                'foto'  =>  'required',
                'nama_produk'  =>  'required',
                'jenis_produk' => 'required',
                'deskripsi' => 'required',
                'harga' => 'required',
                'stok' => 'required',
                'foto_detail_1' => 'nullable',
                'foto_detail_2' => 'nullable',
                'foto_detail_3' => 'nullable',
                'berat' => 'required',
                'panjang' => 'nullable',
                'lebar' => 'nullable',
                'tinggi' => 'nullable'
            ]);
        } else {
            $idnew = $id;
            $request->validate([
                'foto'  =>  'nullable',
                'nama_produk'  =>  'nullable',
                'jenis_produk' => 'nullable',
                'deskripsi' => 'nullable',
                'harga' => 'nullable',
                'stok' => 'nullable',
                'foto_detail_1' => 'nullable',
                'foto_detail_2' => 'nullable',
                'foto_detail_3' => 'nullable',
                'berat' => 'nullable',
                'panjang' => 'nullable',
                'lebar' => 'nullable',
                'tinggi' => 'nullable'
            ]);
            $oldata = Barang::where('id', $id)->first();
        }

        if(!empty($request->file('foto'))){
            $FotoName = auth()->user()->idsibakul . "_" . time() . '_' . request()->foto->getClientOriginalName();
            $destination = '../files';
            $request->file('foto')->move($destination, $FotoName);    
        } elseif(!empty($oldata) && empty($request->file('foto'))) {
            $FotoName = $oldata->produk_foto;
        } 

        if (!empty($request->foto_detail_1)) {
            $Foto1 = auth()->user()->idsibakul . "_" . time() . '_' . request()->foto_detail_1->getClientOriginalName();
            $request->file('foto_detail_1')->move($destination, $Foto1);
        } elseif(!empty($oldata) && empty($request->foto_detail_1)) {
            $Foto1 = $oldata->foto_1;
        } else {
            $Foto1 = $request->foto_detail_1;
        }

        if (!empty($request->foto_detail_2)) {
            $Foto2 = auth()->user()->idsibakul . "_" . time() . '_' . request()->foto_detail_2->getClientOriginalName();
            $request->file('foto_detail_2')->move($destination, $Foto2);
        } elseif(!empty($oldata)&& empty($request->foto_detail_2)) {
            $Foto2 = $oldata->foto_2;
        } else {
            $Foto2 = $request->foto_detail_2;
        }

        if (!empty($request->foto_detail_3)) {
            $Foto3 = auth()->user()->idsibakul . "_" . time() . '_' . request()->foto_detail_3->getClientOriginalName();
            $request->file('foto_detail_3')->move($destination, $Foto3);
        } elseif(!empty($oldata)&& empty($request->foto_detail_3)) {
            $Foto3 = $oldata->foto_3;
        } else {
            $Foto3 = $request->foto_detail_3;
        }

        if(!empty($request->nama_produk)){
            $nama_produk = $request->nama_produk;
        } else {
            $nama_produk = $oldata->nama;
        }

        if(!empty($request->jenis_produk)){
            $jenis_produk = $request->jenis_produk;
        } else {
            $jenis_produk = $oldata->jenis;
        }

        if(!empty($request->deskripsi)){
            $deskripsi = $request->deskripsi;
        } else {
            $deskripsi = $oldata->deskripsi_produk;
        }

        if (!empty($request->harga)) {
            $harga = $request->harga;
        } else {
            $harga = $oldata->harga;
        }
        

        if (!empty($request->stok)) {
            $stok = $request->stok;
        } else {
            $stok = $oldata->stok;
        }

        if (!empty($request->berat)) {
            $berat = $request->berat;
        } else {
            $berat = $oldata->berat;
        }

        if (empty($request->panjang)) {
            $panjang = $oldata->panjang;
        } else {
            $panjang = $request->panjang;
        }

        if (empty($request->lebar)) {
            $lebar = $oldata->lebar;
        } else {
            $lebar = $request->lebar;
        }

        if (empty($request->panjang)) {
            $tinggi = $oldata->tinggi;
        } else {
            $tinggi = $request->tinggi;
        }

        // dd($request);
        $diskon = Barang::updateOrCreate(
            ['id' => $idnew],
            [
                'waktu_entry' => Carbon::now(),
                'waktu_update' => Carbon::now(),
                'idsibakul' => auth()->user()->idsibakul,
                'nama' => $nama_produk,
                'jenis' => $jenis_produk,
                'deskripsi_produk' => $deskripsi,
                'harga' => $harga,
                'stok' => $stok,
                'verifikator' => null,
                'tgl_verifikasi' => null,
                'produk_foto' => $FotoName,
                'foto_1' => $Foto1,
                'foto_2' => $Foto2,
                'foto_3' => $Foto3,
                'berat' => $berat,
                'panjang' => $panjang,
                'lebar' => $lebar,
                'tinggi' => $tinggi,
                'buatan_ukmdiy' => null,
                // 'lolos_kurasimarkethub' => 'Proses',
                'waktu_catat' => $now
            ]
        );
        $newest_id = Barang::where('waktu_catat',$now)->where('idsibakul', auth()->user()->idsibakul)->pluck('id')->first();
        // dd($newest_id);
        Kurasi::create([
            'id_produk'                 => $newest_id,
            'id_status_kurasimarkethub' => 5,
            'waktu_kurasimarkethub'     => $this->now
        ]);
        return redirect('daganganku')->with('warning', 'Data tersimpan!');
    }

    public function post_kurasiMarkethub($id)
    {
        Carbon::setLocale('id');
        Kurasi::create([
            'id_produk'         => $id,
            'id_status_kurasimarkethub'  => 4,
            'waktu_kurasimarkethub'      => $this->now
        ]);
        
        // $barang = Barang::where('id', $id)->first();
        // $barang->id_status_kurasimarkethub = 4;
        // $barang->save();
        return redirect('daganganku')->with('success', 'barang berhasil diajukan');
    }

    public function hapus_barang($id)
    {
        $barang = Barang::where('id', $id)->first();
        unlink('../files/' . $barang->produk_foto . '');
        Barang::where('id', $id)->delete();
        return redirect('daganganku')->with('warning', 'barang berhasil dihapus');
    }


    public function edit_diskon($id)
    {
        $status = db::table('uns_maintenance')->orderby('id', 'DESC')->first();
        $admin = db::table('uns_akses')->where('id_sibakul', auth()->user()->idsibakul)->get();
        $back = 'daganganku';
        $data = db::table('uns_diskon')->where('id_produk', $id)->first();
        // dd($data);
        return view('edit-diskon', compact('status', 'admin', 'id', 'data', 'back'));
    }

    public function hapus_diskon($id)
    {
        Diskon::where('id_produk', $id)->delete();
        return redirect('daganganku')->with('warning', 'diskon berhasil dihapus');
    }

    public function post_diskon($id, Request $request)
    {
        $now = $this->now->addhours(7);
        $request->validate([
            'nama_diskon'  =>  'nullable',
            'nominal'  =>  'required',
        ]);
        // dd($request);
        $diskon = Diskon::updateOrCreate(
            ['id_produk' => $id],
            ['nama_diskon' => $request->nama_diskon, 'nominal' => $request->nominal, 'date_created' => $now]
        );
        return redirect('daganganku')->with('warning', 'diskon berhasil diubah');
    }

    public function nonaktifkan($id)
    {
        $paskas         = Barang::find($id);
        $paskas->status_produk  = 'tidak';
        $paskas->save();
        return redirect()->route('daganganku');
    }
    public function aktifkan($id)
    {
        $paskas         = Barang::find($id);
        $paskas->status_produk  = 'tampil';
        $paskas->save();
        return redirect()->route('daganganku');
    }
    public function history_kurasi(Request $q, $id){
        $status_f = null;
        $status = db::table('uns_maintenance')->orderby('id', 'DESC')->first();
        $data_raw = Kurasi::where('id_produk', $id)
        ->leftJoin('uns_status_kurasi', 'uns_status_kurasi.id_status_kurasi', 'uns_kurasi_main.id_status_kurasimarkethub')
        ->leftJoin('uns_kurasireq_berat','uns_kurasireq_berat.id_kurasi','uns_kurasi_main.id_kurasi')    
        ->leftJoin('uns_kurasireq_deskripsi','uns_kurasireq_deskripsi.id_kurasi','uns_kurasi_main.id_kurasi')    
        ->leftJoin('uns_kurasireq_foto','uns_kurasireq_foto.id_kurasi','uns_kurasi_main.id_kurasi')    
        ->leftJoin('uns_kurasireq_harga','uns_kurasireq_harga.id_kurasi','uns_kurasi_main.id_kurasi')    
        ->leftJoin('uns_kurasireq_judul','uns_kurasireq_judul.id_kurasi','uns_kurasi_main.id_kurasi');
        if(!empty($q->status_f)){
            $status_f = $q->status_f;
            $data_raw = $data_raw->where('uns_kurasi_main.id_status_kurasimarkethub', $status_f);
        }
        $data = $data_raw->distinct('uns_kurasi_main.id_kurasi')->paginate(8)->onEachSide(0);

        $status_k = DB::table('uns_status_kurasi')->get();
        return view('history_kurasi', compact('data', 'status','status_k', 'status_f'));
    }
}
