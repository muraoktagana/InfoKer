<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alumni-add</title>
    @extends('navigasi')
</head>

<body>
    @section('content')
        <!-- // Basic multiple Column Form section start -->
        @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible show fade">
                <i class="bi bi-check-circle"></i> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (Session::get('error'))
            <div class="alert alert-danger alert-dismissible show fade">
                <i class="bi bi-exclamation-triangle"></i> {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form pendaftaran alumni</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" action="/alumni-add" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="nisn">NISN</label>
                                                    <input type="text" id="nisn" class="form-control" name="nisn"
                                                        value="{{ old('nisn') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="nama_lengkap">Nama lengkap</label>
                                                    <input type="text" id="nama_lengkap" class="form-control"
                                                        name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="jenis_kelamin">Jenis kelamin</label>
                                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                                        <option value="laki_laki"
                                                            @if (old('jenis_kelamin') == 'laki_laki') selected @endif>Laki-laki
                                                        </option>
                                                        <option value="perempuan"
                                                            @if (old('jenis_kelamin') == 'perempuan') selected @endif>Perempuan
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="jurusan">Jurusan</label>
                                                <div class="form-group">
                                                    <select class="choices form-select" id="jurusan" name="jurusan">
                                                        @foreach ($jurusan as $jurusan)
                                                            <option value="{{ $jurusan->jurusan }}" 
                                                            {{ old('jurusan')==$jurusan->jurusan ? 'selected' : '' }}>
                                                                {{ $jurusan->jurusan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="tahun_kelulusan">Tahun kelulusan</label>
                                                    <input type="number" id="tahun_kelulusan" class="form-control"
                                                        name="tahun_kelulusan" value="{{ old('tahun_kelulusan') }}"
                                                        required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" id="username" class="form-control"
                                                        name="username" value="{{ old('username') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" class="form-control" name="email"
                                                        value="{{ old('email') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" id="password" class="form-control"
                                                        name="password" value="{{ old('password') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="kontak">Nomor Kontak</label>
                                                    <input type="number" id="kontak" class="form-control"
                                                        name="kontak" value="{{ old('kontak') }}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <input type="text" id="alamat" class="form-control"
                                                        name="alamat" value="{{ old('alamat') }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- // Basic multiple Column Form section end -->
    @endsection
</body>

</html>
