<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lowongan Pekerjaan Form</title>
    @extends('navigasi')

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body>
    @section('content')
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Form pengajuan lowongan </h3>

                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Quill</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- // Basic multiple Column Form section start -->
                        @if (Session::get('success'))
                            <div class="alert alert-success alert-dismissible show fade my-3">
                                <i class="bi bi-check-circle"></i> {{ Session::get('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif (Session::get('error'))
                            <div class="alert alert-danger alert-dismissible show fade my-3">
                                <i class="bi bi-exclamation-triangle"></i> {{ Session::get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">

                        <h4 class="card-title my-0">form pengajuan lowongan</h4>
                        <!-- Button trigger modal -->

                    </div>
                    <div class="card-body">

                        <form action="/lowongan_pekerjaan/store" method="post" id="form_lowongan"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-upload"></i>
                                    Upload
                                </button>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                                    <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-control" required="required" autofocus
                                        value="{{ old('nama_perusahaan') }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="judul" class="form-label">Judul Lowongan Pekerjaan</label>
                                    <input type="text" id="judul" name="judul" class="form-control" required="required" autofocus
                                        value="{{ old('judul') }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="alamat_perusahaan" class="form-label">Alamat Perusahaan</label>
                                    <input type="text" id="alamat_perusahaan" name="alamat_perusahaan" class="form-control" required="required" autofocus
                                        value="{{ old('alamat_perusahaan') }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lokasi_kerja" class="form-label">Lokasi Pekerjaan</label>
                                    <select class="form-select" name="lokasi_kerja" id="lokasi_kerja" required="required">
                                        <option selected disabled></option>
                                        <option value="on_site" {{ old('lokasi_kerja') == 'on_site' ? 'selected' : '' }}>On
                                            Site</option>
                                        <option value="remote" {{ old('lokasi_kerja') == 'remote' ? 'selected' : '' }}>
                                            Remote</option>
                                        <option value="hybrid" {{ old('lokasi_kerja') == 'hybrid' ? 'selected' : '' }}>
                                            Hybrid</option>
                                    </select>
                                </div>
                            </div>

                            <label for="deskripsi_editor" class="my-3">Deskripsi Pekerjaan <br>
                                <small><i>masukan deskripsi dengan jelas</i></small>
                            </label>
                            <div id="deskripsi_editor" class="mb-4">{!! old('deskripsi') !!}</div>
                            <input type="hidden" id="deskripsi" name="deskripsi">

                            <label for="tag" class="my-3">Tag pekerjaan <br>
                                <small><i>memungkin pengguna lebih mudah menemukan pekerjaan</i></small>
                            </label>
                            <input id="tags_1" type="text" class="tags form-control" name="tag"
                                value="{{ old('tag') }}" />
                            <div id="suggestions-container" style=""></div>

                            <label for="file" class="my-3">Bagikan dengan file<br>
                                <small><i>Tambahkan file yang bersangkutan</i></small>
                            </label>
                            <input type="file" name="file[]" class="multiple-files-filepond" multiple>

                        </form>

                    </div>
                </div>

                
                <script>
                    var quill = new Quill('#deskripsi_editor', {
                        theme: 'snow' // Tema Snow adalah tema standar yang akan memberikan antarmuka seperti Microsoft Word.
                    });

                    var form = document.querySelector('#form_lowongan');
                    form.onsubmit = function() {
                        var deskripsi = document.querySelector('input[name=deskripsi]');
                        deskripsi.value = quill.root.innerHTML;
                    };
                </script>
            </section>
        </div>
    @endsection

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>



</body>

</html>
