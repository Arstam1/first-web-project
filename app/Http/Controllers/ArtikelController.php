<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\artikell;

class ArtikelController extends Controller
{
    public function index(){
        return view('article', [
            "artikel" => artikell::all()
        ]);
    }

    public function show(String $artikell){
        return view('post',[
            "artikel" => artikell::where("slug", $artikell)->first()
        ]);
    }
}
