<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deposit extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['user'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
