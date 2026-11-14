@extends('admin.layouts.master')
@section('title', 'Detail Pesanan')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Pesanan</h3>
                    <p class="text-subtitle text-muted">Informasi lengkap tentang pesanan</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <a href="{{ route('orders.index') }}" class="btn btn-primary float-end">
                        <i class="bi bi-arrow-left"></i>
                        Kembali ke Daftar Pesanan
                    </a>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Kode Pesanan: {{ $order->order_code }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Dibuat Pada:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                            <p><strong>Nama Pelanggan:</strong> {{ $order->user->fullname }}</p>
                            <p><strong>Status:</strong> 
                                <span class="badge bg-{{ $order->status=='pending' ? 'warning' : 'success' }}">
                                    {{ $order->status ?? 'N/A' }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>No. Meja:</strong> {{ $order->table_number ?? 'N/A' }}</p>
                            <p><strong>Metode Pembayaran:</strong> 
                                <span class="badge bg-{{ $order->payment_method == 'qris' ? 'success' : 'info' }}">
                                    {{ $order->payment_method == 'qris' ? 'QRIS' : 'Tunai' }}
                                </span>
                            </p>
                            <p><strong>Catatan:</strong> {{ Str::limit($order->note, 50) ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Menu yang dipesan</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Item</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $menu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="w-25">
                                        <img src="{{ asset('img_item_upload/' . $menu->item->img) }}" class="img-fluid w-25 rounded-top" alt="{{ $menu->name }}" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1591325418441-ff678baf78ef';">
                                    </td>
                                    <td>{{ $menu->item->name }}</td>
                                    <td>{{ $menu->quantity }}</td>
                                    <td>Rp {{ number_format($menu->item->price, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table table-striped mt-4">
                            <tr>
                                <th class="text-end">Sub Total:</th>
                                <th>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</th>
                            </tr>
                            <tr>
                                <th class="text-end">Pajak:</th>
                                <th>Rp {{ number_format($order->tax, 0, ',', '.') }}</th>
                            </tr>
                            <tr>
                                <th class="text-end">Total Bayar:</th>
                                <th>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</th>
                            </tr>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
