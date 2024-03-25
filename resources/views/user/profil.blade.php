<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
    @extends('user.main')
</head>
<body>
    @section('main')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
            <div class="col-md-12">
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
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i>
                            Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-account-settings-notifications.html"><i
                                class="bx bx-bell me-1"></i> Resume</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-account-settings-connections.html"><i
                                class="bx bx-link-alt me-1"></i> Connections</a>
                    </li>
                </ul>
                
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="storage/{{ $alumni->foto_profil }}" alt="user-avatar" class="d-block rounded"
                                height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <form action="/upload_foto/{{ $alumni->nisn }}" method="post"
                                        enctype="multipart/form-data" id="uploadForm">
                                        @csrf
                                        <span class="d-none d-sm-block">Ubah foto profil</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" name="foto_profil"
                                            class="account-file-input" hidden accept="image/png, image/jpeg" />
                                    </form>
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr class="my-3" />
                    <div class="card-body">
                        <form action="/alumni-profil_update{{ $alumni->user_id }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="nisn" class="form-label">NISN</label>
                                    <input class="form-control" type="text" id="nisn" name="nisn"
                                        value="{{ $alumni->nisn }}" readonly />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nama_lengkap" class="form-label">Nama</label>
                                    <input class="form-control" type="text" id="nama_lengkap" name="nama_lengkap"
                                        value="{{ $alumni->nama_lengkap }}" autofocus />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <select class="form-select" id="jurusan" name="jurusan">
                                        @foreach ($jurusan as $jurusanOption)
                                            <option value="{{ $jurusanOption->jurusan }}"
                                                {{ $alumni->jurusan == $jurusanOption->jurusan ? 'selected' : '' }}>
                                                {{ $jurusanOption->jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input class="form-control" type="text" id="username" name="username"
                                        value="{{ $alumni->user->name }}" autofocus />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="tahun_kelulusan" class="form-label">Tahun Kelulusan</label>
                                    <input class="form-control" type="number" id="tahun_kelulusan"
                                        name="tahun_kelulusan" value="{{ $alumni->tahun_kelulusan }}" autofocus />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input class="form-control" type="email" id="email" name="email"
                                        value="{{ $alumni->user->email }}" readonly />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="jenis_kelamin" class="form-label">Jenis kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="laki_laki" @if ($alumni->jenis_kelamin == 'laki_laki') selected @endif>
                                            Laki-laki</option>
                                        <option value="perempuan" @if ($alumni->jenis_kelamin == 'perempuan') selected @endif>
                                            Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="kontak" class="form-label">Nomor Kontak</label>
                                    <input class="form-control" type="number" id="kontak" name="kontak"
                                        value="{{ $alumni->kontak }}" autofocus />
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input class="form-control" type="text" id="alamat" name="alamat"
                                        value="{{ $alumni->alamat }}" autofocus />
                                </div>
                            </div>
                            <div class="mt-2 text-end">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
                {{-- <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?
                                </h6>
                                <p class="mb-0">Once you delete your account, there is no going back. Please be
                                    certain.</p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" onsubmit="return false">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation" />
                                <label class="form-check-label" for="accountActivation">I confirm my account
                                    deactivation</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Deactivate
                                Account</button>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>

    <script>
        document.getElementById('upload').addEventListener('change', function() {
            // Menampilkan nama file yang dipilih, misalnya:
            // var fileName = this.files[0].name;
            // alert('Selected file: ' + fileName);

            // Menjalankan submit form setelah memilih file
            document.getElementById('uploadForm').submit();
        });
    </script>
    @endsection
</body>
</html>