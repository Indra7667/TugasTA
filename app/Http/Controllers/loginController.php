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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Data_Usaha;
use App\Models\Forgot;
use App\Models\Verification;

class loginController extends BaseController
{
    public function __construct(){
        $this->now = config('Custom_UNS.now');
        $this->today = config('Custom_UNS.today');
        $this->yesterday = config('Custom_UNS.yesterday');
    }

    public function index(){
        $status = db::table('uns_maintenance')->orderby('id','DESC')->first();
        return view('login',compact('status'));
    }

    public function login(Request $request){
        // dd($request);
        $request->validate([
            'idsibakul'  =>  'required',
            'password'  =>  'required',
        ]);
        // dd('berhasil login');
        $remember_me = $request->has('remember') ? true : false;
        if (Auth::attempt(['idsibakul' => $request->idsibakul, 'password' => $request->password],$remember_me)) {
            $request->session()->regenerate();
            return redirect()->intended('index');
        } elseif (Auth::attempt(['idsibakul' => $request->idsibakul, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('index');
        }

        return back()->withInput($request->input())->with('danger', 'ID SiBakul atau Kata Sandi Salah');
        // return view('index');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function reset_pass(){
        $status = db::table('uns_maintenance')->orderby('id','DESC')->first();
        $admin = db::table('uns_akses')->where('id_sibakul', auth()->user()->idsibakul)->get();
        return view('ubah_pass',compact('status','admin'));
    }
    public function forgot(){
        $status = db::table('uns_maintenance')->orderby('id','DESC')->first();
        $admin = '';
        return view('forgot',compact('status','admin'));
    }

    public function post_forgot(Request $request) {
        $request->validate([
            'idsibakul' => 'required',
            'no_wa' => 'required',
        ]);

        $id = DB::table('data_usaha')
        ->where('no_hp', $request->no_wa)
        ->where('idsibakul',$request->idsibakul)
        ->select('idsibakul')->first();

        if ($id != null) {
            $lupa = DB::table('uns_lupa_password')
            ->where('idsibakul', $id->idsibakul)->get();

            if ($lupa != null) {
                foreach ($lupa as $lupa) {
                    if ($lupa->status == 1) {
                        $forgot           = Forgot::find($lupa->id);
                        $forgot->status   = 4;
                        $forgot->save();
                    }
                }
            }
            $id_forgot = Forgot::Create([
                'idsibakul'    => $id->idsibakul,
                'status'     => 1,
                'token'      => Str::random(60),
            ])->id;

            $tokenData = DB::table('uns_lupa_password')
            ->where('id', $id_forgot)
            ->select('token')->first();

            // $hash_wa = md5($request->no_wa);

            // Encript
            $ciphering = "BF-CBC"; // Storingthe cipher method
            $iv_length = openssl_cipher_iv_length($ciphering); // Using OpenSSl Encryption method 
            $options   = 0;
            $encryption_iv = '12345678'; // Non-NULL Initialization Vector for encryption 
            $encryption_key = "Ukm"; // Storing the encryption key 
            $encrypt_wa = urlencode(openssl_encrypt($request->no_wa, $ciphering, $encryption_key, $iv_length, $encryption_iv));
            // End Encript
            // $decryption_iv = '12345678'; // Non-NULL Initialization Vector for encryption 
            // $decryption_key = "Ambilin"; // Storing the encryption key 
            // $decrypt_wa = openssl_decrypt($encrypt_wa, $ciphering, $decryption_key, $options, $decryption_iv);
            // dd($encrypt_wa, $decrypt_wa);

            $link = 'https://sibakuljogja.jogjaprov.go.id/ukm/lupa_password/' . $tokenData->token . '?q=' . $encrypt_wa.'&p='.$id->idsibakul;

            $lupa_pass  = Forgot::find($id_forgot);
            $lupa_pass->link    = $link;
            $lupa_pass->save();
            // dd(get_defined_vars());
            return redirect(route('login'))->with('success', 'Permintaan ganti kata sandi berhasil terkirim, tautan untuk mengganti kata sandi akan terkirim ke nomor WA anda setelah beberapa saat');
        } else {
            return redirect(route('forgot'))->with('error', 'Idsibakul atau nomor WA tidak ditemukan');
        }
    }

    public function lupa_password(Request $request, $token) {
        $status = db::table('uns_maintenance')->orderby('id','DESC')->first();
        $admin = '';
        if (($token != null) && ($request->q != null) && (!empty($request->p))){
            $idsibakul = $request->p;
            // dd($request->q);
            $ciphering = "BF-CBC"; // Storingthe cipher method
            $iv_length = openssl_cipher_iv_length($ciphering); // Using OpenSSl Encryption method 
            $options   = 0;
            $decryption_iv = '12345678'; // Non-NULL Initialization Vector for encryption 
            $decryption_key = "Ukm"; // Storing the encryption key 
            $decrypt_wa = openssl_decrypt($request->q, $ciphering, $decryption_key, $iv_length, $decryption_iv);

            // dd($decrypt_wa);

            $no_wa = DB::table('data_usaha')->where('no_hp', $decrypt_wa)->get();
            $count_wa = $no_wa->count();

            if ($count_wa > 0) {

                $id = DB::table('data_usaha')
                    ->where('no_hp', $decrypt_wa)
                    ->where('idsibakul', $request->p)
                    ->select('idsibakul')->first();
                $forgot = DB::table('uns_lupa_password')->where('idsibakul', $id->idsibakul)
                    ->latest()->first();

                if (isset($forgot->token)) {

                    if ($token == $forgot->token) {
                        $now = Carbon::now();
                        $date = Carbon::createFromFormat('Y-m-d H:i:s', $forgot->updated_at);
                        $tomorrow = $date->addDay()->format('Y-m-d H:i:s');
    
                        if ($now < $tomorrow) {
                            return view('lupa_password',compact('idsibakul','status','admin'));
                        } else {
                            return redirect(route('login'))->with('danger', 'Session expired');
                        }
                    } else {
                        return redirect(route('login'))->with('danger', 'Session invalid');
                    }
                } else {
                    return redirect(route('login'))->with('danger', 'Session invalid');
                }
            } else {
                return redirect(route('login'))->with('danger', 'Session invalid');
            }
        } else {
            return redirect(route('login'));
        }
    }

    public function post_lupa(Request $request, $id) {
        $request->validate([
            'no_wa'     => 'required',
            'q'         => 'required',
            'password'  => ['required', 'confirmed', Password::min(6)],
        ]);

        $ciphering = "BF-CBC"; // Storingthe cipher method
        $iv_length = openssl_cipher_iv_length($ciphering); // Using OpenSSl Encryption method 
        $options   = 0;
        $decryption_iv = '12345678'; // Non-NULL Initialization Vector for encryption 
        $decryption_key = "Ukm"; // Storing the encryption key 
        $decrypt_wa = openssl_decrypt($request->q, $ciphering, $decryption_key, $options, $decryption_iv);

        $user = DB::table('data_usaha')->where('no_hp', $request->no_wa)->where('idsibakul',$id)->first();
        $idforgot = Forgot::where('status',1)->where('idsibakul',$id)
                        ->orwhere('status',2)->where('idsibakul',$id)
                        ->first();

        if ($request->no_wa == $decrypt_wa) {
            $forgot                     = Forgot::find($idforgot->id);
            $forgot->status             = 3;
            $forgot->save();

            $update_pass                = User::find($user->id);
            $update_pass->password      = Hash::make($request->password);
            $update_pass->save();

            return redirect(route('login'))->with('success', 'Kata sandi berhasil diubah');
        } else {
            return back()->with('danger', 'Nomor WA tidak sesuai');
        }
    }


    public function new_pass(Request $request) {
        // dd($request);
        $request->validate([
            'password_lama'         => ['required', Password::min(6)],
            'password'              => ['required', 'confirmed', Password::min(6)],
        ]);
        // dd($request->password_lama,auth()->user(),Hash::check($request->password_lama, auth()->user()->password));
        if (!Hash::check($request->password_lama, auth()->user()->password)){
            return redirect(route('reset-pass'))->with('error', 'Password Salah');
            
        } 
        if ($request->password_lama != $request->password) {
            $update_pass                = User::find(auth()->user()->id);
            $update_pass->password      = Hash::make($request->password);
            $update_pass->save();

            return redirect(route('/'))->with('success', 'Kata sandi berhasil diubah');
        } else {
            return redirect(route('reset-pass'))->with('error', 'Tidak dapat menggunakan kata sandi yang sama');
        }

    }

    public function registrasi(){
        $status = db::table('uns_maintenance')->orderby('id','DESC')->first();
        $admin = '';
        $kota = DB::table('kota')->get();
        return view('registrasi',compact('status','admin', 'kota'));
    }

    public function post_registrasi(Request $request) {
        $request->validate([
            'nama_usaha'    => ['required'],
            'kota'          => ['required'],
            'kecamatan'     => ['required'],
            'kelurahan'     => ['required'],
            'alamat_usaha'  => ['required'],
            'nik'           => ['required', 'digits:16'],
            'password'      => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'nama_lengkap'  => ['required'],
            'no_hp'         => ['required'],
        ]);

        // dd($request->kota, $request->kecamatan, $request->kelurahan);

        $id = User::Create([
            'nama_usaha'    => $request->nama_usaha,
            'id_kota'       => $request->kota,
            'id_kecamatan'  => $request->kecamatan,
            'id_kelurahan'  => $request->kelurahan,
            'alamat_usaha'  => $request->alamat_usaha,
            'nik'           => $request->nik,
            'password'      => Hash::make($request->password),
            'nama_lengkap'  => $request->nama_lengkap,
            'no_hp'         => $request->no_hp,
            'waktu'         => Carbon::now(),
        ])->id;

        // $id = DB::table('data_usaha')->insertGetId(
        //     [
        //         'nik'           => $request->nik,
        //         'password'      => Hash::make($request->password),
        //         'nama_lengkap'  => $request->nama_lengkap,
        //         'no_hp'         => $request->no_hp,
        //         'email'         => $request->email,
        //     ]
        // );

        $data_usaha             = User::find($id);
        $data_usaha->idsibakul  = 'SB'.sprintf("%06d", $id);
        $data_usaha->save();
        
        $verification = Verification::Create([
            'id_data_usaha' => $id,
            'verified'      => 'pengajuan',
            'date_created'  => $this->now,
            'date_updated'  => $this->now
        ])->id;

        if (Auth::attempt(['idsibakul' => $data_usaha->idsibakul, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('index');
        }
    }

    public function getKecamatan(Request $request)
    {
        $kotID = $request->kotID;
        $kecamatan = DB::table('kecamatan')->where('kota_id', $kotID)->get();

        if ($kotID == 'TRUE') {
            echo "<select class='form-control active @error('kecamatan') is-invalid @enderror' name='kecamatan' id='kecamatan' required>";
            echo "<option value='' hidden>Pilih Kecamatan</option>";
            foreach ($kecamatan as $kec) {
                $kecfill = (old('kecamatan') && old('kecamatan') == $kec->id) ? 'selected=\'selected\'' : '';
                echo "<option value='$kec->id' $kecfill>$kec->nama</option>";
            }
            echo "</select>";
        } else {
            echo "<select class='form-control active @error('kecamatan') is-invalid @enderror' name='kecamatan' id='kecamatan' required>";
            echo "<option value='' hidden>Pilih Kecamatan</option>";
            foreach ($kecamatan as $kec) {
                $kecfill = (old('kecamatan') && old('kecamatan') == $kec->id) ? 'selected=\'selected\'' : '';
                echo "<option value='$kec->id' $kecfill>$kec->nama</option>";
            }
            echo "</select>";
        }
    }

    public function getKelurahan(Request $request)
    {
        $kecID = $request->kecID;
        $kelurahan = DB::table('kelurahan')->where('kec_id', $kecID)->get();

        if ($kecID == 'TRUE') {
            echo "<select class='form-control active @error('kelurahan') is-invalid @enderror' name='kelurahan' id='kelurahan' required>";
            echo "<option value='' hidden>Pilih Kelurahan</option>";
            foreach ($kelurahan as $kel) {
                $kelfill = (old('kelurahan') && old('kelurahan') == $kel->id) ? 'selected=\'selected\'' : '';
                echo "<option value='$kel->id' $kelfill>$kel->nama</option>";
            }
            echo "</select>";
        } else {
            echo "<select class='form-control active @error('kelurahan') is-invalid @enderror' name='kelurahan' id='kelurahan' required>";
            echo "<option value='' hidden>Pilih Kelurahan</option>";
            foreach ($kelurahan as $kel) {
                $kelfill = (old('kelurahan') && old('kelurahan') == $kel->id) ? 'selected=\'selected\'' : '';
                echo "<option value='$kel->id' $kelfill>$kel->nama</option>";
            }
            echo "</select>";
        }
    }
}
?>