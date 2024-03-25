<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alumni</title>
    @extends('navigasi')
</head>

<body>
    @section('content')
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-8 order-md-1 order-last">
                        <!-- // Basic multiple Column Form section start -->
                        @if (Session::get('success'))
                            <div class="alert alert-success alert-dismissible show fade">
                                <i class="bi bi-check-circle"></i> {{ Session::get('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif (Session::get('error'))
                            <div class="alert alert-danger alert-dismissible show fade">
                                <i class="bi bi-exclamation-triangle"></i> {{ Session::get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-md-4 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">DataTable jQuery</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">
                            jQuery Datatable
                        </h5>

                        <a href="/alumni-add">
                            <button class="btn rounded-pill icon icon-left btn-primary d-flex align-items-center">
                                <i data-feather="plus-circle"></i>Tambah Data
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Jurusan</th>
                                        <th>Kontak</th>
                                        <th>Tahun lulus</th>
                                        <th style="width: 5%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alumni as $alumni)
                                        <tr>
                                            <td><img src="storage/{{ $alumni->foto_profil }}" width="50" height="50" alt=""></td>
                                            <td>{{ $alumni->nama_lengkap }}</td>
                                            <td>{{ $alumni->user->email }}</td>
                                            <td>{{ $alumni->jurusan }}</td>
                                            <td>{{ $alumni->kontak }}</td>
                                            <td>{{ $alumni->tahun_kelulusan }}</td>
                                            <td>
                                                <div class="d-flex justify-content-between">

                                                    <a href="/alumni-profil{{ $alumni->nisn }}" class="m-1">
                                                        <button class="btn btn-outline-primary">
                                                            <i class="bi bi-person-lines-fill"></i>
                                                        </button>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    @endsection
</body>

</html>
