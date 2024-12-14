<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Feedback::class);
        $feedbacks = Feedback::with('pelanggan.user')->latest()->get();
        return view('feedback.index', compact('feedbacks'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Feedback::class);

        $request->validate([
            'komentar' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $user = Auth::user();
        $pelanggan = $user->pelanggan;

        if (!$pelanggan) {
            return response()->json(['error' => 'Anda harus melengkapi profil pelanggan terlebih dahulu.'], 422);
        }

        $feedback = Feedback::create([
            'pelanggan_id' => $pelanggan->id,
            'komentar' => $request->komentar,
            'rating' => $request->rating,
        ]);

        if ($request->ajax()) {
            $feedbacks = Feedback::with('pelanggan.user')->latest()->get();
            $feedbackListHtml = view('feedback.list', compact('feedbacks'))->render();
            return response()->json([
                'success' => true,
                'message' => 'Feedback berhasil ditambahkan.',
                'feedbackListHtml' => $feedbackListHtml
            ]);
        }

        return redirect()->route('feedback')->with('success', 'Feedback berhasil ditambahkan.');
    }

    public function destroy(Feedback $feedback)
    {
        $this->authorize('delete', $feedback);
    
        $feedback->delete();
    
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Feedback berhasil dihapus.'
            ]);
        }
    
        return redirect()->route('feedback')->with('success', 'Feedback berhasil dihapus.');
    }
}