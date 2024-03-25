<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lowongan Pekerjaan</title>
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
                <div class="accordion mt-3" id="accordionExample">
                    @foreach ($lowongan as $lowongan)
                        <div class="card mb-3">
                            <h2 class="accordion-header" id="heading{{ $lowongan->id }}">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordion{{ $lowongan->id }}" aria-expanded="false"
                                    aria-controls="accordion{{ $lowongan->id }}">
                                    <div>
                                        @if (isset($lowongan->alumni->foto_profil))
                                        <img src="storage/{{ $lowongan->alumni->foto_profil }}" alt="" class="d-block rounded"
                                            width="50" height="50">
                                        @endif
                                    </div>
                                    <div class="mx-3">
                                        <h5 class="mb-2"><strong>{{ $lowongan->judul }} </strong></h5>
                                        <div class="d-flex justify-content-between">
                                            <p class="m-0">{{ $lowongan->perusahaan->nama_perusahaan }} <small> .
                                                    ({{ $lowongan->lokasi_kerja }})
                                                </small></p>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="accordion{{ $lowongan->id }}" class="accordion-collapse collapse"
                                aria-labelledby="heading{{ $lowongan->id }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="d-flex justify-content-between mb-4">
                                        <div>
                                            <h4>{{ $lowongan->perusahaan->nama_perusahaan }}</h4>
                                            <p>{{ $lowongan->perusahaan->alamat_perusahaan }}</p>
                                        </div>
                                        <div class="text-end">
                                            <button type="button"
                                                class="m-0 btn {{ $lowongan->status == 'active' ? 'btn-success' : 'btn-danger' }}"
                                                data-bs-toggle="modal" data-bs-target="#status{{ $lowongan->id }}">
                                                {{ $lowongan->status == 'active' ? 'Dibuka' : 'Ditutup' }}
                                            </button>
                                            <!--small size modal -->
                                            <div class="modal fade text-left" id="status{{ $lowongan->id }}" tabindex="-1" role="dialog"
                                                aria-labelledby="myModalLabel19" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel19">Ubah status
                                                                lowongan?
                                                                <button type="button" class="close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                        </div>
                                                        <form
                                                            action="/lowongan_pekerjaan-status_changer{{ $lowongan->id }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <select name="status" class="form-select" id="">
                                                                    <option value="active"
                                                                        {{ $lowongan->status == 'active' ? 'selected' : '' }}>
                                                                        active</option>
                                                                    <option value="non_active"
                                                                        {{ $lowongan->status == 'non_active' ? 'selected' : '' }}>
                                                                        non active</option>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-light-secondary btn-sm"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-sm-block d-none">Close</span>
                                                                </button>
                                                                <button type="submit" class="btn btn-primary ms-1 btn-sm"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                    <span class="d-sm-block d-none">Accept</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="m-0">Update at: <small>{{ $lowongan->waktu_posting }}</small>
                                            </p>
                                            @if (isset($lowongan->alumni->nama_lengkap))
                                            <p>by: {{ $lowongan->alumni->nama_lengkap }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <p class="mt-5"><strong>Deskripsi:</strong></p>
                                    {!! $lowongan->deskripsi !!}

                                    <p class="mt-5"><strong>Tags:</strong></p>
                                    <div class="badges">
                                        @foreach ($lowongan->tags as $tag)
                                            <a href="#" class="badge bg-primary">{{ $tag }}</a>
                                        @endforeach
                                    </div>

                                    <p class="mt-5"><strong>Tautan:</strong></p>
                                    <div>
                                        @foreach (explode(',', $lowongan->file) as $filePath)
                                            <li><a href="{{ asset($filePath) }}">{{ basename($filePath) }}</a></li>
                                        @endforeach
                                    </div>
                                    <div class="accordion-footer mt-5 text-end">
                                        <a href="/lowongan_pekerjaan-form_edit{{ $lowongan->id }}" class="mx-2">
                                            <button class="btn btn-outline-warning"><i class="bi bi-pen"></i> Edit
                                                Lowongan</button>
                                        </a>
                                        <a href="/lowongan_pekerjaan-remove{{ $lowongan->id }}">
                                            <button class="btn btn-danger"
                                                onclick="return window.confirm('Apakah anda yakin ingin menghapus?')">
                                                <i class="bi bi-trash"></i> Hapus Lowongan
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    @endsection
</body>

</html>
