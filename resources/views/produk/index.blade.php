@extends('layouts.app')

@section('content')
    <h1 class="text-2xl">Daftar Produk</h1>
    @if (auth()->user()->isAdmin())
        <a href="{{ route('produk.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Produk</a>
    @endif
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
        @foreach ($produks as $produk)
            <div class="border border-gray-300 rounded-lg shadow hover:shadow-lg">
                <a href="{{ route('produk.show', $produk) }}"> <!-- Link ke halaman detail produk -->
                    <img src="{{ $produk->gambar ? asset('storage/' . $produk->gambar) : 'https://via.placeholder.com/150' }}" alt="{{ $produk->nama }}" class="w-full h-48 object-cover rounded-t-lg">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold">{{ $produk->nama }}</h2>
                        <p class="text-gray-600">{{ Str::limit($produk->deskripsi, 50) }}</p>
                        <p class="text-gray-800 font-bold mt-2">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                    </div>
                </a>
                @if (auth()->user()->isAdmin())
                    <div class="p-4 border-t border-gray-200">
                        <a href="{{ route('produk.edit', $produk) }}" class="text-yellow-500">Edit</a>
                        <form action="{{ route('produk.destroy', $produk) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 ml-4">Hapus</button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endsection
