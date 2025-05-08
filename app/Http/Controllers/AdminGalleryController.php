<?php

namespace App\Http\Controllers;

use App\Models\gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        return view('dashboard.admin.gallery.index',[
            "gallery" => gallery::all()
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
        return view('dashboard.admin.gallery.create');
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
            'keterangan' => 'required|max:255',
            'gambar' => 'image|file',
        ]);

        if($request->file('gambar')){
            $validatedData['gambar'] = $request->file('gambar')->store('gallery-gambar');
        }

        gallery::create($validatedData);
        return redirect('/dashboard/gallery')->with('success', 'Gallery baru telah dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(gallery $gallery)
    {
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        if($gallery->gambar){
            Storage::delete($gallery->gambar);
        }
        gallery::destroy($gallery->id);
        return redirect('/dashboard/gallery')->with('success', 'gallery telah dihapus!');
    }
}
