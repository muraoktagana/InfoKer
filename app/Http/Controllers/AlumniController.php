<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumniController extends Controller
{
    public function show()
    {
        $data['alumni'] = Alumni::all();
        return view('alumni.alumni', $data);
    }

    public function profil($nisn)
    {
        $data['alumni'] = Alumni::find($nisn);
        $data['jurusan']=Jurusan::all();
        return view('alumni.profil', $data);
    }

    public function uploadFoto(Request $request,  $nisn)
    {
        $nama = Alumni::find($nisn);
        $filename = $nama->nama_lengkap . '.' . $request->foto_profil->extension();
        Alumni::find($nisn)->update([
            'foto_profil' => $request->file('foto_profil')->storeAs($filename)
        ]);

        if(Auth::user()->level == 'admin'){
            return redirect('alumni-profil' . $nisn)->with('success', 'Upload foto berhasil');
        }
        return redirect('profil')->with('success', 'Upload foto berhasil');

    }

    public function updateProfil(Request $request, $user_id)
    {
        User::where('id', $user_id)->update([
            'name' => $request->username,
        ]);

        Alumni::where('nisn', $request->nisn)->update([
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jurusan' => $request->jurusan,
            'tahun_kelulusan' => $request->tahun_kelulusan,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
        ]);
        
        if(Auth::user()->level == 'admin'){
            return redirect('alumni-profil' . $request->nisn)->with('success', 'Data Berhasil Diubah');
        }
        return redirect('profil')->with('success', 'Data Berhasil Diubah');
        
    }

    public function add()
    {
        $jurusan['jurusan'] = Jurusan::all();
        return view('alumni.add', $jurusan);
    }

    public function create(Request $request)
    {
        $findEmail = User::where('email', $request->email)->first();

        if (!$findEmail) {
            $data = User::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'level' => 'alumni',
            ]);
            
            $findNISN = Alumni::where('nisn', $request->nisn)->first();

            if (!$findNISN) {
                $simpan = Alumni::create([
                    'user_id' => $data->id,
                    'nisn' => $request->nisn,
                    'nama_lengkap' => $request->nama_lengkap,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'jurusan' => $request->jurusan,
                    'tahun_kelulusan' => $request->tahun_kelulusan,
                    'kontak' => $request->kontak,
                    'alamat' => $request->alamat,
                ]);
            } else {
                User::find($data->id)->delete();
                return redirect()->back()->with('error', 'NISN sudah terdaftar.')->withInput();
            }
        } else {
            return redirect()->back()->with('error', 'Email sudah terdaftar.')->withInput();
        }


        if ($simpan) {
            return redirect('/alumni')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->back()->with(['error' => 'Data Gagal Disimpan'])->withInput();
        }
    }
}
