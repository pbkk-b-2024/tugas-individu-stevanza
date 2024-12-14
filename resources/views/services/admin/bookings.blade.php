{{-- resources/views/services/admin/bookings.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        Manage Service Bookings
                    </h2>
                    
                    <!-- Filters -->
                    <div class="flex items-center space-x-4">
                        <form action="{{ route('services.admin.bookings') }}" method="GET" class="flex items-center space-x-2">
                            <label for="status" class="text-sm font-medium text-gray-700 dark:text-gray-300">Filter Status:</label>
                            <select name="status" id="status" onchange="this.form.submit()" 
                                    class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="finished" {{ request('status') == 'finished' ? 'selected' : '' }}>Finished</option>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
                @endif

                <!-- Bookings Table -->
                <div class="overflow-x-auto relative">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Booking Date</th>
                                <th scope="col" class="px-6 py-3">Customer</th>
                                <th scope="col" class="px-6 py-3">Vehicle</th>
                                <th scope="col" class="px-6 py-3">Service</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900 dark:text-white">{{ $booking->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $booking->user->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900 dark:text-white">
                                        {{ $booking->motor->merk }} {{ $booking->motor->model }}
                                    </div>
                                    <div class="text-sm text-gray-500">{{ $booking->motor->nomor_plat }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $booking->servis->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($booking->status === 'processing') bg-blue-100 text-blue-800
                                        @else bg-green-100 text-green-800 @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('services.admin.updateStatus', $booking->id) }}" method="POST" class="inline-flex items-center">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                                class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $booking->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="finished" {{ $booking->status == 'finished' ? 'selected' : '' }}>Finished</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No bookings found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection