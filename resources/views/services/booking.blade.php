@extends('layouts.app')

@push('styles')
<style>
    .service-card.selected {
        border-color: #2563eb;
        background-color: #eff6ff;
    }
    
    .error-message {
        color: #dc2626;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .form-input.error {
        border-color: #dc2626;
    }
</style>
@endpush

@section('content')
<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Booking Service</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Silahkan isi form berikut untuk melakukan booking service</p>
        </div>

        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-between relative">
                <!-- Progress Bar -->
                <div class="absolute top-5 left-0 w-full h-1 bg-gray-200 dark:bg-gray-700">
                    <div class="h-full bg-blue-600 transition-all duration-300" style="width: 0%" id="progressBar"></div>
                </div>
                
                <!-- Step Indicators -->
                <div class="relative z-10 flex justify-between w-full px-2">
                    <div class="step-item flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-blue-600 text-white font-semibold" id="step1">1</div>
                        <span class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">Data Motor</span>
                    </div>
                    <div class="step-item flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 font-semibold" id="step2">2</div>
                        <span class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">Pilih Layanan</span>
                    </div>
                    <div class="step-item flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 font-semibold" id="step3">3</div>
                        <span class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">Jadwal</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Steps -->
        <form action="{{ route('services.book') }}" method="POST" id="bookingForm">
            @csrf
            
            <!-- Step 1: Data Motor -->
            <div class="step bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden" id="step1Content">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-6 text-gray-900 dark:text-white">Data Kendaraan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Merk Motor</label>
                            <input type="text" name="merk" class="form-input w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
                            <span class="error-message" id="merkError"></span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Model Motor</label>
                            <input type="text" name="model" class="form-input w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
                            <span class="error-message" id="modelError"></span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tahun Pembuatan</label>
                            <input type="number" name="tahun" min="1970" max="{{ date('Y') }}" class="form-input w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
                            <span class="error-message" id="tahunError"></span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nomor Plat</label>
                            <input type="text" name="nomor_plat" class="form-input w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
                            <span class="error-message" id="nomorPlatError"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Pilih Layanan -->
            <div class="step hidden bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden" id="step2Content">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-6 text-gray-900 dark:text-white">Pilih Layanan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Service Berkala -->
                        <div class="service-card p-6 border dark:border-gray-700 rounded-lg cursor-pointer hover:shadow-lg transition-all"
                             data-service-id="1">
                            <div class="text-3xl mb-3">🔧</div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Service Berkala</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">Perawatan rutin untuk menjaga performa motor tetap optimal</p>
                            <ul class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                <li>✓ Pengecekan komponen</li>
                                <li>✓ Penyetelan mesin</li>
                                <li>✓ Ganti oli</li>
                            </ul>
                            <p class="mt-4 text-blue-600 dark:text-blue-400 font-semibold">
                                Mulai dari Rp 200.000
                            </p>
                        </div>

                        <!-- Tune Up -->
                        <div class="service-card p-6 border dark:border-gray-700 rounded-lg cursor-pointer hover:shadow-lg transition-all"
                             data-service-id="2">
                            <div class="text-3xl mb-3">⚙️</div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tune Up</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">Optimalisasi performa mesin untuk kinerja maksimal</p>
                            <ul class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                <li>✓ Pembersihan karburator</li>
                                <li>✓ Penyetelan klep</li>
                                <li>✓ Kalibrasi ECU</li>
                            </ul>
                            <p class="mt-4 text-blue-600 dark:text-blue-400 font-semibold">
                                Mulai dari Rp 350.000
                            </p>
                        </div>

                        <!-- Restorasi -->
                        <div class="service-card p-6 border dark:border-gray-700 rounded-lg cursor-pointer hover:shadow-lg transition-all"
                             data-service-id="3">
                            <div class="text-3xl mb-3">🔄</div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Restorasi</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">Mengembalikan kondisi motor seperti baru</p>
                            <ul class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                <li>✓ Cat ulang</li>
                                <li>✓ Rekondisi mesin</li>
                                <li>✓ Perbaikan kelistrikan</li>
                            </ul>
                            <p class="mt-4 text-blue-600 dark:text-blue-400 font-semibold">
                                Mulai dari Rp 2.500.000
                            </p>
                        </div>

                        <!-- Pemasangan Sparepart -->
                        <div class="service-card p-6 border dark:border-gray-700 rounded-lg cursor-pointer hover:shadow-lg transition-all"
                             data-service-id="4">
                            <div class="text-3xl mb-3">🔨</div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pemasangan Sparepart</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">Instalasi dan penggantian suku cadang</p>
                            <ul class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                <li>✓ Penggantian parts</li>
                                <li>✓ Upgrade komponen</li>
                                <li>✓ Konsultasi sparepart</li>
                            </ul>
                            <p class="mt-4 text-blue-600 dark:text-blue-400 font-semibold">
                                Mulai dari Rp 100.000
                            </p>
                        </div>
                        <input type="hidden" name="servis_id" id="servis_id" required>
                    </div>
                    <span class="error-message" id="servisError"></span>
                </div>
            </div>

            <!-- Step 3: Jadwal -->
            <div class="step hidden bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden" id="step3Content">
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-6 text-gray-900 dark:text-white">Pilih Jadwal</h2>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Service</label>
                            <input type="date" name="booking_date" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Keluhan / Catatan</label>
                            <textarea name="keluhan" rows="4" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between mt-6">
                <button type="button" id="prevBtn" class="hidden px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                    Kembali
                </button>
                <button type="button" id="nextBtn" class="ml-auto px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Lanjut
                </button>
                <button type="submit" id="submitBtn" class="hidden ml-auto px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Konfirmasi Booking
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize variables
    let currentStep = 1;
    const totalSteps = 3;
    const form = document.getElementById('bookingForm');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');
    const progressBar = document.getElementById('progressBar');

    // Validation functions for each step
    const validateStep1 = () => {
        const fields = ['merk', 'model', 'tahun', 'nomor_plat'];
        let isValid = true;

        // Reset previous error messages
        fields.forEach(field => {
            const errorElement = document.getElementById(`${field}Error`);
            if (errorElement) {
                errorElement.textContent = '';
            }
        });

        // Validate each field
        fields.forEach(field => {
            const input = document.querySelector(`[name="${field}"]`);
            const errorElement = document.getElementById(`${field}Error`);
            
            if (!input.value.trim()) {
                if (errorElement) {
                    errorElement.textContent = `${field.charAt(0).toUpperCase() + field.slice(1)} harus diisi`;
                }
                isValid = false;
            } else if (field === 'tahun') {
                const year = parseInt(input.value);
                const currentYear = new Date().getFullYear();
                if (isNaN(year) || year < 1970 || year > currentYear) {
                    if (errorElement) {
                        errorElement.textContent = `Tahun harus antara 1970 - ${currentYear}`;
                    }
                    isValid = false;
                }
            }
        });

        return isValid;
    };

    const validateStep2 = () => {
        const serviceId = document.getElementById('servis_id').value;
        const errorElement = document.getElementById('servisError');
        
        if (!serviceId) {
            if (errorElement) {
                errorElement.textContent = 'Silahkan pilih layanan service';
            }
            return false;
        }
        
        if (errorElement) {
            errorElement.textContent = '';
        }
        return true;
    };

    const validateStep3 = () => {
        const bookingDate = document.querySelector('input[name="booking_date"]').value;
        const dateError = document.getElementById('dateError');
        
        if (!bookingDate) {
            if (dateError) {
                dateError.textContent = 'Tanggal booking harus diisi';
            }
            return false;
        }

        // Validate that booking date is in the future
        const selectedDate = new Date(bookingDate);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (selectedDate <= today) {
            if (dateError) {
                dateError.textContent = 'Tanggal booking harus lebih dari hari ini';
            }
            return false;
        }

        if (dateError) {
            dateError.textContent = '';
        }
        return true;
    };

    // Update step visibility and progress
    const updateStep = (step) => {
        // Hide all steps
        document.querySelectorAll('.step').forEach(el => {
            el.classList.add('hidden');
        });

        // Show current step
        const currentStepElement = document.getElementById(`step${step}Content`);
        if (currentStepElement) {
            currentStepElement.classList.remove('hidden');
        }

        // Update progress bar
        if (progressBar) {
            progressBar.style.width = `${((step - 1) / (totalSteps - 1)) * 100}%`;
        }

        // Update step indicators
        for (let i = 1; i <= totalSteps; i++) {
            const indicator = document.getElementById(`step${i}`);
            if (indicator) {
                if (i <= step) {
                    indicator.classList.remove('bg-gray-200', 'dark:bg-gray-700');
                    indicator.classList.add('bg-blue-600', 'text-white');
                } else {
                    indicator.classList.add('bg-gray-200', 'dark:bg-gray-700');
                    indicator.classList.remove('bg-blue-600', 'text-white');
                }
            }
        }

        // Show/hide navigation buttons
        if (prevBtn) prevBtn.classList.toggle('hidden', step === 1);
        if (nextBtn) nextBtn.classList.toggle('hidden', step === totalSteps);
        if (submitBtn) submitBtn.classList.toggle('hidden', step !== totalSteps);
    };

    // Event Listeners
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            let isValid = false;
            
            switch(currentStep) {
                case 1:
                    isValid = validateStep1();
                    break;
                case 2:
                    isValid = validateStep2();
                    break;
                case 3:
                    isValid = validateStep3();
                    break;
            }

            if (isValid && currentStep < totalSteps) {
                currentStep++;
                updateStep(currentStep);
            }
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                updateStep(currentStep);
            }
        });
    }

    // Service card selection
    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('click', function() {
            // Remove selection from all cards
            document.querySelectorAll('.service-card').forEach(c => {
                c.classList.remove('selected', 'border-blue-500', 'bg-blue-50');
            });
            
            // Add selection to clicked card
            this.classList.add('selected', 'border-blue-500', 'bg-blue-50');
            
            // Update hidden input
            const serviceId = this.dataset.serviceId;
            document.getElementById('servis_id').value = serviceId;
            
            // Clear error message if exists
            const errorElement = document.getElementById('servisError');
            if (errorElement) {
                errorElement.textContent = '';
            }
        });
    });

    // Form submission
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            let isValid = false;
            switch(currentStep) {
                case 1:
                    isValid = validateStep1();
                    break;
                case 2:
                    isValid = validateStep2();
                    break;
                case 3:
                    isValid = validateStep3();
                    break;
            }

            if (isValid) {
                this.submit();
            }
        });
    }

    // Initialize first step
    updateStep(1);
});
</script>
@endpush
@endsection