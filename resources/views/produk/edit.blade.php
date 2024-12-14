@extends('layouts.app')

@section('content')
    <h1 class="text-2xl">Edit Produk</h1>
    <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div>
            <label for="nama">Nama</label>
            <input type="text" name="nama" value="{{ $produk->nama }}" required>
        </div>
        <div>
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" required>{{ $produk->deskripsi }}</textarea>
        </div>
        <div>
            <label for="harga">Harga</label>
            <input type="number" name="harga" value="{{ $produk->harga }}" required>
        </div>
        <div>
            <label for="stok">Stok</label>
            <input type="number" name="stok" value="{{ $produk->stok }}" required>
        </div>
        <div>
            <label for="gambar">Gambar Produk</label>
            @if($produk->gambar)
                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama }}" class="w-16 h-16">
            @endif
            <input type="file" name="gambar" accept="image/*"> <!-- Input untuk mengubah gambar -->
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
@endsection
