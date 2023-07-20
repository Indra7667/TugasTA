<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use App\Models\Agenda;
use App\Models\Data_omset;
use App\Models\Daftar_Agenda;
use App\Models\User;

use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(){
        Carbon::setLocale('id');
        $this->now = config('Custom_UNS.now');
        $this->today = config('Custom_UNS.today');
        $this->yesterday = config('Custom_UNS.yesterday');
    }
    public function index(Request $q){
        Carbon::setLocale('id');
        $total = 0;
        $isi = 0;
        $status = db::table('uns_maintenance')->orderby('id','DESC')->first();
        $admin = db::table('uns_akses')->where('id_sibakul', auth()->user()->idsibakul)->get();
        $data = User::where('data_usaha.idsibakul', auth()->user()->idsibakul)->join('uns_verification', 'data_usaha.id', 'uns_verification.id_data_usaha')
        // ->join('profil_usaha','profil_usaha.idsibakul','data_usaha.idsibakul')
        ->first();
        if(empty($data->verified) || $data->verified == 'pengajuan' || $data->verified == 'ditolak'){
            $verified_only = 'disabled';
        } elseif ($data->verified == 'diterima' || $data->verified == 'test accounts'){
            $verified_only = '';
        }
        $omset = Data_omset::where('id_data_usaha', auth()->user()->id)->get();
        // dd($omset);
        
        $toko=db::table('data_usaha')->where('idsibakul', auth()->user()->idsibakul)->first();

        /* agenda data */
        if($q->status_agenda == 'lampau'){
            $agenda_raw =  Agenda::where('waktu_selesai', '<', $this->now);
            $status_agenda = 'lampau';
            $disabled = 'disabled';
        } elseif($q->status_agenda == 'aktif') {
            $agenda_raw = Agenda::where('waktu_selesai', '>', $this->now);
            $status_agenda = 'aktif';
            $disabled = '';
        }
        else{
            $agenda_raw = Agenda::where('waktu_selesai', '>', $this->now);
            $status_agenda = '';
            $disabled = '';
        }
        $agenda_joined_raw = Daftar_Agenda::where('id_pedagang', auth()->user()->id)->select('id_agenda')->get()->toArray();
        $agenda_joined = Arr::flatten($agenda_joined_raw);
        $agenda = $agenda_raw->get();
        $agenda_c = $agenda_raw->count();
        /* agenda data end */
        // $data_array = $data->toArray();
        // $data_flat = Arr::flatten($data);
        // $data_dot = Arr::dot($data);
        // $data_schema = Schema::getColumnListing('data_usaha');
        // $schema_count = count($data_schema);
        // // dd(Arr::dot($data_schema), count($data_schema));
        // for($d=0;  $d<$schema_count;$d++){
        //     $col = (string)$data_schema[$d];
        //     // dd($col, $data,$data->id, $data_flat, $data_dot);
        //     if($data->$col != null || $data->$col != ''){
        //         $total += 1;
        //         $isi += 1;
        //     } else {
        //         $total += 1;
        //     }
        // }
        // dd($total, $isi);
        // dd($data, auth()->user()->nik,$test);

        // while($data->fetch()){ 
        //     $data1 = array($data['property_image1'],$data['property_image2'],$data['property_image3'],$data['property_image4'],$data['property_image5'],$data['property_image6']);
        //     $count = count($data1); // count of original array
        //     $count1 = count(array_filter($data1)); // remove empty indexes and count the values
          
        //     echo "empty columns number is :-".($count-$count1);
        //   }

        return view('index',compact('data','status','admin','toko','omset','verified_only', 'agenda', 'agenda_c', 'agenda_joined', 'status_agenda', 'disabled'));
    }

    public function daftar_agenda(Request $req){
        $data_raw = Daftar_Agenda::where('id_agenda', $req->id_agenda)->where('id_pedagang', auth()->user()->id);
        $data = $data_raw->first();
        if(!empty($data)){
            $data_raw->delete();
            $toast = "warning";
            $message = "Pendaftaran berhasil dibatalkan";
        } else {
            Daftar_Agenda::create([
                "id_agenda"     => $req->id_agenda,
                "id_pedagang"   => auth()->user()->id,
                "date_created"  => $this->now
            ]);
            $toast = "success";
            $message = "Anda berhasil didaftarkan";
        }
        return redirect()->route('index')->with($toast, $message);
    }

    public function ongkir(){
        Carbon::setLocale('id');
        $status = db::table('uns_maintenance')->orderby('id','DESC')->first();
        $admin = db::table('uns_akses')->where('id_sibakul', auth()->user()->idsibakul)->get();
       
        // dd($data, auth()->user()->nik,$test);
        return view('ongkir',compact('status','admin'));
    }
    
    // public function randomfunction(){
    //     $kurasi = Kurasi::where('id_produk', '>=', '50001')->where('id_produk', '<=', '55000')->get();
    //     foreach ($kurasi as $kurasi1) {
    //         $barang = Barang::where('id', $kurasi1->id_produk)->select('id_status_kurasimarkethub')->first();
    //         // dd($barang->id_status_kurasimarkethub);
    //         $kurasi1->id_status_kurasimarkethub = $barang->id_status_kurasimarkethub;
    //         $kurasi1->save();
    //     }
    // }
}
