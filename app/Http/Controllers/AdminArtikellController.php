<?php

namespace App\Http\Controllers;

use App\Models\artikell;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class AdminArtikellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        return view('dashboard.admin.artikel.index',[
            "artikel" => artikell::all()
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
        return view('dashboard.admin.artikel.create');
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
            'judul' => 'required|max:255',
            'slug' => 'required|unique:artikells',
            'body' => 'required',
            'gambar' => 'image|file|max:1024',
        ]);

        if($request->file('gambar')){
            $validatedData['gambar'] = $request->file('gambar')->store('artikel-gambar');
        }

        artikell::create($validatedData);
        return redirect('/dashboard/artikel')->with('success', 'Artikel baru telah dibuat');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(artikell::class, 'slug', $request->judul);
        return response()->json(['slug' => $slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(artikell $artikel)
    {
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        return view('dashboard.admin.artikel.show', [
            'artikel' => $artikel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(artikell $artikel)
    {
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        return view('dashboard.admin.artikel.edit',[
            'artikel' => $artikel
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, artikell $artikel)
    {
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        $rules = [
            'judul' => 'required|max:255',
            'body' => 'required',
            'gambar' => 'image|file|max:1024',
        ];

        if($request->slug != $artikel->slug){
            $rules['slug'] = 'required|unique:artikells';
        }
        $validatedData = $request->validate($rules);
        if($request->file('gambar')){
            if($request->oldGambar){
                Storage::delete($request->oldGambar);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('artikel-gambar');
        }
        artikell::where('id', $artikel->id)
            ->update($validatedData);
        return redirect('/dashboard/artikel')->with('success', 'Artikel telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(artikell $artikel)
    {
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        if($artikel->gambar){
            Storage::delete($artikel->gambar);
        }
        artikell::destroy($artikel->id);
        return redirect('/dashboard/artikel')->with('success', 'Artikel telah dihapus!');
    }
}
