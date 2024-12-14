<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
{
    public function toArray($request)
    {
        // Menyesuaikan format response produk
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
            'harga' => $this->harga,
            'stok' => $this->stok,
        ];
    }
}
