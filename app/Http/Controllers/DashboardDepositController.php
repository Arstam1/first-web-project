<?php

namespace App\Http\Controllers;
use App\Models\deposit;
use App\Models\User;
use App\Models\transaksi;
use App\Mail\kirimEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardDepositController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Mengambil informasi user yang sedang login

        if ($user->is_admin === 1) {
            $transactions = deposit::query();
            // $searchTerm = request('search');
            // if ($searchTerm) {
            //     $transactions->where('jenis', 'like', '%' . $searchTerm . '%')
            //     ->orWhereHas('user', function ($query) use ($searchTerm) {
            //         $query->where('name', 'like', '%' . $searchTerm . '%');
            //     });
            // }

            // $transactions = $transactions->get();

            // Filter berdasarkan entri
            $entries = request('entries');
            if ($entries) {
                $transactions->take($entries);
            }

            // Filter berdasarkan status
            $status = request('status');
            if ($status) {
                $transactions->where('status', $status);
            }

            // Filter berdasarkan tanggal dibuat (created_at)
            $createdAt = request('created_at');
            if ($createdAt) {
                $transactions->whereDate('created_at', $createdAt);
            }

            // Filter berdasarkan jumlah
            $jumlah = preg_replace('/[^0-9]/', '', request('jumlah')); // Hapus semua karakter non-angka
            // $jumlah = ;
            if ($jumlah) {
                $transactions->where('jumlah', 'like', '%' . $jumlah . '%');
            }

            // Filter berdasarkan jenis
            $jenis = request('jenis');
            if ($jenis) {
                $transactions->where('jenis', 'like', '%' . $jenis . '%');
            }

            // Filter berdasarkan nama pengguna (user)
            $user1 = request('user');
            if ($user1) {
                $transactions->whereHas('user', function ($query) use ($user1) {
                    $query->where('name', 'like', '%' . $user1 . '%');
                });
            }

            // Jika Anda masih ingin mempertahankan pencarian umum
            // $searchTerm = request('search');
            // if ($searchTerm) {
            //     $transactions->where('jenis', 'like', '%' . $searchTerm . '%')
            //         ->orWhereHas('user', function ($query) use ($searchTerm) {
            //             $query->where('name', 'like', '%' . $searchTerm . '%');
            //         });
            // }
            // Penanganan pengurutan
            $order_by = request('order_by');
            $order_dir = request('order_dir');

            if ($order_by && $order_dir) {
                $transactions->orderBy($order_by, $order_dir);
            }
            // Eksekusi query dan dapatkan hasilnya
            $transactions = $transactions->get();

            $totalDeposit = deposit::where('status', 'sukses')->where('operasi', 'tambah')->sum('jumlah');
            $totalWithdraw = deposit::where('status', 'sukses')->where('operasi', 'kurang')->sum('jumlah');
            $totalBalance = $totalDeposit - $totalWithdraw;

            User::where('id', $user->id)->update(['balance' => $totalBalance]);
        } else {
            $totalDeposit = deposit::where('user_id', $user->id)->where('status', 'sukses')->where('operasi', 'tambah')->sum('jumlah');
            $totalWithdraw = deposit::where('user_id', $user->id)->where('status', 'sukses')->where('operasi', 'kurang')->sum('jumlah');
            $totalBalance = $totalDeposit - $totalWithdraw;

            User::where('id', $user->id)->update(['balance' => $totalBalance]);
            $transactions = deposit::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        }

        return view('dashboard.deposit.index', [
            'totalBalance' => $totalBalance,
            'transactions' => $transactions,
            'user' => $user
        ]);
    }
    
    public function cancel(string $id){
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        $deposit = deposit::where('id', $id)->first();
        // Mail::to($deposit->user->email)->send(new kirimEmail());
        $deposit->update(['status' => 'gagal']);
        return redirect('/dashboard/deposit')->with('success', 'Transaksi Digagalkan');
    }

    public function confirm(string $id){
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        $deposit = deposit::where('id', $id)->first();
        if ($deposit->jenis === 'Refund') {
            // $user = User::where('id', $deposit->user_id)->first();
            transaksi::where('user_id', $deposit->user_id)->where('paket_id', $deposit->paket_id)->update(['status_berangkat' => 'batal']);
            // paket::where('id', $deposit->paket_id)->update(['seat'=>])
        }
        // Mail::to($deposit->user->email)->send(new kirimEmail());
        $deposit->update(['status' => 'sukses']);
        return redirect('/dashboard/deposit')->with('success', 'Transaksi diterima'); 
    }
    
    public function depo()
    {
        return view('dashboard.deposit.deposit');
    }

    public function tarik()
    {
        return view('dashboard.deposit.withdraw');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jumlah' => 'required',
            'payment_proof' => 'image|file|max:1024',
            'jenis' => 'required',
            'operasi' => 'required',
        ]);
        $jumlah = preg_replace('/[^0-9]/', '', $validatedData['jumlah']); // Hapus semua karakter non-angka
        $validatedData['jumlah'] = $jumlah;
        $validatedData["user_id"] = auth()->user()->id;
        if($request->file('payment_proof')){
            $validatedData['payment_proof'] = $request->file('payment_proof')->store('proof');
        }

        deposit::create($validatedData);
        // mail('ahmadriqas99@gmail.com', 'ada deposit masuk','depositku');
        Mail::to("ahmadriqas99@gmail.com")->send(new kirimEmail());
        return redirect('/dashboard/deposit')->with('success', 'deposit telah dibuat');
    }

    public function withdraw(Request $request)
    {
        $validatedData = $request->validate([
            'jumlah' => 'required',
            'jenis' => 'required',
            'operasi' => 'required',
        ]);
        $jumlah = preg_replace('/[^0-9]/', '', $validatedData['jumlah']); // Hapus semua karakter non-angka
        $validatedData['jumlah'] = $jumlah;
        $validatedData["user_id"] = auth()->user()->id;
        deposit::create($validatedData);
        // Mail::to("ahmadriqas99@gmail.com")->send(new kirimEmail());
        return redirect('/dashboard/deposit')->with('success', 'Penarikapn telah dibuat');
    }
}
