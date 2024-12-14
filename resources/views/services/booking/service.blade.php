@extends('layouts.app')

@section('content')
<div class="pt-6"> <!-- Add top padding to account for fixed navbar -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold mb-2">Pilih Layanan</h1>
                        <p class="text-gray-600 dark:text-gray-400">Pilih jenis layanan yang sesuai dengan kebutuhan Anda</p>
                    </div>

                <!-- Progress Steps -->
                <div class="max-w-3xl mx-auto mb-12">
                    <div class="relative">
                        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-gray-200 dark:bg-gray-700">
                            <div class="absolute left-0 top-0 h-full bg-blue-600" style="width: 66.66%"></div>
                        </div>
                        <div class="relative flex justify-between">
                            <div class="step completed">
                                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold relative z-10">
                                    ✓
                                </div>
                                <div class="mt-2 text-sm font-medium text-blue-600 dark:text-blue-400">Data Motor</div>
                            </div>
                            <div class="step active">
                                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold relative z-10">
                                    2
                                </div>
                                <div class="mt-2 text-sm font-medium text-blue-600 dark:text-blue-400">Pilih Layanan</div>
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

                <!-- Service Selection Form -->
                <div class="max-w-4xl mx-auto">
                    <form action="{{ route('services.booking.service.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <!-- Service Berkala -->
                            <div class="service-card bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                <label class="block p-6 cursor-pointer">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <span class="text-3xl">🔧</span>
                                            <div>
                                                <h3 class="text-xl font-semibold mb-1">Service Berkala</h3>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">Perawatan rutin untuk menjaga performa motor</p>
                                            </div>
                                        </div>
                                        <input type="radio" 
                                            name="servis_id" 
                                            value="1" 
                                            id="service_berkala"
                                            class="w-5 h-5 text-blue-600 border-gray-300 rounded-full focus:ring-blue-500"
                                            onchange="updateServiceSelection(this)">
                                    </div>
                                    <div class="mt-4 pl-14">
                                        <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                                            <li>• Pengecekan komponen</li>
                                            <li>• Penyetelan mesin</li>
                                            <li>• Ganti oli</li>
                                        </ul>
                                        <p class="mt-4 text-lg font-semibold text-blue-600 dark:text-blue-400">
                                            Mulai dari Rp 200.000
                                        </p>
                                    </div>
                                </label>
                            </div>

                            <!-- Tune Up -->
                            <div class="service-card bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                <label class="block p-6 cursor-pointer">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <span class="text-3xl">⚙️</span>
                                            <div>
                                                <h3 class="text-xl font-semibold mb-1">Tune Up</h3>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">Optimalisasi performa mesin untuk kinerja maksimal</p>
                                            </div>
                                        </div>
                                        <input type="radio" 
                                            name="servis_id" 
                                            value="2" 
                                            id="service_tuneup"
                                            class="w-5 h-5 text-blue-600 border-gray-300 rounded-full focus:ring-blue-500"
                                            onchange="updateServiceSelection(this)">
                                    </div>
                                    <div class="mt-4 pl-14">
                                        <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                                            <li>• Pembersihan karburator</li>
                                            <li>• Penyetelan klep</li>
                                            <li>• Kalibrasi ECU</li>
                                        </ul>
                                        <p class="mt-4 text-lg font-semibold text-blue-600 dark:text-blue-400">
                                            Mulai dari Rp 350.000
                                        </p>
                                    </div>
                                </label>
                            </div>

                            <!-- Restorasi -->
                            <div class="service-card bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                <label class="block p-6 cursor-pointer">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <span class="text-3xl">🔄</span>
                                            <div>
                                                <h3 class="text-xl font-semibold mb-1">Restorasi</h3>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">Mengembalikan kondisi motor seperti baru</p>
                                            </div>
                                        </div>
                                        <input type="radio" 
                                            name="servis_id" 
                                            value="3" 
                                            id="service_restorasi"
                                            class="w-5 h-5 text-blue-600 border-gray-300 rounded-full focus:ring-blue-500"
                                            onchange="updateServiceSelection(this)">
                                    </div>
                                    <div class="mt-4 pl-14">
                                        <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                                            <li>• Cat ulang</li>
                                            <li>• Rekondisi mesin</li>
                                            <li>• Perbaikan kelistrikan</li>
                                        </ul>
                                        <p class="mt-4 text-lg font-semibold text-blue-600 dark:text-blue-400">
                                            Mulai dari Rp 2.500.000
                                        </p>
                                    </div>
                                </label>
                            </div>

                            <!-- Ganti Sparepart -->
                            <div class="service-card bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                <label class="block p-6 cursor-pointer">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <span class="text-3xl">🔨</span>
                                            <div>
                                                <h3 class="text-xl font-semibold mb-1">Ganti Sparepart</h3>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm">Penggantian suku cadang berkualitas</p>
                                            </div>
                                        </div>
                                        <input type="radio" 
                                            name="servis_id" 
                                            value="4" 
                                            id="service_sparepart"
                                            class="w-5 h-5 text-blue-600 border-gray-300 rounded-full focus:ring-blue-500"
                                            onchange="updateServiceSelection(this)">
                                    </div>
                                    <div class="mt-4 pl-14">
                                        <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                                            <li>• Sparepart original</li>
                                            <li>• Garansi penggantian</li>
                                            <li>• Konsultasi gratis</li>
                                        </ul>
                                        <p class="mt-4 text-lg font-semibold text-blue-600 dark:text-blue-400">
                                            Mulai dari Rp 100.000
                                        </p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        @error('servis_id')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                        <!-- Navigation Buttons -->
                        <div class="mt-8 flex justify-between items-center">
                            <a href="{{ route('services.booking.motor') }}" 
                               class="px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg transition-colors duration-200">
                                Kembali ke Data Motor
                            </a>
                            <button type="submit" 
                                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                                Lanjut ke Jadwal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function updateServiceSelection(radio) {
        const cards = document.querySelectorAll('.service-card');
        const submitButton = document.querySelector('button[type="submit"]');
        const hiddenInput = document.getElementById('servis_id');
        
        // Remove selection styling from all cards
        cards.forEach(card => {
            card.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
        });
        
        // Add selection styling to selected card and update hidden input
        if (radio.checked) {
            // Get the selected service card
            const selectedCard = radio.closest('.service-card');
            
            // Add selection styling
            selectedCard.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
            
            // Enable submit button
            submitButton.disabled = false;
            submitButton.classList.remove('opacity-50');
            
            // Update hidden input with selected service value
            hiddenInput.value = radio.value;
            
            // Optional: Log selection for debugging
            console.log('Selected service:', radio.id, 'Value:', radio.value);
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const submitButton = document.querySelector('button[type="submit"]');
        const hiddenInput = document.getElementById('servis_id');
        
        // Disable submit button initially
        submitButton.disabled = true;
        submitButton.classList.add('opacity-50');

        // Restore previous selection if any
        const savedService = "{{ old('servis_id', session('booking.service.servis_id')) }}";
        if (savedService) {
            // Find the corresponding radio button
            const radio = document.querySelector(`input[value="${savedService}"]`);
            if (radio) {
                radio.checked = true;
                updateServiceSelection(radio);
            }
        }
    });
</script>
@endpush
@endsection