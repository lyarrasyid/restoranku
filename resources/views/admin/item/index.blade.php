@extends('admin.layouts.master')
@section('title', 'Menu')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Menu</h3>
                    <p class="text-subtitle text-muted">Berbagai pilihan menu terbaik</p>
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
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Item</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="w-25">
                                        @if ($item->img)
                                            <img src="{{ asset('img_item_upload/' . $item->img) }}" class="img-fluid w-50 rounded-top" alt="{{ $item->name }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1591325418441-ff678baf78ef';">
                                        @else
                                            <img src="{{ asset('img_item_upload/' . $item->img) }}" class="img-fluid w-50 rounded-top" alt="{{ $item->name }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1591325418441-ff678baf78ef';">
                                            {{-- <img src="{{ asset('assets/admin/static/images/no-image.png') }}" alt="No Image" width="100"> --}}

                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ Str::limit($item->description, 50) }}</td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $item->category->cat_name=='Makanan' ? 'warning' : 'info' }}">
                                            {{ $item->category->cat_name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $item->is_active == 1 ? 'success' : 'danger' }}">
                                            {{ $item->is_active == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        @if ($item->is_active == 1)
                                            <form action="{{ route('items.updateStatus', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="is_active" value="0">
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah anda yakin ingin menonaktifkan menu ini?')">
                                                    <i class="bi bi-x-circle"></i> Nonaktifkan
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('items.updateStatus', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="is_active" value="1">
                                                <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('Apakah anda yakin ingin mengaktifkan menu ini?')">
                                                    <i class="bi bi-check-circle"></i> Aktifkan
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah anda yakin ingin menghapus menu ini?')">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
