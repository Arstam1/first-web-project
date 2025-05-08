<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CekBayar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cek-bayar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pembatalan otomatis transaksi yang tidak lunas';


    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {

        $targetDate = Carbon::now()->subDays(21);

        // Query untuk mendapatkan transaksi yang belum dilunasi
        $transaksi = DB::table('transaksis')
            ->join('pakets', 'transaksis.paket_id', '=', 'pakets.id')
            ->join('users', 'transaksis.user_id', '=', 'users.id')
            ->where('transaksis.status_pelunasan', '!=', 'lunas')
            ->whereDate('pakets.tanggal_berangkat', '=', $targetDate->toDateString())
            ->select('transaksis.id')
            ->get();

        // Batalkan transaksi
        foreach ($transaksi as $item) {
            DB::table('transaksis')
                ->where('id', $item->id)
                ->update(['status_berangkat' => 'batal']);
            $this->info("Transaksi dengan ID {$item->id} telah dibatalkan");
        }
    }
}
