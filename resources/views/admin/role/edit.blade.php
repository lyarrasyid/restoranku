@extends('admin.layouts.master')
@section('title', 'Edit Data Role')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Role</h3>
                <p class="text-subtitle text-muted">Silahkan isi data Role yang ingin diubah</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <a href="{{ route('roles.create') }}" class="btn btn-primary float-end">
                    <i class="bi bi-plus"></i>
                    Tambah Role
                </a>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data Role</h4>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <h5 class="alert-heading">Terjadi kesalahan!</h5>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form" action="{{ route('roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="role_name">Nama Role</label>
                                <input type="text" name="role_name" class="form-control" id="role_name" placeholder="Masukkan nama Role" required value="{{ $role->role_name }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" class="form-control" id="description" rows="3" placeholder="Masukkan deskripsi Role">{{ $role->description }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            <button type="reset" class="btn btn-secondary mt-3">Reset</button>
                            <button type="button" class="btn btn-warning mt-3" onclick="window.location='{{ route('roles.index') }}'">Batal</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

