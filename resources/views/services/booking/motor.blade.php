@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold mb-2">Booking Service</h1>
                    <p class="text-gray-600 dark:text-gray-400">Lengkapi data kendaraan Anda untuk memulai service</p>
                </div>

                <!-- Progress Steps -->
                <div class="max-w-3xl mx-auto mb-8">
                    <div class="relative">
                        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-gray-200 dark:bg-gray-700"></div>
                        <div class="relative flex justify-between">
                            <div class="step active">
                                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold relative z-10">
                                    1
                                </div>
                                <div class="mt-2 text-sm font-medium text-blue-600 dark:text-blue-400">Data Motor</div>
                            </div>
                            <div class="step">
                                <div class="w-10 h-10 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center text-gray-600 dark:text-gray-400 font-bold relative z-10">
                                    2
                                </div>
                                <div class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">Pilih Layanan</div>
                            </div>
                            <div class="step">
                                <div class="w-10 h-10 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center text-gray-600 dark:text-gray-400 font-bold relative z-10">
                                    3
                                </div>
                                <div class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">Jadwal</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="max-w-3xl mx-auto">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <form action="{{ route('services.booking.motor.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Merk Motor
                                    </label>
                                    <input type="text" 
                                           name="merk" 
                                           value="{{ old('merk', session('booking.motor.merk')) }}"
                                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 @error('merk') border-red-500 @enderror" 
                                           required>
                                    @error('merk')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Model Motor
                                    </label>
                                    <input type="text" 
                                           name="model" 
                                           value="{{ old('model', session('booking.motor.model')) }}"
                                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 @error('model') border-red-500 @enderror" 
                                           required>
                                    @error('model')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Tahun Pembuatan
                                    </label>
                                    <input type="number" 
                                           name="tahun" 
                                           value="{{ old('tahun', session('booking.motor.tahun')) }}"
                                           min="1970" 
                                           max="{{ date('Y') }}" 
                                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 @error('tahun') border-red-500 @enderror" 
                                           required>
                                    @error('tahun')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Nomor Plat
                                    </label>
                                    <input type="text" 
                                           name="nomor_plat" 
                                           value="{{ old('nomor_plat', session('booking.motor.nomor_plat')) }}"
                                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 @error('nomor_plat') border-red-500 @enderror" 
                                           required>
                                    @error('nomor_plat')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-8 flex justify-end">
                                <button type="submit" 
                                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    Lanjut ke Pilih Layanan
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
    function selectService(card, serviceId) {
        // Remove selection from all cards
        document.querySelectorAll('.service-card').forEach(c => {
            c.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
        });
        
        // Add selection to clicked card
        card.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
        
        // Update hidden input
        document.getElementById('servis_id').value = serviceId;
    }

    // Select previously chosen service if any
    document.addEventListener('DOMContentLoaded', function() {
        const savedServiceId = "{{ old('servis_id', session('booking.service.servis_id')) }}";
        if (savedServiceId) {
            const card = document.querySelector(`[onclick="selectService(this, ${savedServiceId})"]`);
            if (card) {
                selectService(card, savedServiceId);
            }
        }
    });
</script>
@endpush
@endsection