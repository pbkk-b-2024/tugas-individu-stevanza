@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-4">Konfirmasi Pesanan</h2>
            <div class="mb-6">
                <h3 class="text-lg font-semibold">{{ $produk->nama }}</h3>
                <p class="text-gray-600">Jumlah: {{ $quantity }}</p>
                <p class="text-lg font-bold mt-2">Total: Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>
            </div>
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                <input type="hidden" name="quantity" value="{{ $quantity }}">
                
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                    <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                    <select name="payment_method" id="payment_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        <option value="transfer">Transfer Bank</option>
                        <option value="cod">Cash on Delivery</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700 focus:outline-none focus:shadow-outline">
                    Buat Pesanan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection