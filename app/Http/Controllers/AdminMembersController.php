<?php

namespace App\Http\Controllers;
use App\Models\member;
use App\Models\dokumens;
use App\Models\perlengkapan;
use App\Models\transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AdminMembersController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        return view('dashboard.membering.index', [
            'members' => member::all()
        ]);
    }

    public function show(string $email)
    {
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        $user = User::where('email', $email)->first();
        $member = member::where('user_id', $user->id)->first();
        $dokumen = dokumens::where('user_id', $user->id)->first();
        return view('dashboard.admin.showm', [
            'member' => $member,
            'dokumen' => $dokumen
        ]);
    }

    public function formulir(string $email){
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        $user = User::where('email', $email)->first();
        $member = member::where('user_id', $user->id)->first();
        return view('dashboard.admin.formulir',[
            'member' => $member
        ]);
    }

    public function dokumen(string $email){
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        $user = User::where('email', $email)->first();
        $dokumens = dokumens::where('user_id', $user->id)->first();
        return view('dashboard.admin.dokumen', [
            'dokumens' => $dokumens
        ]);
    }

    public function isi(Request $request)
    {
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        $rules = [
            'ktp' => '',
            'name' => '',
            'jenis_kelamin' => '',
            'tempat_lahir' => '',
            'alamat' => '',
            'RT' => 'max:255',
            'RW' => '',
            'kelurahan' => '',
            'kecamatan' => '',
            'kota' => '',
            'proponsi' => '',
            'hp' => '',
            'last_edu' => '',
            'pekerjaan' => '',
            'nama_darurat' => '',
            'alamat_darurat' => '',
            'kontak_darurat' => '',
            'tgl_lahir' => '',
            'no_passport' => '',
            'dissue' => '',
            'dexpiry' => '',
            'issuing_office' => '',
        ];
        $validatedData = $request->validate($rules);
        $user1=auth()->user();
        $email = $request->email;
        $user2=User::where('email', $email)->first();
        $validatedData['edited_by'] = $user1->name;
        member::where('user_id', $user2->id)
            ->update($validatedData);
        return redirect('/dashboard/member/'.$email)->with('success', 'Data Member telah Di update');
    }

    public function isidoc(Request $request){
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        $rules = [
            'passport' => 'image|file',
            'foto46' => 'image|file',
        ];
        $validatedData = $request->validate($rules);
        if($request->file('passport')){
            if($request->oldpassport){
                Storage::delete($request->oldpassport);
            }
            $validatedData['passport'] = $request->file('passport')->store('dokumens-gambar');
        }
        if($request->file('foto46')){
            if($request->oldfoto46){
                Storage::delete($request->oldfoto46);
            }
            $validatedData['foto46'] = $request->file('foto46')->store('dokumens-gambar');
        }
        $user1=auth()->user();
        $email = $request->email;
        $user2=User::where('email', $email)->first();
        $validatedData['edited_by'] = $user1->name;
        Dokumens::where('user_id', $user2->id)
            ->update($validatedData);
        return redirect('/dashboard/member')->with('success', 'Dokumen telah diperbarui');
    }

    #perlengkapan
    public function pelengkap(string $slug, string $id){
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        $lengkap = perlengkapan::findorfail($id);
        return view('dashboard.admin.pelengkap',[
            'lengkap' => $lengkap
        ]);
    }

    public function lengkapi(request $request){
        if (auth()->user()->is_admin == 0) {
            abort(403);
        }
        $rules = [
            'status_visa' => '',
            'status_tiket' => ''
        ];
        $rules1 = [
            'batik' => '',
            'ihram' => '',
            'tpasport' => '',
            'tsandal' => '',
            'syal' => '',
            'koper' => '',
            'buku' => ''
        ];
        $validatedData = $request->validate($rules1);
        $Datavalid = $request->validate($rules);
        $id = $request->id;
        perlengkapan::where('id', $id)->update($validatedData);
        transaksi::where('id', $id)->update($Datavalid);
        return redirect('/dashboard/pakets')->with('success', 'Perlengkapan telah diperbarui');
    }
}