// resources/views/services/booking/history.blade.php
@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-6">Riwayat Booking</h2>
                
                @if($bookings->isEmpty())
                    <p class="text-gray-600">Belum ada riwayat booking.</p>
                @else
                    <div class="space-y-6">
                        @foreach($bookings as $booking)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-semibold">
                                            {{ $booking->motor->merk }} {{ $booking->motor->model }}
                                        </h3>
                                        <p class="text-sm text-gray-600">{{ $booking->motor->nomor_plat }}</p>
                                        <p class="text-sm text-gray-600">
                                            Tanggal: {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d F Y') }}
                                        </p>
                                    </div>
                                    <span class="px-3 py-1 text-sm rounded-full 
                                        @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($booking->status === 'confirmed') bg-green-100 text-green-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                                <div class="mt-4 text-right">
                                    <a href="{{ route('services.booking.show', $booking->id) }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Lihat Detail →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection