<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function member(){
        return $this->belongsTo(member::class);
    }
    public function paket(){
        return $this->belongsTo(paket::class);
    }
}
