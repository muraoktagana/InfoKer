<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function show(){
        $data['jurusan']=Jurusan::all();
        return view('jurusan.jurusan', $data);
    }

    public function create(Request $request){
        $find=Jurusan::where('jurusan', $request->jurusan)->first();
        if(!$find) {
            Jurusan::create($request->all());
            return redirect('/jurusan')->with('success','Jurusan Berhasil Ditambahkan');
        }else{
            return back()->with('error','Gagal! Jurusan Sudah Terdaftar');
        }
    }
}
