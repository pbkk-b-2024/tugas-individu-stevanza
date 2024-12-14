<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Ubah rute default '/' menjadi halaman login
Route::redirect('/', '/login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/booking', [ServiceController::class, 'bookingForm'])->name('services.booking');
    Route::post('/services/book', [ServiceController::class, 'book'])->name('services.book');
    
    Route::middleware(['admin'])->group(function () {
        Route::get('/services/admin', [ServiceController::class, 'adminDashboard'])->name('services.admin');
        Route::patch('/services/{booking}/update-status', [ServiceController::class, 'updateBookingStatus'])->name('services.updateStatus');
    });

    // Rute untuk feedback (diperbarui)
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])
        ->middleware('can:delete,feedback')
        ->name('feedback.destroy');

    // Rute untuk produk
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::patch('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');

    Route::middleware('can:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });

    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    Route::resource('orders', OrderController::class);
    Route::patch('/orders/{order}/confirm', [OrderController::class, 'confirmOrder'])->name('orders.confirm');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
    Route::patch('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

        // Services routes
        Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
        
        // Booking routes
        Route::get('/services/booking/motor', [ServiceController::class, 'motorDataForm'])->name('services.booking.motor');
        Route::post('/services/booking/motor', [ServiceController::class, 'storeMotorData'])->name('services.booking.motor.store');
        
        Route::get('/services/booking/service', [ServiceController::class, 'serviceSelectionForm'])->name('services.booking.service');
        Route::post('/services/booking/service', [ServiceController::class, 'storeServiceSelection'])->name('services.booking.service.store');
        
        Route::get('/services/booking/schedule', [ServiceController::class, 'scheduleForm'])->name('services.booking.schedule');
        Route::post('/services/booking/schedule', [ServiceController::class, 'storeBooking'])->name('services.booking.schedule.store');
        
        // Admin routes
        Route::get('/services/admin/bookings', [ServiceController::class, 'adminBookings'])->name('services.admin.bookings');
        Route::patch('/services/admin/bookings/{booking}/status', [ServiceController::class, 'updateStatus'])->name('services.admin.updateStatus');
        
        // Booking history and details
        Route::get('/services/bookings/{booking}', [ServiceController::class, 'showBooking'])->name('services.booking.show');
        Route::get('/services/bookings', [ServiceController::class, 'bookingHistory'])->name('services.booking.history');

        Route::get('/services/list', [ServiceController::class, 'servicesList'])
            ->name('services.list');
    });

    // Admin routes
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');


require __DIR__.'/auth.php';