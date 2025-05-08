<?php

namespace App\Http\Controllers;

use App\Models\deposit;
use App\Models\paket;
use App\Models\Kategori;
use App\Models\perlengkapan;
use App\Models\transaksi;
use App\Models\member;
use App\Models\dokumens;
use App\Models\User;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Facades\DB;

function getColumns(string $tableName): array {
    return DB::getSchemaBuilder()->getColumnListing($tableName);
}

class DashboardPaketsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        return view('dashboard.pakets.index',[
            "pakets" => paket::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        return view('dashboard.pakets.create',[
            'Kategoris' => Kategori::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'slug' => 'required|unique:pakets',
            'kategori_id' => 'required',
            'harga' => 'required',
            'triple' => '',
            'duo' => '',
            'durasi' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|file|max:1024',
            'tanggal_berangkat' => 'required',
            'seat' => 'required|numeric'
        ]);

        $harga = preg_replace('/[^0-9]/', '', $validatedData['harga']); // Hapus semua karakter non-angka
        $validatedData['harga'] = $harga;
        $triple = preg_replace('/[^0-9]/', '', $validatedData['triple']); // Hapus semua karakter non-angka
        $validatedData['triple'] = $triple;
        $duo = preg_replace('/[^0-9]/', '', $validatedData['duo']); // Hapus semua karakter non-angka
        $validatedData['duo'] = $duo;
        $validatedData['total_seat'] = $validatedData['seat'];

        if($request->file('gambar')){
            $validatedData['gambar'] = $request->file('gambar')->store('paket-gambar');
        }

        paket::create($validatedData);
        return redirect('/dashboard/pakets')->with('success', 'Paket baru telah dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(paket $paket)
    {
        return view('dashboard.pakets.show', [
            'paket' => $paket
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(paket $paket)
    {
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        return view('dashboard.pakets.edit',[
            'paket' => $paket,
            'Kategoris' => Kategori::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, paket $paket)
    {
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        $rules = [
            'nama' => 'required|max:255',
            'kategori_id' => 'required',
            'harga' => 'required',
            'triple' => '',
            'duo' => '',
            'durasi' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|file|max:1024',
            'tanggal_berangkat' => 'required',
            'total_seat' => '',
        ];

        if($request->slug != $paket->slug){
            $rules['slug'] = 'required|unique:pakets';
        }
        $validatedData = $request->validate($rules);

        $harga = preg_replace('/[^0-9]/', '', $validatedData['harga']); // Hapus semua karakter non-angka
        $validatedData['harga'] = $harga;
        $triple = preg_replace('/[^0-9]/', '', $validatedData['triple']); // Hapus semua karakter non-angka
        $validatedData['triple'] = $triple;
        $duo = preg_replace('/[^0-9]/', '', $validatedData['duo']); // Hapus semua karakter non-angka
        $validatedData['duo'] = $duo;
        $transaksi = transaksi::where('paket_id', $paket->id)->get();
        $seat = $validatedData['total_seat'] - count($transaksi);
        $validatedData['seat'] = $seat;
        // $seat = $validatedData['seat'];
        if($request->file('gambar')){
            if($request->oldGambar){
                Storage::delete($request->oldGambar);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('paket-gambar');
        }

        paket::where('id', $paket->id)
            ->update($validatedData);
        return redirect('/dashboard/pakets')->with('success', 'Paket telah diubah');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(paket $paket)
    {
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        if($paket->gambar){
            Storage::delete($paket->gambar);
        }
        paket::destroy($paket->id);
        return redirect('/dashboard/pakets')->with('success', 'Paket telah dihapus!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(paket::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
    public function booking($paket){
        return view('dashboard.pakets.booking',[
        "paket" => paket::where("slug", $paket)->first()
        ]);
    }
    
    public function konfirmasi(Request $request)
    {
        $validatedData = $request->validate([
            'jumlah' => 'required',
            'paket' => '',
            'harga' => 'required',
            'harga_id' => '',
            'pengajuan_passport' => '',
            'biaya_tambahan' => ''
        ]);
        $user = auth()->user();
        $validatedData['user_id'] = $user->id;

        $jumlah = preg_replace('/[^0-9]/', '', $validatedData['jumlah']); // Hapus semua karakter non-angka
        $validatedData['jumlah'] = $jumlah;

        $hargaId = $validatedData['harga_id'];
        $totalBiaya = $validatedData['harga'] + $validatedData['biaya_tambahan'];
        // Mendeklarasikan variabel tipeKamar yang akan diisi sesuai dengan hargaId yang dipilih
        $tipeKamar = '';
        // Kondisi untuk menentukan tipe kamar berdasarkan nilai hargaId
        if ($hargaId === 'quad') {
            $tipeKamar = 'quad';
        } elseif ($hargaId === 'triple') {
            $tipeKamar = 'triple';
        } elseif ($hargaId === 'duo') {
            $tipeKamar = 'duo';
        }

        $pengajuanPassport = $request->has('pengajuan_passport');
        // Pastikan pengguna memiliki saldo yang cukup
        if ($user->balance >= 5000000 && $validatedData['jumlah'] >= 5000000) {
            $paket = Paket::find($validatedData['paket']);
            $paket->update(['seat' => $paket->seat-1]);
            deposit::create([
                'user_id' => $user->id,
                'operasi' => 'kurang',
                'jumlah' => $validatedData['jumlah'],
                'paket_id' => $validatedData['paket'],
                'jenis' => 'Pembelian Paket',
                'status' => 'sukses',
            ]);
            // Tandai transaksi sebagai berhasil
            if ($validatedData['jumlah'] == $totalBiaya) {
                $t=transaksi::create([
                    'user_id' => $user->id,
                    'paket_id' => $validatedData['paket'],
                    'jumlah' => $validatedData['jumlah'],
                    'total_harga' => $totalBiaya,
                    'status_pelunasan' => 'lunas',
                    'tipe_kamar' => $tipeKamar,
                    'pengajuan_passport' => $pengajuanPassport ? 'iya' : 'tidak'
                ]);
            } else {
                $t=transaksi::create([
                    'user_id' => $user->id,
                    'paket_id' => $validatedData['paket'],
                    'jumlah' => $validatedData['jumlah'],
                    'total_harga' => $totalBiaya,
                    'tipe_kamar' => $tipeKamar,
                    'pengajuan_passport' => $pengajuanPassport ? 'iya' : 'tidak'
                ]);
            }
            perlengkapan::create([
                'user_id' => $user->id,
                'paket_id' => $validatedData['paket'],
                'transaksi_id' => $t->id
            ]);
            // Redirect atau berikan respons sesuai hasil proses
            return redirect('/dashboard')->with('success', 'Konfirmasi pembayaran berhasil!');
        } else {
            // Redirect atau berikan respons jika saldo tidak mencukupi
            return redirect('/dashboard')->with('error', 'Saldo tidak mencukupi untuk melakukan pembelian paket.');
        }
    }
    public function manifest(string $slug){
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        // $pakets = paket::where("slug", $paket)->first();
        $pakets = paket::where("slug", $slug)->first();
        $transaksi = transaksi::where("paket_id", $pakets->id)->get();
        return view('dashboard.admin.manifest', [
            'transaksi' => $transaksi,
            'paket' => $pakets
        ]);
    }

    public function lengkap(string $slug){
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        // $pakets = paket::where("slug", $paket)->first();
        $pakets = paket::where("slug", $slug)->first();
        $lengkap = perlengkapan::where("paket_id", $pakets->id)->get();
        return view('dashboard.admin.lengkap', [
            'lengkap' => $lengkap,
            'paket' => $pakets
        ]);
    }
    public function berangkat(string $slug){
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        $paket = paket::where('slug',$slug)->first();
        $transaksis=transaksi::where('paket_id', $paket->id)->get();
        // $dokumenIncomplete = dokumens::where('user_id', $transaksi->user_id)->where(function ($query) {
        //     $columns = getColumns('dokumens'); // Ganti 'dokumens' dengan nama tabel Anda
        //     foreach ($columns as $column) {
        //         $query->orWhereNull($column);
        //     }
        // })->exists();

        foreach ($transaksis as $transaksi){
            $dokumenIncomplete = dokumens::where('user_id', $transaksi->user_id)->where(function ($query) {
                $columns = getColumns('dokumens'); // Ganti 'dokumens' dengan nama tabel Anda
                foreach ($columns as $column) {
                    $query->orWhereNull($column);
                }})->exists();
            $memberIncomplete = Member::where('user_id', $transaksi->user_id)->where(function ($query) {
                $columns = getColumns('members'); // Tabel members
                foreach ($columns as $column) {
                    $query->orWhereNull($column);
                }})->exists();

            if ($transaksi->status_pelunasan == 'belum lunas' || $dokumenIncomplete || $memberIncomplete) {
                deposit::create([
                    'user_id' => $transaksi->user_id,
                    'jenis' => 'Refund',
                    'operasi' => 'tambah',
                    'jumlah' => $transaksi->jumlah,
                    'paket_id' => $transaksi->paket_id,
                    'status' => 'sukses'
                ]);
            }
            transaksi::where('paket_id', $paket->id)->where('status_pelunasan','belum lunas')->update(['status_berangkat' => 'batal']);
        }
        transaksi::where('paket_id', $paket->id)->where('status_pelunasan','lunas')->update(['status_berangkat' => 'dalam perjalanan']);
        return redirect('/dashboard')->with('success', 'telah berangkat'); 
    }
    public function pulang(string $slug){
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        $paket = paket::where('slug',$slug)->first();
        $transaksis=transaksi::where('paket_id', $paket->id)->get();

        transaksi::where('paket_id', $paket->id)->where('status_berangkat','dalam perjalanan')->update(['status_berangkat' => 'pulang']);
        return redirect('/dashboard/pakets')->with('success', 'Jama ah telah kembali ke tanah air'); 
    }
}