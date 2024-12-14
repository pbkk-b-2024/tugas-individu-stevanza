<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Order::class, 'order');
    }

    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $orders = Order::latest()->paginate(10);
        } else {
            $orders = Order::where('user_id', auth()->id())->latest()->paginate(10);
        }
        return view('orders.index', compact('orders'));
    }

    public function create(Request $request)
    {
        $produk = Produk::findOrFail($request->produk_id);
        $quantity = $request->quantity;
        
        // Hitung total harga
        $totalPrice = $produk->harga * $quantity;
        
        // Tampilkan halaman pembayaran dengan data produk dan kuantitas
        return view('orders.create', compact('produk', 'quantity', 'totalPrice'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'quantity' => 'required|integer|min:1',
            'address' => 'required|string',
            'payment_method' => 'required|in:transfer,cod',
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        $totalPrice = $produk->harga * $request->quantity;

        $order = Order::create([
            'user_id' => auth()->id(),
            'produk_id' => $request->produk_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        // Kurangi stok produk
        $produk->decrement('stok', $request->quantity);

        return redirect()->route('orders.show', $order)->with('success', 'Pesanan berhasil dibuat!');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function confirmOrder(Order $order)
    {
        $this->authorize('confirmOrder', $order);
        $order->update(['status' => 'confirmed']);
        return redirect()->back()->with('success', 'Pesanan berhasil dikonfirmasi.');
    }

    public function cancelOrder(Order $order)
    {
        $this->authorize('cancelOrder', $order);
        $order->update(['status' => 'cancelled']);
        // Kembalikan stok produk
        $order->produk->increment('stok', $order->quantity);
        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $this->authorize('update', $order);

        $request->validate([
            'status' => 'required|in:pending,confirmed,shipped,delivered,cancelled'
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        $order->update(['status' => $newStatus]);

        // Jika status berubah menjadi 'cancelled', kembalikan stok
        if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
            $order->produk->increment('stok', $order->quantity);
        }
        // Jika status berubah dari 'cancelled' ke status lain, kurangi stok lagi
        elseif ($oldStatus === 'cancelled' && $newStatus !== 'cancelled') {
            $order->produk->decrement('stok', $order->quantity);
        }

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}