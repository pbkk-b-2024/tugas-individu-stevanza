<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        Gate::authorize('create', Produk::class);
        return view('produk.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Produk::class);

        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gambarPath = $request->hasFile('gambar') ? $request->file('gambar')->store('uploads', 'public') : null;

        Produk::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('produk')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        Gate::authorize('update', $produk);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        Gate::authorize('update', $produk);

        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $gambarPath = $request->file('gambar')->store('uploads', 'public');
        } else {
            $gambarPath = $produk->gambar;
        }

        $produk->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('produk')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy(Produk $produk)
    {
        Gate::authorize('delete', $produk);

        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('produk')->with('success', 'Produk berhasil dihapus.');
    }
}
