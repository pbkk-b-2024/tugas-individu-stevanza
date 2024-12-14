<?php

namespace App\Http\Controllers;

use App\Models\Servis;
use App\Models\Booking;
use App\Models\Motor;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        // Get active bookings for authenticated user
        $bookings = Auth::user()->bookings()
            ->with(['motor', 'servis'])
            ->where('status', '!=', 'completed')
            ->latest()
            ->take(3)
            ->get();

        // Get all services
        $services = Servis::all();

        return view('services.index', compact('bookings', 'services'));
    }

    public function motorDataForm()
    {
        return view('services.booking.motor');
    }

    public function storeMotorData(Request $request)
    {
        $validated = $request->validate([
            'merk' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'tahun' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'nomor_plat' => 'required|string|max:20',
        ]);

        // Store in session
        $request->session()->put('booking.motor', $validated);

        return redirect()->route('services.booking.service');
    }

    public function serviceSelectionForm()
    {
        if (!session()->has('booking.motor')) {
            return redirect()->route('services.booking.motor');
        }

        $services = Servis::all();
        return view('services.booking.service', compact('services'));
    }

    public function storeServiceSelection(Request $request)
    {
        $validated = $request->validate([
            'servis_id' => 'required|exists:service_categories,id'
        ]);

        $request->session()->put('booking.service', $validated);

        return redirect()->route('services.booking.schedule');
    }

    public function scheduleForm()
    {
        if (!session()->has('booking.service')) {
            return redirect()->route('services.booking.service');
        }

        return view('services.booking.schedule');
    }

    public function storeBooking(Request $request)
    {
        if (!session()->has(['booking.motor', 'booking.service'])) {
            return redirect()->route('services.booking.motor');
        }

        $request->validate([
            'booking_date' => 'required|date|after:today',
            'keluhan' => 'nullable|string|max:1000',
        ]);

        $motorData = session('booking.motor');
        $serviceData = session('booking.service');

        // Get or create pelanggan record
        $pelanggan = Pelanggan::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ]
        );

        // Create or update motor
        $motor = Motor::firstOrCreate(
            ['nomor_plat' => $motorData['nomor_plat']],
            [
                'user_id' => Auth::id(),
                'pelanggan_id' => $pelanggan->id, 
                'merk' => $motorData['merk'],
                'model' => $motorData['model'],
                'tahun' => $motorData['tahun'],
            ]
        );

        // Create booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'pelanggan_id' => $pelanggan->id,
            'motor_id' => $motor->id,
            'servis_id' => $serviceData['servis_id'],
            'tanggal_booking' => $request->booking_date,
            'keluhan' => $request->keluhan,
            'status' => 'pending',
        ]);

        // Create corresponding service record
        Servis::create([
            'motor_id' => $motor->id,
            'pelanggan_id' => $pelanggan->id,
            'booking_id' => $booking->id,
            'service_category_id' => $serviceData['servis_id'],
            'deskripsi' => $request->keluhan
        ]);

        // Clear booking session data
        $request->session()->forget('booking');

        return redirect()->route('services.index')
            ->with('success', 'Booking berhasil dibuat!')
            ->with('booking_info', [
                'tanggal' => $request->booking_date,
                'nomor_plat' => $motorData['nomor_plat'],
                'service' => $serviceData['servis_id']
            ]);
    }

    public function showBooking(Booking $booking)
    {
        // Check if the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        
        return view('services.booking.show', compact('booking'));
    }

    public function bookingHistory()
    {
        $bookings = Auth::user()->bookings()
            ->with(['motor'])
            ->latest()
            ->paginate(10);
            
        return view('services.booking.history', compact('bookings'));
    }

    public function adminBookings(Request $request)
    {
        // Check authorization
        $this->authorize('manageBookings', Service::class);

        // Get bookings with filters
        $query = Booking::with(['user', 'motor'])
            ->latest();

        // Apply status filter if provided
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Paginate results
        $bookings = $query->paginate(10);

        return view('services.admin.bookings', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        // Check authorization
        $this->authorize('manageBookings', Service::class);

        // Validate request
        $request->validate([
            'status' => 'required|in:pending,processing,finished'
        ]);

        // Update booking status
        $booking->update([
            'status' => $request->status
        ]);

        return redirect()->route('services.admin.bookings')
            ->with('success', 'Status booking berhasil diperbarui');
    }
}