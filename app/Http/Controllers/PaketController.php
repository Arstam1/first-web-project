<?php

namespace App\Http\Controllers;

use App\Models\paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index(){
        return view('paket', [
            "pakets" => paket::all()
        ]);
    }

    public function show(String $paket){
        return view('detail_p',[
            "pakets" => paket::where("slug", $paket)->first()
        ]);
    }
}