@extends('customer.layouts.master')

@section('title', 'Pesanan Berhasil')

@section('content')
    <div class="container-fluid fruite py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card receipt">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Pesanan berhasil dibuat!</h3>
                        @if ($order->payment_method === 'tunai' && $order->status === 'pending')
                            <p class="text-center"> <span class="badge bg-danger">Menunggu Pembayaran</span></p>
                        @elseif ($order->payment_method === 'qris' && $order->status === 'pending')
                            <p class="text-center"> <span class="badge bg-warning">Menunggu Konfirmasi Pembayaran</span></p>
                        @else
                            <p class="text-center"> <span class="badge bg-success">Pembayaran berhasil, pesanan sedang diproses.</span></p>
                        @endif
                        <hr>
                        <p class="text-center fw-bold">Kode Bayar: <br> <span class="text-center text-primary">{{ $order->order_code }}</span></p>
                        <hr>
                        <h4>Detail Pesanan</h4>
                        <ul class="list-group mb-3">
                            @foreach ($orderItems as $orderItem)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ Str::limit($orderItem->item->name, 25) }} ({{ $orderItem->quantity }})
                                    <span>Rp{{ number_format($orderItem->total_price, 0, ',', '.') }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Subtotal
                                <span>Rp{{ number_format($order->subtotal, 0, ',', '.') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Pajak (10%)
                                <span>Rp{{ number_format($order->tax, 0, ',', '.') }}</span>
                            </li>
                        </ul>
                        <h4>Total Pembayaran</h4>
                        <p class="text-end fs-5 fw-bold">Rp{{ number_format($order->grand_total, 0, ',', '.') }}</p>
                        @if ($order->payment_method==='tunai')
                            <p class="text-center">Silakan tunjukkan kode bayar ini ke kasir untuk konfirmasi pesanan Anda.</p>
                        @elseif ($order->payment_method==='qris')
                            <p class="text-center">Yeey! Pembayaran sukses. Duduk manis ya, pesanan segera kami proses </p>
                        @endif
                        <hr>
                        <a href="{{ route('menu') }}" class="btn btn-primary w-100">Kembali ke Menu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



