@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Admin Overview Section -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-4">Admin Control Panel</h1>
                <p class="mb-4">Welcome to the administrative dashboard. Manage your website's content and monitor system activities here.</p>
            </div>
        </div>

        <!-- Quick Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Products Stats -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-2">Products</h3>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $productsCount ?? 0 }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Products</p>
                </div>
            </div>

            <!-- Services Stats -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-2">Services</h3>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $servicesCount ?? 0 }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Active Services</p>
                </div>
            </div>

            <!-- Orders Stats -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-2">Orders</h3>
                    <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $ordersCount ?? 0 }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Pending Orders</p>
                </div>
            </div>

            <!-- Feedback Stats -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-2">Feedback</h3>
                    <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $feedbackCount ?? 0 }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Customer Reviews</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Manage Products -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">Product Management</h3>
                    <div class="space-y-3">
                        <a href="{{ route('produk.create') }}" class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                            Add New Product
                        </a>
                        <a href="{{ route('produk') }}" class="block w-full text-center bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">
                            View All Products
                        </a>
                    </div>
                </div>
            </div>

            <!-- Manage Services -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">Service Management</h3>
                    <div class="space-y-3">
                        <a href="{{ route('services.admin') }}" class="block w-full text-center bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                            Manage Bookings
                        </a>
                        <a href="{{ route('services.index') }}" class="block w-full text-center bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">
                            View Services
                        </a>
                    </div>
                </div>
            </div>

            <!-- Customer Feedback -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">Customer Feedback</h3>
                    <div class="space-y-3">
                        <a href="{{ route('feedback') }}" class="block w-full text-center bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                            View Feedback
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection