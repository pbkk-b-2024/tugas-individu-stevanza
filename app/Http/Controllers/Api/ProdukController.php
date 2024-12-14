<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Http\Resources\ProdukResource; // Import ProdukResource
use Illuminate\Http\Response;

class ProdukController extends Controller
{
    public function index()
    {
        // Mengambil semua produk
        $produk = Produk::all();

        // Menggunakan ProdukResource untuk mengatur format response
        return response()->json([
            'success' => true,
            'data' => ProdukResource::collection($produk), // Menggunakan ProdukResource
        ], 200);
    }
}
