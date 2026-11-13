@extends('admin.layouts.master')
@section('title', 'Edit Data Menu')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Menu</h3>
                <p class="text-subtitle text-muted">Silahkan isi data menu yang ingin diubah</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <a href="{{ route('items.create') }}" class="btn btn-primary float-end">
                    <i class="bi bi-plus"></i>
                    Tambah Menu
                </a>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data Menu</h4>
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
                <form class="form" action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nama Menu</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Masukkan nama menu" required value="{{ $item->name }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea name="description" class="form-control" id="description" rows="3" placeholder="Masukkan deskripsi menu">{{ $item->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Harga</label>
                                <input type="number" name="price" class="form-control" id="price" placeholder="Masukkan harga menu" required value="{{ $item->price }}">
                            </div>

                            <div class="form-group">
                                <label for="category_id">Kategori</label>
                                <select name="category_id" class="form-select" id="category_id" required>
                                    <option value="" disabled>Pilih menu</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>{{ $category->cat_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="img">Gambar</label>
                                @if ($item->img)
                                    <div class="mb-2">
                                        <img src="{{ asset('img_item_upload/' . $item->img) }}" class="img-fluid w-25 rounded-top" alt="{{ $item->name }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1591325418441-ff678baf78ef';">
                                    </div>
                                @endif
                                <input type="file" name="img" class="form-control" id="img" accept="image/*">
                            </div>

                            <div class="form-group">
                                <label for="is_active">Status</label>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" class="form-check-input" id="flexSwitchCheckChecked" value="1" {{ $item->is_active == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Aktif/Tidak Aktif</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            <button type="reset" class="btn btn-secondary mt-3">Reset</button>
                            <button type="button" class="btn btn-warning mt-3" onclick="window.location='{{ route('items.index') }}'">Batal</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

