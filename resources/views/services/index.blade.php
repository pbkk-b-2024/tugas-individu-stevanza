@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Success Notification -->
    @if (session('success'))
    <div class="mb-8">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            @if(session('booking_info'))
            <div class="mt-2 text-sm">
                <p>Detail Booking:</p>
                <p>Tanggal: {{ \Carbon\Carbon::parse(session('booking_info.tanggal'))->format('d F Y') }}</p>
                <p>Nomor Plat: {{ session('booking_info.nomor_plat') }}</p>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Booking History Section -->
    @php
        $bookings = Auth::user()->bookings()
                    ->with(['motor', 'servis'])
                    ->where('status', '!=', 'completed')
                    ->latest()
                    ->take(3)
                    ->get();
    @endphp

    @if($bookings->count() > 0)
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Booking Aktif</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($bookings as $booking)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $booking->motor->merk }} {{ $booking->motor->model }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ $booking->motor->nomor_plat }}</p>
                    </div>
                    <span class="px-3 py-1 text-sm rounded-full 
                        @if($booking->status === 'pending')
                            bg-yellow-100 text-yellow-800
                        @elseif($booking->status === 'confirmed')
                            bg-green-100 text-green-800
                        @else
                            bg-blue-100 text-blue-800
                        @endif">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <p class="mb-2">
                        <span class="font-medium">Tanggal:</span> 
                        {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d F Y') }}
                    </p>
                    @if($booking->keluhan)
                    <p class="mb-2">
                        <span class="font-medium">Keluhan:</span> 
                        {{ Str::limit($booking->keluhan, 50) }}
                    </p>
                    @endif
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
        <div class="text-center mt-4">
            <a href="{{ route('services.booking.history') }}" 
               class="text-blue-600 hover:text-blue-800 font-medium">
                Lihat Semua Booking →
            </a>
        </div>
    </div>
    @endif
    <!-- Header Section -->
    <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Layanan Servis Motor</h1>
        <p class="text-gray-600 dark:text-gray-300">Pilih jenis servis yang sesuai dengan kebutuhan perawatan motormu</p>
    </div>

    @can('manageBookings')
    <div class="mb-8">
        <a href="{{ route('services.admin.bookings') }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
            Manage Bookings
        </a>
    </div>
    @endcan

    <!-- Service Cards Section -->
    <div class="mb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Service Berkala -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transform hover:scale-105 transition-transform duration-300">
                <div class="text-4xl mb-4">🔧</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Service Berkala</h3>
                <ul class="text-gray-600 dark:text-gray-300 mb-4 space-y-2">
                    <li>✓ Pengecekan komponen</li>
                    <li>✓ Penyetelan mesin</li>
                    <li>✓ Ganti oli</li>
                </ul>
                <p class="text-blue-600 dark:text-blue-400 font-semibold">Mulai dari Rp 200.000</p>
            </div>

            <!-- Tune Up -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transform hover:scale-105 transition-transform duration-300">
                <div class="text-4xl mb-4">⚙️</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Tune Up</h3>
                <ul class="text-gray-600 dark:text-gray-300 mb-4 space-y-2">
                    <li>✓ Pembersihan karburator</li>
                    <li>✓ Penyetelan klep</li>
                    <li>✓ Kalibrasi ECU</li>
                </ul>
                <p class="text-blue-600 dark:text-blue-400 font-semibold">Mulai dari Rp 300.000</p>
            </div>

            <!-- Ganti Oli -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transform hover:scale-105 transition-transform duration-300">
                <div class="text-4xl mb-4">🛢️</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Ganti Oli</h3>
                <ul class="text-gray-600 dark:text-gray-300 mb-4 space-y-2">
                    <li>✓ Oli mesin berkualitas</li>
                    <li>✓ Perawatan filter</li>
                    <li>✓ Cek kerapatan mesin</li>
                </ul>
                <p class="text-blue-600 dark:text-blue-400 font-semibold">Mulai dari Rp 150.000</p>
            </div>

            <!-- Sparepart -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transform hover:scale-105 transition-transform duration-300">
                <div class="text-4xl mb-4">🔨</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Ganti Sparepart</h3>
                <ul class="text-gray-600 dark:text-gray-300 mb-4 space-y-2">
                    <li>✓ Sparepart original</li>
                    <li>✓ Garansi penggantian</li>
                    <li>✓ Konsultasi gratis</li>
                </ul>
                <p class="text-blue-600 dark:text-blue-400 font-semibold">Mulai dari Rp 100.000</p>
            </div>
        </div>

        <!-- Centralized Booking Button -->
        <div class="text-center mt-8">
            <a href="{{ route('services.booking.motor') }}" 
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold py-3 px-8 rounded-lg transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                Booking Service Sekarang
            </a>
        </div>
    </div>

    <!-- Benefits Section -->
    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-8 mb-12">
        <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-8">Mengapa Memilih Layanan Kami?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="text-3xl mb-4">👨‍🔧</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Mekanik Profesional</h3>
                <p class="text-gray-600 dark:text-gray-300">Ditangani oleh mekanik berpengalaman dan tersertifikasi</p>
            </div>
            <div class="text-center">
                <div class="text-3xl mb-4">⚡</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Layanan Cepat</h3>
                <p class="text-gray-600 dark:text-gray-300">Waktu pengerjaan cepat dengan hasil maksimal</p>
            </div>
            <div class="text-center">
                <div class="text-3xl mb-4">💰</div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Harga Transparan</h3>
                <p class="text-gray-600 dark:text-gray-300">Biaya jelas dan terperinci tanpa biaya tersembunyi</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Add any additional JavaScript if needed
    document.addEventListener('DOMContentLoaded', function() {
        // Example: Smooth scroll for booking button
        document.querySelector('a[href="{{ route("services.booking") }}"]').addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            window.location.href = href;
        });
    });
</script>
@endpush
@endsection