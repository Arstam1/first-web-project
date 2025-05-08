<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $with = ['user','paket'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function paket(){
        return $this->belongsTo(paket::class);
    }
    public function perlengkapan(){
        return $this->hasMany(perlengkapan::class);
    }
}
