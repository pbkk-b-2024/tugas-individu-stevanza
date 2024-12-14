@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Detail Pesanan</h2>
    <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
        <div class="mb-4">
            <p class="text-lg font-semibold">Nomor Pesanan: #{{ $order->id }}</p>
            <p>Status: 
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $order->status === 'pending' ? 'yellow' : ($order->status === 'confirmed' ? 'green' : 'red') }}-100 text-{{ $order->status === 'pending' ? 'yellow' : ($order->status === 'confirmed' ? 'green' : 'red') }}-800">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p>Tanggal Pesanan: {{ $order->created_at->format('d M Y H:i') }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-semibold">{{ $order->produk->nama }}</h3>
            <p>Jumlah: {{ $order->quantity }}</p>
            <p class="font-bold">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-semibold">Alamat Pengiriman</h3>
            <p>{{ $order->address }}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-semibold">Metode Pembayaran</h3>
            <p>{{ $order->payment_method === 'transfer' ? 'Transfer Bank' : 'Cash on Delivery' }}</p>
        </div>

        @if(auth()->user()->isAdmin())
        <div class="mt-6">
            <h3 class="text-lg font-semibold mb-2">Update Status Pesanan</h3>
            <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="flex items-center">
                @csrf
                @method('PATCH')
                <select name="status" class="rounded border-gray-300 text-sm mr-2">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Update Status
                </button>
            </form>
        </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection