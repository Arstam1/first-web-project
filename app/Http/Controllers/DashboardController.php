<?php

namespace App\Http\Controllers;
use App\Models\paket;
use App\Models\member;
use App\Models\transaksi;
use App\Models\deposit;
use App\Models\Dokumens;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isNull;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

function getColumns(string $tableName): array {
    return DB::getSchemaBuilder()->getColumnListing($tableName);
}

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Mengambil informasi user yang sedang login
        $transaksi = transaksi::where('user_id', $user->id)->latest()->first();
         // Mendapatkan informasi paket yang telah dibeli oleh user
         if ($transaksi) {
            // Jika ada transaksi, lanjutkan dengan menampilkan data
            // $paket = paket::where('id', $transaksi->paket_id)->first();
            // $deposit = deposit::where('jenis', 'Pembelian Paket')->where('user_id', auth()->user()->id)->latest()->first();
            // menghitung sisa hari
            $tgljalan=$transaksi->paket->tanggal_berangkat;
            $tgljalan=Carbon::parse($tgljalan);
            $today=Carbon::now();
            $beda=$today->diffInDays($tgljalan,false);
            // end menghitung sisa hari
         }else {
            // Jika tidak ada transaksi, Anda dapat menangani ini sesuai kebutuhan, misalnya, redirect ke halaman lain atau menampilkan pesan khusus.
            // $paket = isNull();
            // $deposit = isNull();
            $beda = isNull();
        }
        

        $member = member::where('user_id', $user->id)->first();
        $dokumens = dokumens::where('user_id', $user->id)->first();
        $deposit1 = deposit::where('jenis', 'refund')->where('user_id',auth()->user()->id)->where('status', 'pending')->first();
        // cek nul

        // $koloms = Schema::getColumnListing('dokumens');
        // $koloms2 = Schema::getColumnListing('member');

        // // Buat query untuk memeriksa nilai null di antara semua kolom
        // $ceknul = Dokumens::where('user_id', $user->id)->where(function ($query) use ($koloms) {
        //     foreach ($koloms as $column) {
        //         $query->orWhereNull($column);
        //     }
        // });

        // $ceknul2 = member::where('user_id', $user->id)->where(function ($query) use ($koloms2) {
        //     foreach ($koloms2 as $column2) {
        //         $query->orWhereNull($column2);
        //     }
        // });
        $ceknul = dokumens::where('user_id', $transaksi->user_id)->where(function ($query) {
            $columns = getColumns('dokumens'); // Ganti 'dokumens' dengan nama tabel Anda
            foreach ($columns as $column) {
                $query->orWhereNull($column);
            }})->exists();
        $ceknul2 = Member::where('user_id', $transaksi->user_id)->where(function ($query) {
            $columns = getColumns('members'); // Tabel members
            foreach ($columns as $column) {
                $query->orWhereNull($column);
            }})->exists();
        

        return view('dashboard.index', [
            'user' => $user,
            'transaksi' => $transaksi,
            // 'paket' => $paket,
            'member' => $member,
            'dokumens' => $dokumens,
            // 'deposit' => $deposit,
            'deposit1' => $deposit1,
            'ceknul' => $ceknul,
            'beda' => $beda,
            'ceknul2' => $ceknul2,
        ]);
    }

    public function profil(){
        return view('dashboard.profil',[
            'user' => auth()->user()
        ]);
    }

    public function edit_profil(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|min:5|max:255'
         ]);
        $user=auth()->user();
        if( $request->email != $user->email){
            $validatedData['email'] = 'required|email|unique:users,email,'.auth()->user()->id;
        }
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::where('id', $user->id)
            ->update($validatedData);
        return redirect('/dashboard')->with('success', 'Data diri telah Di update');
    }


    public function riwayat(){
        
        return view('dashboard.anggota.utama.riwayat',[
            'transaksis' => transaksi::where('user_id', auth()->user()->id)->get()
        ]);
    }
    public function formulir(){
        return view('dashboard.anggota.utama.formulir',[
            'member' => member::where('user_id', auth()->user()->id)->first()
        ]);
    }

    public function dokumen(Dokumens $dokumens){
        return view('dashboard.anggota.utama.dokumen', [
            'dokumens' => $dokumens
        ]);
    }

    public function uploaddoc(Request $request){
        $rules = [
            'ktp' => 'image|file',
            'passport' => 'image|file',
            'kk' => 'image|file',
            'vaksin' => 'image|file',
            'foto46' => 'image|file',
        ];
        $validatedData = $request->validate($rules);
        if($request->file('ktp')){
            if($request->oldktp){
                Storage::delete($request->oldktp);
            }
            $validatedData['ktp'] = $request->file('ktp')->store('dokumens-gambar');
        }
        if($request->file('passport')){
            if($request->oldpassport){
                Storage::delete($request->oldpassport);
            }
            $validatedData['passport'] = $request->file('passport')->store('dokumens-gambar');
        }
        if($request->file('kk')){
            if($request->oldkk){
                Storage::delete($request->oldkk);
            }
            $validatedData['kk'] = $request->file('kk')->store('dokumens-gambar');
        }
        if($request->file('vaksin')){
            if($request->oldvaksin){
                Storage::delete($request->oldvaksin);
            }
            $validatedData['vaksin'] = $request->file('vaksin')->store('dokumens-gambar');
        }
        if($request->file('foto46')){
            if($request->oldfoto46){
                Storage::delete($request->oldfoto46);
            }
            $validatedData['foto46'] = $request->file('foto46')->store('dokumens-gambar');
        }
        $user=auth()->user();
        $validatedData['edited_by'] = $user->name;
        Dokumens::where('user_id', $user->id)
            ->update($validatedData);
        return redirect('/dashboard')->with('success', 'Dokumen telah diperbarui');
    }

    public function passport_req(string $id){
        $transaksi = transaksi::where('id', $id)->first();
        return view('dashboard.anggota.utama.passport_req', [
            'transaksi' => $transaksi
        ]);
    }
    public function uploadreq(Request $request){
        $validatedData = $request->validate([
            'ktp' => 'image|file',
            'kk' => 'image|file',
            'akta' => 'image|file',
            'transaksi' => '',
            'jumlah' => '',
            'harga' => ''
        ]);

        $user = auth()->user();
        $validatedData['user_id'] = $user->id;
        if($request->file('ktp')){
            if($request->oldktp){
                Storage::delete($request->oldktp);
            }
            $validatedData['ktp'] = $request->file('ktp')->store('pass-gambar');
        }
        if($request->file('kk')){
            if($request->oldkk){
                Storage::delete($request->oldkk);
            }
            $validatedData['kk'] = $request->file('kk')->store('pass-gambar');
        }
        if($request->file('akta')){
            if($request->oldakta){
                Storage::delete($request->oldakta);
            }
            $validatedData['akta'] = $request->file('akta')->store('pass-gambar');
        }
        $user=auth()->user();
        if ($user->balance >= 500000) {
            $oldTransaction = transaksi::where('id', $validatedData['transaksi'])->first();
            if ($oldTransaction->pengajuan_passport === 'tidak') {
                deposit::create([
                    'user_id' => $user->id,
                    'jenis' => 'Pengajuan Passport',
                    'operasi' => 'kurang',
                    'jumlah' => $validatedData['jumlah'],
                ]);
            }
            if ($oldTransaction && $oldTransaction->pengajuan_passport === 'tidak') {
                // ambil nilai lama dari kolom jumlah dan total harga
                $oldJumlah = $oldTransaction->jumlah;
                $oldHarga = $oldTransaction->total_harga;
                // beri nilai baru pada kolom jumlah dan total harga
                $newJumlah = $oldJumlah + $validatedData['jumlah'];
                $newHarga = $oldHarga + $validatedData['jumlah'];

                // Update transaksi dengan nilai baru
                if ($newJumlah === $newHarga) {
                    transaksi::where('id', $validatedData['transaksi'])->update([
                        'jumlah' => $newJumlah,
                        'total_harga' => $newHarga,
                        'pengajuan_passport' => 'iya',
                        'status_pelunasan' => 'lunas',
                        'ktp' => $validatedData['ktp'],
                        'kk' => $validatedData['kk'],
                        'akta' => $validatedData['akta'],
                    ]);
                } else {
                    transaksi::where('id', $validatedData['transaksi'])->update([
                        'jumlah' => $newJumlah,
                        'total_harga' => $newHarga,
                        'pengajuan_passport' => 'iya',
                        'ktp' => $validatedData['ktp'],
                        'kk' => $validatedData['kk'],
                        'akta' => $validatedData['akta'],
                    ]);
                }
            }elseif ($oldTransaction && $oldTransaction->pengajuan_passport === 'iya') {
                transaksi::where('id', $validatedData['transaksi'])->update([
                    'pengajuan_passport' => 'iya',
                    'status_pelunasan' => 'lunas',
                    'ktp' => $validatedData['ktp'],
                    'kk' => $validatedData['kk'],
                    'akta' => $validatedData['akta'],
                ]);
            }
            // Redirect atau berikan respons sesuai hasil proses
            return redirect('/dashboard')->with('success', 'Pengajuan berhasil!');
        }else {
            // Redirect atau berikan respons jika saldo tidak mencukupi
            return redirect('/dashboard')->with('error', 'Saldo tidak mencukupi untuk melakukan pembelian paket.');
        }
    }

    public function isi(Request $request)
    {
        $rules = [
            'ktp' => '',
            'name' => '',
            'jenis_kelamin' => '',
            'tempat_lahir' => '',
            'alamat' => '',
            'RT' => 'max:255',
            'RW' => '',
            'kelurahan' => '',
            'kecamatan' => '',
            'kota' => '',
            'proponsi' => '',
            'hp' => '',
            'last_edu' => '',
            'pekerjaan' => '',
            'nama_darurat' => '',
            'alamat_darurat' => '',
            'kontak_darurat' => '',
            'tgl_lahir' => '',
            'no_passport' => '',
            'dissue' => '',
            'dexpiry' => '',
            'issuing_office' => '',
        ];
        $validatedData = $request->validate($rules);
        $user=auth()->user();
        $validatedData['edited_by'] = $user->name;
        member::where('user_id', $user->id)
            ->update($validatedData);
        return redirect('/dashboard')->with('success', 'Data diri telah Di update');
    }
    public function pembayaran(string $id){
        $transaksi = transaksi::findorfail($id);
        $paket = paket::where('id', $transaksi->paket_id)->first();
        return view('dashboard.anggota.utama.pembayaran', [
            'transaksi' => $transaksi,
            'paket' => $paket
        ]);
    }
    public function konfir_bayar(Request $request){
        $validatedData = $request->validate([
            'jumlah' => 'required',
            'transaksi' => '',
            'paket' => ''
        ]);
        $jumlah = preg_replace('/[^0-9]/', '', $validatedData['jumlah']); // Hapus semua karakter non-angka
        $validatedData['jumlah'] = $jumlah;
        $user = auth()->user();
        $validatedData['user_id'] = $user->id;
        // Pastikan pengguna memiliki saldo yang cukup
        if ($user->balance >= 0) {
            deposit::create([
                'user_id' => $user->id,
                'jenis' => 'Pembelian Paket',
                'operasi' => 'kurang',
                'jumlah' => $validatedData['jumlah'],
                'paket_id' => $validatedData['paket'],
                'status' => 'sukses'
            ]);
            $oldTransaction = transaksi::find($validatedData['transaksi']);
            if ($oldTransaction) {
                // Mengambil nilai lama dari kolom jumlah
                $oldJumlah = $oldTransaction->jumlah;

                // Melakukan operasi aritmatika (contoh: pengurangan)
                $newJumlah = $oldJumlah + $validatedData['jumlah'];

                // Update transaksi dengan nilai baru
                if ($newJumlah === $oldTransaction->total_harga) {
                    $oldTransaction->update([
                        'user_id' => $user->id,
                        'paket_id' => $validatedData['paket'],
                        'jumlah' => $newJumlah,
                        'status_pelunasan' => 'lunas'
                    ]);
                } else {
                    $oldTransaction->update([
                        'user_id' => $user->id,
                        'paket_id' => $validatedData['paket'],
                        'jumlah' => $newJumlah,
                    ]);
                }
            }
            // Redirect atau berikan respons sesuai hasil proses
            return redirect('/dashboard')->with('success', 'Konfirmasi pembayaran berhasil!');
        } else {
            // Redirect atau berikan respons jika saldo tidak mencukupi
            return redirect('/dashboard')->with('error', 'Saldo tidak mencukupi untuk melakukan pembelian paket.');
        }
    }

    public function cancel(string $id){
        $transaksi = transaksi::findorfail($id);
        // transaksi::where('id', $id)->update(['status_berangkat' => 'Batal']);
        deposit::create([
            'user_id' => auth()->user()->id,
            'jenis' => 'Refund',
            'operasi' => 'tambah',
            'jumlah' => $transaksi->jumlah,
            'paket_id' => $transaksi->paket_id
        ]);
        return redirect('/dashboard')->with('success', 'Menunggu persetujuan admin untuk dibatalkan'); 
    }
}

// return view('dashboard.deposit.index', compact('user', 'transaksi','paket','member'));