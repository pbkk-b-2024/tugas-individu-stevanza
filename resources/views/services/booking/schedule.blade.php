{{-- resources/views/services/booking/schedule.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold mb-2">Pilih Jadwal Service</h1>
                    <p class="text-gray-600 dark:text-gray-400">Tentukan waktu yang sesuai untuk service kendaraan Anda</p>
                </div>

                <!-- Progress Steps -->
                <div class="max-w-3xl mx-auto mb-8">
                    <div class="relative">
                        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-gray-200 dark:bg-gray-700">
                            <div class="absolute left-0 top-0 h-full bg-blue-600" style="width: 100%"></div>
                        </div>
                        <div class="relative flex justify-between">
                            <div class="step completed">
                                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold relative z-10">
                                    ✓
                                </div>
                                <div class="mt-2 text-sm font-medium text-blue-600 dark:text-blue-400">Data Motor</div>
                            </div>
                            <div class="step completed">
                                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold relative z-10">
                                    ✓
                                </div>
                                <div class="mt-2 text-sm font-medium text-blue-600 dark:text-blue-400">Pilih Layanan</div>
                            </div>
                            <div class="step active">
                                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold relative z-10">
                                    3
                                </div>
                                <div class="mt-2 text-sm font-medium text-blue-600 dark:text-blue-400">Jadwal</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Form -->
                <div class="max-w-3xl mx-auto">
                    <div class="bg-white dark:bg-gray-800 rounded-lg">
                        <form action="{{ route('services.booking.schedule.store') }}" method="POST">
                            @csrf
                            
                            <!-- Motor & Service Summary -->
                            <div class="mb-8 p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <h3 class="text-lg font-semibold mb-4">Ringkasan Booking</h3>
                                @php
                                    $motorData = session('booking.motor');
                                    $serviceData = session('booking.service');
                                @endphp
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">Motor:</p>
                                        <p class="font-medium">{{ $motorData['merk'] }} {{ $motorData['model'] }} ({{ $motorData['tahun'] }})</p>
                                        <p class="text-gray-500">{{ $motorData['nomor_plat'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 dark:text-gray-400">Layanan:</p>
                                        <p class="font-medium">
                                            @switch($serviceData['servis_id'])
                                                @case(1)
                                                    Service Berkala
                                                    @break
                                                @case(2)
                                                    Tune Up
                                                    @break
                                                @case(3)
                                                    Restorasi
                                                    @break
                                                @case(4)
                                                    Ganti Sparepart
                                                    @break
                                            @endswitch
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Date Selection -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal Service
                                </label>
                                <input type="date" 
                                       name="booking_date" 
                                       value="{{ old('booking_date') }}"
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 @error('booking_date') border-red-500 @enderror"
                                       required>
                                @error('booking_date')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-sm text-gray-500">Pilih tanggal minimal H+1 dari hari ini</p>
                            </div>

                            <!-- Additional Notes -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Keluhan / Catatan Tambahan
                                </label>
                                <textarea name="keluhan" 
                                          rows="4" 
                                          class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500"
                                          placeholder="Jelaskan keluhan atau informasi tambahan tentang kendaraan Anda">{{ old('keluhan') }}</textarea>
                                </textarea>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="mb-8">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input type="checkbox"
                                               name="terms"
                                               id="terms"
                                               required
                                               class="w-4 h-4 border-gray-300 rounded focus:ring-blue-500">
                                    </div>
                                    <label for="terms" class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                        Saya menyetujui bahwa informasi yang saya berikan adalah benar dan setuju dengan 
                                        <a href="#" class="text-blue-600 hover:underline">syarat dan ketentuan</a> yang berlaku
                                    </label>
                                </div>
                                @error('terms')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Important Notes -->
                            <div class="mb-8 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                                <h4 class="text-sm font-semibold text-yellow-800 dark:text-yellow-400 mb-2">Catatan Penting:</h4>
                                <ul class="text-sm text-yellow-700 dark:text-yellow-300 space-y-1">
                                    <li>• Mohon datang tepat waktu sesuai jadwal yang telah ditentukan</li>
                                    <li>• Pastikan motor dalam kondisi bisa dinyalakan</li>
                                    <li>• Barang berharga harap diamankan sendiri</li>
                                    <li>• Pembatalan dapat dilakukan maksimal H-1 dari jadwal service</li>
                                </ul>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="flex justify-between items-center">
                                <a href="{{ route('services.booking.service') }}" 
                                   class="px-6 py-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg transition-colors duration-200">
                                    Kembali ke Pilih Layanan
                                </a>
                                <button type="submit" 
                                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    Konfirmasi Booking
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Disable past dates in date picker
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        
        const dateInput = document.querySelector('input[name="booking_date"]');
        if (dateInput) {
            dateInput.min = tomorrow.toISOString().split('T')[0];
        }
    });
</script>
@endpush
@endsection