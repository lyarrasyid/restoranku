@extends('admin.layouts.master')
@section('title', 'Tambah Karyawan')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Karyawan</h3>
                <p class="text-subtitle text-muted">Silahkan isi data Karyawan yang ingin ditambahkan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <a href="{{ route('users.create') }}" class="btn btn-primary float-end">
                    <i class="bi bi-plus"></i>
                    Tambah Karyawan
                </a>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Data Karyawan</h4>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" Karyawan="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <h5 class="alert-heading">Terjadi kesalahan!</h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fullname">Nama Karyawan</label>
                                <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Masukkan nama Karyawan" value="{{ old('fullname') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username" value="{{ old('username') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">No Telepon</label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Masukkan no telepon" value="{{ old('phone') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="role_id">Role</label>
                                <select name="role_id" class="form-control" id="role_id" required>
                                    <option value="">Pilih Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" value="{{ old('password') }}" required>
                                <a href="#" data-target="password" id="togglePassword">
                                    <i class="bi bi-eye"></i> Lihat Password
                                </a>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Masukkan konfirmasi password" value="{{ old('password_confirmation') }}" required>
                                <a href="#" data-target="password_confirmation" id="togglePasswordConfirmation">
                                    <i class="bi bi-eye"></i> Lihat Password
                                </a>
                            </div>
                            
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            <button type="reset" class="btn btn-secondary mt-3">Reset</button>
                            <button type="button" class="btn btn-warning mt-3" onclick="window.location='{{ route('users.index') }}'">Batal</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<script>
    document.querySelectorAll('#togglePassword, #togglePasswordConfirmation').forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            const targetInput = document.getElementById(targetId);
            if (targetInput.type === 'password') {
                targetInput.type = 'text';
                this.innerHTML = '<i class="bi bi-eye-slash"></i> Sembunyikan Password';
            } else {
                targetInput.type = 'password';
                this.innerHTML = '<i class="bi bi-eye"></i> Lihat Password';
            }
        });
    });
</script>
@endsection

