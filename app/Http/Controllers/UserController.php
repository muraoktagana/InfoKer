<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Jurusan;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profil(){
        $data['alumni']=Alumni::where('nisn', Auth::user()->alumni->nisn)->first();
        $data['jurusan']=Jurusan::all();
        return view ('user.profil', $data);
    }

    public function show(){
        $data['lowongan'] = Lowongan::where('status', 'active')->get();
        
        // Loop melalui setiap lowongan dan pecah string tag menjadi array
        foreach ($data['lowongan'] as $lowongan) {
            $lowongan->tags = explode(',', $lowongan->tag);
        }

        return view('user.dashboard', $data);
    }

    public function search(Request $request){
        $data['lowongan'] = Lowongan::where('judul', 'like', "%{$request->search}%")->get();
        
        // Loop melalui setiap lowongan dan pecah string tag menjadi array
        foreach ($data['lowongan'] as $lowongan) {
            $lowongan->tags = explode(',', $lowongan->tag);
        }

        return view('user.dashboard', $data);
    }

    public function showPengajuan(){
        $data['lowongan'] = Lowongan::where('alumni_nisn', Auth::user()->alumni->nisn)->get();
        
        // Loop melalui setiap lowongan dan pecah string tag menjadi array
        foreach ($data['lowongan'] as $lowongan) {
            $lowongan->tags = explode(',', $lowongan->tag);
        }

        return view('user.pengajuan.daftar_pengajuan', $data);
    }

    public function formPengajuan(){
        return view('user.pengajuan.form_pengajuan');
    }

    public function formEdit($id){
        $data['lowongan']=Lowongan::where('id', $id)->first();
        return view('user.pengajuan.form_edit_pengajuan', $data);
    }

}
