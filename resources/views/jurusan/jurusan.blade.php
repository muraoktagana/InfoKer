<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jurusan</title>
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

                        <button class="btn rounded-pill icon icon-left btn-primary d-flex align-items-center"
                            data-bs-toggle="modal" data-bs-target="#tambah">
                            <i data-feather="plus-circle"></i>Tambah Data
                        </button>

                        <!--large size Modal -->
                        <div class="modal fade text-left" id="tambah" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel17" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel17">Masukan Jurusan Baru</h4>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/jurusan-add" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="jurusan">Jurusan baru</label>
                                                <input type="text" id="jurusan" class="form-control" name="jurusan"
                                                    required autofocus />
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Kembali</span>
                                        </button>
                                        <input type="submit" value="Simpan" class="btn btn-primary">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jurusan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jurusan as $key => $jurusan)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $jurusan->jurusan }}</td>
                                            <td>
                                                <div class="d-flex justify-content-between">

                                                    {{-- <a href="/alumni-profil{{ $alumni->nisn }}" class="m-1">
                                                        <button class="btn btn-outline-primary">
                                                            <i class="bi bi-person-lines-fill"></i>
                                                        </button>
                                                    </a> --}}

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
