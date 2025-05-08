<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class paket extends Model
{
    use HasFactory, sluggable;
    protected $guarded = ['id'];
    protected $with = ['kategori'];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function transaksi(){
        return $this->hasMany(transaksi::class);
    }
    public function perlengkapan(){
        return $this->hasMany(perlengkapan::class);
    }
    // public function status(){
    //     return $this->hasMany(status::class);
    // }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }
}
