<aside class="w-64 bg-gray-800 text-white h-full fixed inset-y-0 left-0 transform transition-transform duration-300 ease-in-out z-50 md:translate-x-0 -translate-x-full" id="sidebar">
    <div class="py-4 px-6">
        <h2 class="text-lg font-semibold">Gian Motors</h2>
        <ul class="mt-4 space-y-2">
            @can('viewAny', App\Models\Produk::class)
                <li>
                    <a href="{{ route('produk') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">Produk</a>
                </li>
            @endcan
            <li>
                <a href="{{ route('services.index') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">Service</a>
            </li>
            <li>
                <a href="{{ route('feedback') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">Feedback</a>
            </li>
            <li>
                <a href="{{ route('orders.index') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">Pesanan</a>
            </li>
        </ul>
    </div>
</aside>

<!-- Button to toggle the sidebar on small screens -->
<button id="sidebar-toggle" class="md:hidden fixed top-4 left-4 p-2 bg-gray-800 text-white rounded shadow-md z-50">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
    </svg>
</button>