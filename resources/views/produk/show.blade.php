@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-xl rounded-lg overflow-hidden max-w-4xl mx-auto">
        <div class="md:flex">
            <div class="md:flex-shrink-0">
                @if($produk->gambar)
                    <img class="h-96 w-full object-cover md:w-96" src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}">
                @else
                    <div class="h-96 w-full md:w-96 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500 text-lg">Tidak ada gambar</span>
                    </div>
                @endif
            </div>
            <div class="p-8">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{ $produk->kategori ?? 'Produk' }}</div>
                <h1 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{ $produk->nama }}</h1>
                <p class="mt-4 text-xl text-gray-500">{{ $produk->deskripsi }}</p>
                <div class="mt-6">
                    <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    <p class="mt-2 text-sm text-gray-500">Stok: {{ $produk->stok }}</p>
                </div>
                @auth
                    @if(!auth()->user()->isAdmin())
                        <div class="mt-8">
                            <form action="{{ route('orders.create') }}" method="GET">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                <div class="mt-4">
                                    <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah</label>
                                    <input type="number" name="quantity" id="quantity" min="1" max="{{ $produk->stok }}" value="1" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <button type="submit" class="mt-6 w-full bg-indigo-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Pesan Sekarang
                                </button>
                            </form>
                        </div>
                    @endif
                @else
                    <p class="mt-6 text-center text-gray-500">Silakan <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500">login</a> untuk melakukan pemesanan.</p>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection