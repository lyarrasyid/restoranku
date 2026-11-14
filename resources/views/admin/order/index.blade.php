@extends('admin.layouts.master')
@section('title', 'Daftar Pesanan')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Daftar Pesanan</h3>
                    <p class="text-subtitle text-muted">Berbagai pilihan pesanan yang tersedia</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <a href="{{ route('orders.create') }}" class="btn btn-primary float-end">
                        <i class="bi bi-plus"></i>
                        Tambah Pesanan
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
                                <th>Kode Pesanan</th>
                                <th>Nama Pelanggan</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                                <th>No. Meja</th>
                                <th>Metode Pembayaran</th>
                                <th>Catatan</th>
                                <th>Dibuat Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->order_code }}</td>
                                    <td>{{ $order->user->fullname }}</td>
                                    <td>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status=='pending' ? 'warning' : 'success' }}">
                                            {{ $order->status ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>{{ $order->table_number ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->payment_method == 'qris' ? 'success' : 'info' }}">
                                            {{ $order->payment_method == 'qris' ? 'QRIS' : 'Tunai' }}
                                        </span>
                                    </td>
                                    <td>{{ Str::limit($order->note, 50) ?? '-' }}</td>
                                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-info">
                                            <i class="bi bi-eye"></i>Lihat
                                        </a>
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
