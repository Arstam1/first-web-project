<?php
namespace App\Http\Controllers;

use App\Models\Dokumens;
use App\Notifications\SendOtpNotification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\member;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
        ]);
        $otp = str_pad(mt_rand(100000, 999999), 6, '0', STR_PAD_LEFT); // OTP numerik
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'otp' => $otp,
        ]);
        try {
            $user->notify(new SendOtpNotification($otp));
        } catch (\Exception $e) {
            $user->delete(); // Rollback pengguna jika OTP gagal dikirim
            return back()->withErrors(['error' => 'Gagal mengirim OTP. Silakan coba lagi.']);
        }
        // buat data member
        // $memberData = [
        //     'user_id' => $user->id,
        // ];
        // member::create($memberData);
        // // buat data dokumen
        // $dokumenData = [
        //     'user_id' => $user->id,
        // ];
        // Dokumens::create($dokumenData);
        // return redirect('/login')->with('success', 'Pendaftaran berhasil! Silahkan Login');
        return redirect('/verify-otp')->with('success', 'Silakan masukkan kode OTP yang telah dikirim ke email Anda.');
    }
    
    public function showOtpForm()
    {
        return view('register.verify');
    }
    
    public function verifyOtp(Request $request)
{
    // $validatedData = $request->validate([
    //     'email' => 'required|email',
    //     'otp' => 'required|array|min:6|max:6', // OTP sebagai array dengan panjang 6
    //     'otp.*' => 'required|digits:1', // Setiap field OTP hanya boleh angka
    // ]);

    // // Gabungkan array OTP menjadi satu string
    // $otpInput = implode('', $validatedData['otp']);
    // $user = User::where('email', $validatedData['email'])->first();

    // if (!$user) {
    //     return back()->withErrors(['error' => 'Email tidak ditemukan.']);
    // }

    // if ($user->otp !== $validatedData['otp']) {
    //     return back()->withErrors(['error' => 'Kode OTP salah atau sudah kadaluarsa.']);
    // }
    // if ($user->otp === $otpInput) {
    //     DB::transaction(function () use ($user) {
    //         $user->otp = null; // Reset OTP
    //         // $user->is_active = true; // Tandai pengguna sebagai aktif
    //         $user->save();
    
    //         if (!member::where('user_id', $user->id)->exists()) {
    //             member::create(['user_id' => $user->id]);
    //         }
    
    //         if (!Dokumens::where('user_id', $user->id)->exists()) {
    //             Dokumens::create(['user_id' => $user->id]);
    //         }
    //     });
    // }
    // return redirect('/login')->with('success', 'OTP berhasil diverifikasi. Silakan login.');
    // Validasi data dari request
    $validatedData = $request->validate([
        'email' => 'required|email',
        'otp' => 'required|array|min:6|max:6', // OTP sebagai array dengan panjang 6
        'otp.*' => 'required|digits:1', // Setiap field OTP hanya boleh angka
    ]);

    // Gabungkan array OTP menjadi satu string
    $otpInput = implode('', $validatedData['otp']);

    // Cari pengguna berdasarkan email
    $user = User::where('email', $validatedData['email'])->first();

    if (!$user) {
        return back()->withErrors(['error' => 'Email tidak ditemukan.']);
    }

    // Cek apakah OTP cocok dan masih valid
    if ($user->otp === $otpInput) {
        DB::transaction(function () use ($user) {
            $user->otp = null; // Reset OTP setelah diverifikasi
            $user->is_active = true; // Tandai pengguna sebagai aktif
            $user->save();

            // Buat entri member jika belum ada
            if (!member::where('user_id', $user->id)->exists()) {
                member::create(['user_id' => $user->id]);
            }

            // Buat entri dokumen jika belum ada
            if (!Dokumens::where('user_id', $user->id)->exists()) {
                Dokumens::create(['user_id' => $user->id]);
            }
        });

        return redirect('/login')->with('success', 'OTP berhasil diverifikasi. Silakan login.');
    }

    return back()->withErrors(['error' => 'Kode OTP salah atau sudah kadaluarsa.']);
}
}