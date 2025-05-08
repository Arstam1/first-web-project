<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perlengkapan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function paket(){
        return $this->belongsTo(paket::class);
    }
    public function transaksi(){
        return $this->belongsTo(transaksi::class);
    }
}
