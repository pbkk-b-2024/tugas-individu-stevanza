// resources/views/services/booking/show.blade.php
@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold mb-4">Detail Booking</h2>
                
                <!-- Booking Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Informasi Kendaraan</h3>
                        <p><span class="font-medium">Merk:</span> {{ $booking->motor->merk }}</p>
                        <p><span class="font-medium">Model:</span> {{ $booking->motor->model }}</p>
                        <p><span class="font-medium">Nomor Plat:</span> {{ $booking->motor->nomor_plat }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Informasi Booking</h3>
                        <p><span class="font-medium">Tanggal:</span> {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d F Y') }}</p>
                        <p><span class="font-medium">Status:</span> 
                            <span class="px-2 py-1 text-sm rounded-full 
                                @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($booking->status === 'confirmed') bg-green-100 text-green-800
                                @else bg-blue-100 text-blue-800 @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </p>
                        @if($booking->keluhan)
                            <p><span class="font-medium">Keluhan:</span> {{ $booking->keluhan }}</p>
                        @endif
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('services.index') }}" 
                       class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection