<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Periode;
use App\Models\Data_omset;
use App\Models\Data_omset_jenis;
use App\Models\Data_omset_kategori;
use App\Models\Legalitas_Usaha;
use App\Models\Model_Bisnis;
use Carbon\Carbon;

class dataController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $req)
    {
        $status = db::table('uns_maintenance')->orderby('id', 'DESC')->first();
        $admin = db::table('uns_akses')->where('id_sibakul', auth()->user()->idsibakul)->get();
        $data_usaha = DB::table('data_usaha')->where('id', auth()->user()->id)->first();
        $kota = DB::table('kota')->where('id', $data_usaha->id_kota)->first();
        $kecamatan = DB::table('kecamatan')->where('id', $data_usaha->id_kecamatan)->first();
        $kelurahan = DB::table('kelurahan')->where('id', $data_usaha->id_kelurahan)->first();
        $legalitas_usaha = DB::table('berkas_legalitasusaha')->where('iddatausaha', auth()->user()->id)
        ->join('berkas_jenisberkas', 'berkas_jenisberkas.id', 'berkas_legalitasusaha.idjenis')
        ->where('berkas_jenisberkas.kat', 'usaha')
        ->select('berkas_legalitasusaha.*', 'berkas_jenisberkas.jenis')
        ->get();
        $model_bisnis = DB::table('uns_model_bisnis')->where('idsibakul', auth()->user()->idsibakul)->first();
        // $data_omset = Data_omset::where('iddatausaha', auth()->user()->id)
        // ->where('idperiode', '!=', null)->orderBy('idperiode', 'DESC')
        // ->join('periode', 'periode.id', 'data_asetomset.idperiode')
        // ->select('data_asetomset.*','periode.periode_semester','periode.periode_tahun')
        // ->get();
        $data_omset = Data_omset::where('id_data_usaha', auth()->user()->id)
        ->leftjoin('uns_aset_omset_jenis','uns_aset_omset_jenis.id_jenis','uns_aset_omset.id_jenis')
        ->leftjoin('uns_aset_omset_kategori','uns_aset_omset_kategori.id_kategori','uns_aset_omset.id_kategori')
        ->orderBy('tanggal', 'DESC')
        ->paginate(8);
        $open = $req->open;
        // dd($req,$open);
        return view('lengkapi_data', 
        compact(
        'status', 'admin', 'data_usaha', 'kota', 'kecamatan', 'kelurahan', 'legalitas_usaha', 
        'model_bisnis', 'data_omset','open'));
    }

    public function ubah_data(Request $req, $data) {
        $status = db::table('uns_maintenance')->orderby('id', 'DESC')->first();
        $admin = db::table('uns_akses')->where('id_sibakul', auth()->user()->idsibakul)->get();
        if(($data == 'data_diri') || ($data == 'data_usaha') || ($data == 'koordinat_gps')) {
            $id = auth()->user()->id;
            $main_data = DB::table('data_usaha')->where('id', $id)->first();
        };
        if($data == 'legalitas_usaha') {
            $id = $req->id;
            $main_data = DB::table('berkas_legalitasusaha')->where('id', $id)->first();
        };
        if($data == 'model_bisnis') {
            $id = auth()->user()->id;
            $main_data = DB::table('uns_model_bisnis')->where('idsibakul', $id)->first();
        };
        if($data == 'data_omset') {
            $id = auth()->user()->id;
            // $main_data = DB::table('data_asetomset')->where('iddatausaha', $id)->first();
            $main_data = Data_omset::where('id_data_usaha', $id)->first();
        };
        $jenis_legalitas = DB::table('berkas_jenisberkas')->where('kat', 'usaha')->get();
        $kota = DB::table('kota')->get();
        return view('ubah_data', compact('status', 'admin', 'data', 'main_data', 'jenis_legalitas', 'kota', 'id'));
    }

    public function tambah_data($data, Request $request) {
        $status = db::table('uns_maintenance')->orderby('id', 'DESC')->first();
        $admin = db::table('uns_akses')->where('id_sibakul', auth()->user()->idsibakul)->get();
        $id = '';
        if($data == 'legalitas_usaha') {
            $jenis_legalitas = DB::table('berkas_jenisberkas')->where('kat', 'usaha')->get();
            return view('ubah_data', compact('status', 'admin', 'data', 'jenis_legalitas', 'id'));
        } elseif($data == 'data_omset'){
            $omset = null;
            $jenis = Data_omset_jenis::all();
            $kategori = Data_omset_kategori::all();
            if(!empty($request->id)){
                $id = $request->id;
                $omset = Data_omset::where('id_data_usaha',auth()->user()->id)->where('id_aset_omset',$request->id)->first();
            } 
            return view('ubah_data', compact('status', 'admin', 'data', 'jenis', 'kategori', 'omset', 'id'));
            // $periode = Periode::get();
            // $omset = null;
            // if(!empty($request->id)){
            //     $id = $request->id;
            //     $omset = Data_omset::where('iddatausaha',auth()->user()->id)->where('id',$request->id)->first();
            // } 
            // dd(get_defined_vars());
            // return view('ubah_data', compact('status', 'admin', 'data', 'periode', 'omset', 'id'));
        }
        return view('ubah_data', compact('status', 'admin', 'data', 'id'));
    }

    public function getKecamatan(Request $request)
    {
        $kotID = $request->kotID;
        $kecamatan = DB::table('kecamatan')->where('kota_id', $kotID)->get();
        $data_usaha = DB::table('data_usaha')->where('id', auth()->user()->id)->first();

        if (!empty(old('kecamatan'))) {
            $val_kecamatan = old('kecamatan');
        } else {
            $val_kecamatan = $data_usaha->id_kecamatan;
        }

        if ($kotID == 'TRUE') {
            echo "<select class='form-control form-select-sm rounded-0 @error('kecamatan') is-invalid @enderror' name='kecamatan' id='kecamatan' required>";
            echo "<option value='' hidden>Pilih Kecamatan</option>";
            foreach ($kecamatan as $kec) {
                $kecfill = (isset($val_kecamatan) && $val_kecamatan == $kec->id) ? 'selected=\'selected\'' : '';
                echo "<option value='$kec->id' $kecfill>$kec->nama</option>";
            }
            echo "</select>";
        } else {
            echo "<select class='form-control form-select-sm rounded-0 @error('kecamatan') is-invalid @enderror' name='kecamatan' id='kecamatan' required>";
            echo "<option value='' hidden>Pilih Kecamatan</option>";
            foreach ($kecamatan as $kec) {
                $kecfill = (isset($val_kecamatan) && $val_kecamatan == $kec->id) ? 'selected=\'selected\'' : '';
                echo "<option value='$kec->id' $kecfill>$kec->nama</option>";
            }
            echo "</select>";
        }
    }

    public function getKelurahan(Request $request)
    {
        $kecID = $request->kecID;
        $kelurahan = DB::table('kelurahan')->where('kec_id', $kecID)->get();
        $data_usaha = DB::table('data_usaha')->where('id', auth()->user()->id)->first();

        if (!empty(old('kelurahan'))) {
            $val_kelurahan = old('kelurahan');
        } else {
            $val_kelurahan = $data_usaha->id_kelurahan;
        }

        if ($kecID == 'TRUE') {
            echo "<select class='form-control form-select-sm rounded-0 @error('kelurahan') is-invalid @enderror' name='kelurahan' id='kelurahan' required>";
            echo "<option value='' hidden>Pilih Kelurahan</option>";
            foreach ($kelurahan as $kel) {
                $kelfill = (isset($val_kelurahan) && $val_kelurahan == $kel->id) ? 'selected=\'selected\'' : '';
                echo "<option value='$kel->id' $kelfill>$kel->nama</option>";
            }
            echo "</select>";
        } else {
            echo "<select class='form-control form-select-sm rounded-0 @error('kelurahan') is-invalid @enderror' name='kelurahan' id='kelurahan' required>";
            echo "<option value='' hidden>Pilih Kelurahan</option>";
            foreach ($kelurahan as $kel) {
                $kelfill = (isset($val_kelurahan) && $val_kelurahan == $kel->id) ? 'selected=\'selected\'' : '';
                echo "<option value='$kel->id' $kelfill>$kel->nama</option>";
            }
            echo "</select>";
        }
    }

    public function post_data_diri(Request $request) {
        $request->validate([
            'nik'               => 'required|digits:16',
            'gender'            => 'required',
            'tpt_lahir'         => 'required',
            'tgl_lahir'         => 'required',
            'alamat_ktp'        => 'required',
            'alamat_domisili'   => 'required',
            'no_hp'             => 'required|numeric|digits_between:9,14',
            'email'             => 'nullable|email',
            'pendidikan'        => 'required',
            'disabilitas'       => 'nullable',
        ]);

        $data_usaha                     = User::find(auth()->user()->id);
        $data_usaha->nik                = $request->nik;
        $data_usaha->gender             = $request->gender;
        $data_usaha->tpt_lahir          = $request->tpt_lahir;
        $data_usaha->tgl_lahir          = $request->tgl_lahir;
        $data_usaha->alamat_ktp         = $request->alamat_ktp;
        $data_usaha->alamat_domisili    = $request->alamat_domisili;
        $data_usaha->no_hp              = $request->no_hp;
        $data_usaha->email              = $request->email;
        $data_usaha->pendidikan         = $request->pendidikan;
        $data_usaha->disabilitas        = $request->disabilitas;
        $data_usaha->save();

        return redirect()->route('lengkapi_data')->with('successDataDiri', 'Data Diri berhasil diperbarui');
    }

    public function post_data_usaha(Request $request) {
        $request->validate([
            'nama_usaha'        => 'required',
            'logo_lama'         => 'nullable',
            'logo'              => 'nullable|image',
            'merk_dagang'       => 'required',
            'mulai_usaha'       => 'required',
            'kota'              => 'required',
            'kecamatan'         => 'required',
            'kelurahan'         => 'required',
            'alamat_usaha'      => 'required',
            // 'sektor_usaha'      => 'required',
            // 'jenis_ekraf'       => 'required',
            'kegiatan_usaha'    => 'required',
            'produk_usaha'      => 'required',
            'profil_usaha'      => 'nullable',
        ]);

        if(!empty($request->logo)) {
            $logoName = auth()->user()->idsibakul."_".time().'_'. request()->logo->getClientOriginalName();
            $destination = '../files';
            $request->file('logo')->move($destination, $logoName);
        } else {
            $logoName = $request->logo_lama;
        }

        $data_usaha                     = User::find(auth()->user()->id);
        $data_usaha->nama_usaha         = $request->nama_usaha;
        $data_usaha->logo               = $logoName;
        $data_usaha->merkdagang         = $request->merk_dagang;
        $data_usaha->mulai_usaha        = $request->mulai_usaha;
        $data_usaha->id_kota            = $request->kota;
        $data_usaha->id_kecamatan       = $request->kecamatan;
        $data_usaha->id_kelurahan       = $request->kelurahan;
        $data_usaha->alamat_usaha       = $request->alamat_usaha;
        $data_usaha->id_sektor          = $request->sektor_usaha;
        $data_usaha->id_ekraf           = $request->jenis_ekraf;
        $data_usaha->kegiatan_usaha     = $request->kegiatan_usaha;
        $data_usaha->produk_usaha       = $request->produk_usaha;
        $data_usaha->profil_usaha       = $request->profil_usaha;
        $data_usaha->save();

        return redirect()->route('lengkapi_data')->with('successDataUsaha', 'Data Usaha berhasil diperbarui');
    }

    public function post_legalitas_usaha(Request $request) {
        if(isset($request->berkas_lama)){
            $request->validate([
                'id'                => 'nullable',
                'jenis_legalitas'   => 'required',
                'nomor'             => 'required|numeric',
                'berkas'            => 'nullable|image',
                'berkas_lama'       => 'required'
            ]);

            if(!empty($request->berkas)) {
                $berkasName = auth()->user()->idsibakul."_".time().'_'. request()->berkas->getClientOriginalName();
                $destination = '../files';
                $request->file('berkas')->move($destination, $berkasName);
            } else {
                $berkasName = $request->berkas_lama;
            }

        } else {
            $request->validate([
                'id'                => 'nullable',
                'jenis_legalitas'   => 'required',
                'nomor'             => 'required|numeric',
                'berkas'            => 'required|image'
            ]);

            $berkasName = auth()->user()->idsibakul."_".time().'_'. request()->berkas->getClientOriginalName();
            $destination = '../files';
            $request->file('berkas')->move($destination, $berkasName);

        }

        Legalitas_Usaha::updateOrCreate(
            ['id' => $request->id],
            [
                'iddatausaha'   => auth()->user()->id,
                'idjenis'       => $request->jenis_legalitas,
                'nomor'         => $request->nomor,
                'berkas'        => $berkasName,
                'waktucatat'    =>Carbon::now(),
            ]
        );

        return redirect()->route('lengkapi_data')->with('successLegalitasUsaha', 'Legalitas Usaha berhasil diperbarui');
    }

    public function hapus_legalitas_usaha($id) {
        // dd($id);
        Legalitas_Usaha::where('id',$id)->delete();
        return redirect()->route('lengkapi_data')->with('successLegalitasUsaha', 'Data Legalitas Usaha berhasil dihapus');
    }

    public function post_model_bisnis(Request $request) {
        $request->validate([
            'id'                        => 'nullable',
            'nilai_manfaat'             => 'nullable',
            'pemberdayaan_masyarakat'   => 'nullable',
            'foto_kegiatan'             => 'nullable',
            'mitra_utama'               => 'nullable',
            'aktivitas_utama'           => 'nullable',
            'sumber_bahan_baku'         => 'nullable',
            'target_pasar'              => 'nullable',
            'hubungan_konsumen'         => 'nullable',
            'jaringan_distribusi'       => 'nullable',
            'lampiran_business_plan'    => 'nullable',
        ]);
        
        if(isset($request->foto_kegiatan_lama)){
            if(!empty($request->foto_kegiatan)) {
                $fotoKegiatanName = auth()->user()->idsibakul."_".time().'_'. request()->foto_kegiatan->getClientOriginalName();
                $destination = '../files';
                $request->file('foto_kegiatan')->move($destination, $fotoKegiatanName);
            } else {
                $fotoKegiatanName = $request->foto_kegiatan_lama;
            }

        } else {
            if(!empty($request->foto_kegiatan)) {
                $fotoKegiatanName = auth()->user()->idsibakul."_".time().'_'. request()->foto_kegiatan->getClientOriginalName();
                $destination = '../files';
                $request->file('foto_kegiatan')->move($destination, $fotoKegiatanName);
            } else {
                $fotoKegiatanName = '';
            }
        }

        if(isset($request->lampiran_lama)){
            if(!empty($request->lampiran_business_plan)) {
                $lampiranName = auth()->user()->idsibakul."_".time().'_'. request()->lampiran_business_plan->getClientOriginalName();
                $destination = '../files';
                $request->file('lampiran_business_plan')->move($destination, $lampiranName);
            } else {
                $lampiranName = $request->lampiran_lama;
            }

        } else {
            if(!empty($request->lampiran_business_plan)) {
                $lampiranName = auth()->user()->idsibakul."_".time().'_'. request()->lampiran_business_plan->getClientOriginalName();
                $destination = '../files';
                $request->file('lampiran_business_plan')->move($destination, $lampiranName);
            } else {
                $lampiranName = '';
            }
        }

        Model_Bisnis::updateOrCreate(
            ['id_model' => $request->id],
            [
                'idsibakul'                 => auth()->user()->idsibakul,
                'nilai_manfaat'             => $request->nilai_manfaat,
                'pemberdayaan_masyarakat'   => $request->pemberdayaan_masyarakat,
                'foto_kegiatan'             => $fotoKegiatanName,
                'mitra_utama'               => $request->mitra_utama,
                'aktivitas_utama'           => $request->aktivitas_utama,
                'sumber_bahan_baku'         => $request->sumber_bahan_baku,
                'target_pasar'              => $request->target_pasar,
                'hubungan_konsumen'         => $request->hubungan_konsumen,
                'jaringan_distribusi'       => $request->jaringan_distribusi,
                'lampiran_business_plan'    => $lampiranName,
            ]
        );

        return redirect()->route('lengkapi_data')->with('successModelBisnis', 'Model Bisnis berhasil diperbarui');
    }

    Public function post_location($x, $y, $acc){
        // dd($x, $y);
        $data = User::where('id',auth()->user()->id)->first();
        // dd($data->get());
        $data->lokasi_x = $x;
        $data->lokasi_y = $y;
        $data->akurasi_lokasi = $acc;
        $data->save();
        return redirect()->route('lengkapi_data')->with('success', 'data berhasil tersimpan');
    }

    Public function delete_location(){
        // dd($x, $y);
        $data = User::where('id',auth()->user()->id)->first();
        // dd($data->get());
        $data->lokasi_x = "";
        $data->lokasi_y = "";
        $data->akurasi_lokasi = "";
        $data->save();
        return redirect()->route('lengkapi_data')->with('warning', 'data berhasil dihapus');
    }

    public function post_omset(Request $request){
        Carbon::setLocale('id');
        if($request->id == 'new'){
            $newid = null;
            $toast = 'success';
            $message = 'ditambahkan';
        } else {
            $newid = $request->id;
            $toast = 'warning';
            $message = 'diubah';
        }
        $nominal_raw = Str::replace(',','',$request->nominal);
        $nominal_str = Str::replace('Rp','',$nominal_raw);
        $omset = (int)$nominal_str;
        // dd($newid, $request, $omset);

        Data_omset::UpdateOrInsert(
            ['id_aset_omset' => $newid],[
            'id_data_usaha'         => auth()->user()->id,
            'id_jenis'              => $request->jenis,
            'id_kategori'           => $request->kategori,
            'nominal'               => $omset,
            'tanggal'               => Carbon::parse($request->tanggal)->format('Y-m-d H:i:s'),
            //nilai modal is null until points for modal usaha is done
            'nilai_modal_usaha' => null,
        ]);
        // $omset_inp = $request->omset_bulanan;
        // $omset_raw = Str::replace(',','',$omset_inp);
        // $omset_str = Str::replace('Rp','',$omset_raw);
        // $omset = (int)$omset_str;
        // // $omset_test = (int)$request->omset_bulanan;
        // // dd($request, $omset);
        // if($request->id == 'new'){
        //     $newid = null;
        //     $toast = 'success';
        //     $message = 'ditambahkan';
        // } else {
        //     $newid = $request->id;
        //     $toast = 'warning';
        //     $message = 'diubah';
        // }
        // Data_omset::UpdateOrCreate(['id' => $newid],[
        //     'iddatausaha'       => auth()->user()->id,
        //     'idperiode'        => $request->periode,
        //     'omset_bulanan'     => $omset,
        //     //nilai modal is null until points for modal usaha is done
        //     'nilai_modal_usaha' => null,
        // ]);
        return redirect()->route('lengkapi_data')->with($toast, 'data berhasil '.$message);
    }

    public function delete_omset($id){
        // dd(Data_omset::where('id',$id)->first(), $id);
        Data_omset::where('id_aset_omset',$id)->delete();
        return redirect()->route('lengkapi_data')->with('warning', 'data berhasil dihapus');
    }

    public function stat_omset(Request $q){
        Carbon::setLocale('id');
        $status = db::table('uns_maintenance')->orderby('id', 'DESC')->first();
        $data_raw = Data_omset::join('uns_aset_omset_jenis','uns_aset_omset_jenis.id_jenis','uns_aset_omset.id_jenis')
        ->join('uns_aset_omset_kategori','uns_aset_omset_kategori.id_kategori','uns_aset_omset.id_kategori')
        ->where('uns_aset_omset.id_data_usaha',auth()->user()->id);

        $sum_income_raw = Data_omset::join('uns_aset_omset_jenis','uns_aset_omset_jenis.id_jenis','uns_aset_omset.id_jenis')
        ->where('jenis','pemasukan')->where('uns_aset_omset.id_data_usaha',auth()->user()->id)->select('nominal');
        
        $sum_outcome_raw = Data_omset::join('uns_aset_omset_jenis','uns_aset_omset_jenis.id_jenis','uns_aset_omset.id_jenis')
        ->where('jenis','pengeluaran')->where('uns_aset_omset.id_data_usaha',auth()->user()->id)->select('nominal');
        

        if(empty($q->tanggal_mula) || empty($q->tanggal_selesai)){
            $mulai = Carbon::today()->subDay(15)->format('Y-m-d');
            $selesai = Carbon::today()->addDay(15)->format('Y-m-d');
        } elseif (!empty($q->tanggal_mulai) && !empty($q->tanggal_selesai)) {
            $mulai = Carbon::parse($q->tanggal_mulai)->format('Y-m-d');
            $selesai = Carbon::parse($q->tanggal_selesai)->format('Y-m-d');
            $data_raw = $data_raw->where('tanggal', '>=', $mulai)->where('tanggal', '<=', $selesai);
            $sum_income_raw = $sum_income_raw->where('tanggal', '>=', $mulai)->where('tanggal', '<=', $selesai);
            $sum_outcome_raw = $sum_outcome_raw->where('tanggal', '>=', $mulai)->where('tanggal', '<=', $selesai);
        }
        $data = $data_raw->get();

        $sum_income = $sum_income_raw->get()->sum('nominal');
        
        $sum_outcome = $sum_outcome_raw->get()->sum('nominal');
        
        // lazyload renders this trick useless
        // $sum_income = $data_raw->where('jenis', 'pemasukan')->get()->sum('nominal');
        // $sum_outcome = $data_raw->where('jenis','pengeluaran')->get()->sum('nominal');
        

        // dd($sum_income, $sum_outcome, $data);
        $omzet = $sum_income - $sum_outcome;
        // dd($data, $mulai, $selesai, $q, $q->tanggal_mulai);
        return view('asetomset', compact('data', 'omzet', 'sum_income', 'sum_outcome', 'status', 'mulai', 'selesai'));
    }
}