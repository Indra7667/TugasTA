<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Agenda;
use App\Models\Forgot;
use App\Models\Kurasi;
use App\Models\Kurasireq_berat;
use App\Models\Kurasireq_deskripsi;
use App\Models\Kurasireq_foto;
use App\Models\Kurasireq_harga;
use App\Models\Kurasireq_judul;
use App\Models\Barang;
use App\Models\User;
use App\Models\Pembinaan;
use App\Models\Verification;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AdminPostController extends BaseController
{

    public function __construct()
    {
        Carbon::setLocale('id');
        $this->now = config('Custom_UNS.now');
        $this->today = config('Custom_UNS.today');
    }

    public function kurasi_post(Request $request)
    {
        $request->validate([
            'judul_sesuai'      =>  'required',
            'foto_bagus'        =>  'required',
            'deskripsi_jelas'   =>  'required',
            'harga_tidak_kosong' =>  'required',
            'berat_tidak_kosong' =>  'required',
            'catatan'           =>  'nullable',
            'lolos'             =>  'required'
        ]);
        if ($request->id_kurasi == 'new') {
            $id_kurasi = null;
            $message = 'data berhasil ditambahkan';
            $toast = 'danger';
            // $status = 'terja'
        } else {
            $id_kurasi = $request->id_kurasi;
            $message = 'data berhasil diubah';
            $toast = 'warning';
        }

        // if($request->lolos = 'ya'){
        //     $lolos = 'Y';
        // } elseif($request->tidak = 'tidak') {
        //     $lolos = 'T';
        // } else{
        //     $lolos = 'P';
        // }

        $now = $this->now;
        Kurasi::updateOrCreate(
            ['id_kurasi'                 => $id_kurasi],
            [
                'id_produk'                 => $request->id_barang,
                // 'judul_sesuai'              => $request->judul_sesuai,
                // 'foto_bagus'                => $request->foto_bagus,
                // 'deskripsi_jelas'           => $request->deskripsi_jelas,
                // 'harga_tidak_kosong'        => $request->harga_tidak_kosong,
                // 'berat_tidak_kosong'        => $request->berat_tidak_kosong,
                'id_status_kurasimarkethub' => $request->lolos,
                'catatan_kurasimarkethub'   => $request->catatan,
                'kurator_markethub'         => auth()->user()->nama,
                'waktu_kurasimarkethub'     => $now
            ]
        );
        $newest_kurasi = Kurasi::where('waktu_kurasimarkethub', $now)->first();
        $newid = $newest_kurasi->id_kurasi;
        // dd($newid);
        // dd($request->berat_tidak_kosong,  $newest_kurasi->id_kurasi);
        Kurasireq_berat::updateOrInsert(['id_kurasi' => $newid],['weight_isset' => $request->berat_tidak_kosong]);
        Kurasireq_deskripsi::updateOrInsert(['id_kurasi' => $newid],['deskripsi_jelas' => $request->deskripsi_jelas]);
        Kurasireq_foto::updateOrInsert(['id_kurasi' => $newid], ['foto_bagus' => $request->deskripsi_jelas]);
        Kurasireq_harga::updateOrInsert(['id_kurasi' => $newid], ['harga_isset' => $request->deskripsi_jelas]);
        Kurasireq_judul::updateOrInsert(['id_kurasi' => $newid], ['judul_sesuai' => $request->deskripsi_jelas]);
        // $barang = Barang::where('id', $request->id_barang)->first();
        // $barang->id_status_kurasimarkethub  = $request->lolos;
        // $barang->catatan_kurasimarkethub= 
        // $barang->
        // $barang->save();
        return redirect()->route('kurasi_list-admin', ['status' => 'terjawab'])->with($toast, $message);
    }
    public function pedagang_post(Request $req)
    {
        $req->validate([
            'catatan'       =>  'nullable',
            'verify'        =>  'required'
        ]);

        if ($req->verify == 'ditolak') {
            $toast = 'danger';
            $message = 'verifikasi akun berhasil ditolak';
        } elseif ($req->verify == 'diterima') {
            $toast = 'success';
            $message = 'verifikasi akun berhasil diterima';
        }

        Verification::updateOrCreate(
            ['id_data_usaha' => $req->id],
            [
                'verified'      => $req->verify,
                'catatan_verifikasi' => $req->catatan,
                'date_updated'  => $this->now
            ]
        );

        return redirect()->route('pedagang_list-admin', ['status' => $req->verify])->with($toast, $message);
    }

    public function post_agenda(Request $req)
    {
        Carbon::setLocale('id');
        $now = $this->now->addHours(7);
        if ($req->type == 'delete') {
            $agenda     = Agenda::where('id_agenda', $req->id);
            $agenda->delete();
            $toast      = 'warning';
            $message    = 'data berhasil dihapus';
        } elseif ($req->type == 'edit') {
            // dd($req->file());
            $req->validate([
                'id'        =>  'required',
                'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,jfif|max:4096',
                'nama'      =>  'required',
                'deskripsi' =>  'nullable',
                'mulai'     =>  'required',
                'selesai'   =>  'required',
                'lokasi'    =>  'nullable',
                'cp'        =>  'nullable',
                'kontak'    =>  'nullable'
            ]);
            $toast      = 'success';
            $message    = 'data berhasil disimpan';

            if ($req->id != 'new') {
                $olddata = Agenda::where('id_agenda', $req->id)->first();
            }
            $mulai = Carbon::parse($req->mulai)->format('Y-m-d H:i:s');
            $selesai = Carbon::parse($req->selesai)->format('Y-m-d H:i:s');
            // dd($olddata->gambar, file_exists(public_path('/images/agenda/'.$olddata->gambar)));
            // dd(Carbon::parse($mulai),$selesai);

            $file = $req->file('gambar');
            if (!empty($file)) {
                if (!empty($olddata) && file_exists('public/images/agenda/' . $olddata->gambar)) {
                    unlink(public_path('/images/agenda/' . $olddata->gambar . ''));
                }
                $fileName = $this->now . '_' . $file->getClientOriginalName();
                $destination = 'public/images/agenda';

                // dd(get_defined_vars());
                $file->move($destination, $fileName);
                // dd($req->id);    
            } else {
                $fileName = $olddata->gambar;
            }

            if (!empty($req->deskripsi)) {
                $deskripsi = $req->deskripsi;
            } else {
                $deskripsi = $olddata->deskripsi;
            }


            if ($req->id == 'new') {
                $id = null;
            } else {
                $id = $req->id;
            }

            // $mulai = Carbon::parse($req->mulai);

            Agenda::updateOrInsert(
                ['id_agenda'         => $id],
                [
                    'gambar'            => $fileName,
                    'nama_agenda'       => $req->nama,
                    'deskripsi'         => $deskripsi,
                    'waktu_mulai'       => $mulai,
                    'waktu_selesai'     => $selesai,
                    'lokasi'            => $req->lokasi,
                    'nama_kontak_person'=> $req->cp,
                    'kontak'            => $req->kontak,
                    'date_created'      => $now
                ]
            );
        }
        return redirect()->route('agenda_list-admin')->with($toast, $message);
    }

    public function post_pembinaan(Request $req)
    {
        $destination = 'public/images/pembinaan';

        if ($req->type == 'delete') {
            $Pembinaan     = Pembinaan::where('id_pembinaan', $req->id);
            $Pembinaan->delete();
            $toast      = 'warning';
            $message    = 'data berhasil dihapus';
        } elseif ($req->type == 'edit') {
            // dd($req);
            switch ($req->jenis_lampiran) {
                case 'file':
                    $condition_file = 'required|mimes:pdf|max:4096';
                    $condition_link = 'nullable';
                    break;
                case 'link':
                    $condition_file = 'nullable';
                    $condition_link = 'required';
                    break;
                case 'none':
                    $condition_file = 'nullable';
                    $condition_link = 'nullable';
                    break;
                default:
                    $condition_file = 'nullable';
                    $condition_link = 'nullable';
                    break;
            }
            $req->validate([
                'id'            => 'required',
                'cover'        => 'nullable|image|mimes:jpeg,png,jpg,jfif|max:4096',
                'jenis'         => 'required',
                'jenis_lampiran' => 'required',
                'lampiran_link'      => $condition_link,
                'lampiran_file'      => $condition_file,
                'mulai'         => 'required',
                'selesai'       => 'required',
                'lokasi'        => 'nullable',
                'detail'        => 'nullable'
            ]);

            $toast      = 'success';
            $message    = 'data berhasil disimpan';

            if ($req->id != 'new') {
                $olddata = Pembinaan::where('id_agenda', $req->id)->first();
            } else {
                $olddata = null;
            }
            // dd($olddata->gambar, file_exists(public_path('/images/agenda/'.$olddata->gambar)));

            $cover = $req->file('cover');
            if (!empty($cover)) {
                if (!empty($olddata) && file_exists('public/images/pembinaan/' . $olddata->cover)) {
                    unlink(public_path('/images/pembinaan/' . $olddata->cover . ''));
                }
                $coverName = $this->now . '_cover_' . $cover->getClientOriginalName();
                $cover->move($destination, $coverName);
            } else {
                $coverName = $olddata->cover;
            }

            //check if there's new detail
            if (!empty($req->detail)) {
                $detail = $req->detail;
            } else {
                $detail = $olddata->detail;
            }

            //check if lampiran == file
            if ($req->jenis_lampiran == 'file') {
                $lampiran = $req->file('lampiran');
            } else {
                $lampiran = null;
            }

            //check if lampiran is changed
            if (!empty($lampiran)) {
                if (!empty($olddata) && file_exists('public/images/pembinaan/' . $olddata->lampiran)) {
                    unlink(public_path('/images/pembinaan/' . $olddata->lampiran . ''));
                }
                $lampiranName = $this->now . '_attached_' . $lampiran->getClientOriginalName();
                $lampiran->move($destination, $lampiranName);
            } elseif ($req->jenis_lampiran == 'link' && !empty($req->lampiran_link)) {
                $lampiranName = $req->lampiran_link;
            } else {
                $lampiranName = $olddata->lampiran;
            }

            //check if detail is changed
            if (!empty($req->detail)) {
                $detail = $req->detail;
            } else {
                $detail = $olddata->detail;
            }

            // check if entry is new
            if ($req->id == 'new') {
                $id = '';
                $created = $this->now;
            } else {
                $id = $req->id;
                $created = $olddata->date_created;
            }

            Pembinaan::updateOrCreate(
                ['id_pembinaan'         => $id],
                [
                    'cover'             => $coverName,
                    'jenis'             => $req->jenis,
                    'judul'             => $req->judul,
                    'jenis_lampiran'    => $req->jenis_lampiran,
                    'lampiran'          => $lampiranName,
                    'waktu_mulai'       => $req->mulai,
                    'waktu_selesai'     => $req->selesai,
                    'lokasi'            => $req->lokasi,
                    'detail'            => $detail,
                    'date_created'      => $created,
                    'date_updated'      => $this->now
                ]
            );
        }
        return redirect()->route('pembinaan_list-admin')->with($toast, $message);
    }
}
