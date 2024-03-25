<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LowonganController extends Controller
{
    public function show()
    {
        $data['lowongan'] = Lowongan::all();
        
        // Loop melalui setiap lowongan dan pecah string tag menjadi array
        foreach ($data['lowongan'] as $lowongan) {
            $lowongan->tags = explode(',', $lowongan->tag);
        }

        return view('lowongan_pekerjaan.daftar_pengajuan', $data);
    }

    public function add()
    {
        return view('lowongan_pekerjaan.form_pengajuan');
    }

    public function create(Request $request)
    {
        if ($request->deskripsi === "<p><br></p>") {
            return redirect()->back()->with(['error' => 'Minimal isi deskripsi'])->withInput();
        };
        if (!isset($request->tag)) {
            return redirect()->back()->with(['error' => 'Minimal isi tag'])->withInput();
        };

        // Loop melalui setiap file yang diunggah dan simpan ke penyimpanan yang ditentukan
        $filesPaths = [];
        if (isset($request->file)) {
            foreach ($request->file('file') as $file) {
                $path = $file->storeAs($file->getClientOriginalName());
                $filesPaths[] = $path;
            }
        }

        if (Auth::user()->level == 'alumni') {
            $status = "non_active";
        } else {
            $status = "active";
        }

        $perusahaan= Perusahaan::create([
            'nama_perusahaan'=>$request->nama_perusahaan,
            'alamat_perusahaan'=>$request->alamat_perusahaan,
        ]);

        if(Auth::user()->level=='alumni'){
            $alumni_nisn= Auth::user()->alumni->nisn;
        }else{
            $alumni_nisn= null;
        }

        // Buat entri baru di dalam tabel lowongan dengan menggunakan model Lowongan
        $data = Lowongan::create([
            'judul' => $request->judul,
            'lokasi_kerja' => $request->lokasi_kerja,
            'deskripsi' => $request->deskripsi,
            'tag' => $request->tag,
            'file' => implode(',', $filesPaths), // Simpan path file sebagai string JSON
            'waktu_posting' => now(),
            'status' => $status,
            'alumni_nisn' => $alumni_nisn,
            'perusahaan_id' => $perusahaan->id,
        ]);

        if (isset($data)) {
            if(Auth::user()->level=='admin'){
                return redirect('/lowongan_pekerjaan')->with(['success' => 'Lowongan berhasil dikirim'])->withInput();
            }elseif(Auth::user()->level=='alumni'){
                return redirect('/pengajuan')->with(['success' => 'Lowongan berhasil dikirim'])->withInput();
            }
        };

        return back()->withInput()->with(['error' => 'Data gagal disimpan!']);
    }

    public function edit($id){
        $data['lowongan']=Lowongan::where('id', $id)->first();
        return view('lowongan_pekerjaan.form_edit_pengajuan', $data);
    }

    public function update(Request $request, $id){
        $data=Lowongan::find($id);

        $files = [];
        if(!empty($request->file)){
            foreach ($request->file('file') as $file) {
                $path = $file->storeAs($file->getClientOriginalName());
                $files[] = $path;
            }
        }elseif(empty($request->file)){
            foreach(explode(',', $data->file) as $file){
                $files[] = $file;
            }
        }

        Perusahaan::where('id',  $data->perusahaan_id)->update([
            'nama_perusahaan'=>$request->nama_perusahaan,
            'alamat_perusahaan'=>$request->alamat_perusahaan,
        ]);

        Lowongan::where('id', $id)->update([
            'judul' => $request->judul,
            'lokasi_kerja' => $request->lokasi_kerja,
            'deskripsi' => $request->deskripsi,
            'tag' => $request->tag,
            'file' => implode(',', $files), // Simpan path file sebagai string JSON
            'waktu_posting' => now(),
        ]);

        if (Auth::user()->level == "admin"){
            return redirect('/lowongan_pekerjaan')->with('success','Data berhasil diupdate');
        }else{
            return redirect('/pengajuan')->with('success','Data berhasil diupdate');
        }
    }

    public function statusChanger(Request $request, $id){
        Lowongan::where('id', $id)->update([
            'status'=>$request->status,
        ]);
        if( $request->status == "non_active"){
            return redirect()->back()->with('success', 'Lowongan berhasil ditutup');
        }elseif($request->status == "active"){
            return redirect()->back()->with('success', 'Lowongan berhasil dibuka');
        }
    }

    public function remove($id){
        Lowongan::find($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
