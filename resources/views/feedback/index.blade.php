@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Feedback Pelanggan</h1>

    @can('create', App\Models\Feedback::class)
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-8">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Beri Feedback</h2>
        <form id="feedbackForm" action="{{ route('feedback.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="rating" class="block text-gray-700 text-sm font-bold mb-2">Rating</label>
                <div class="flex items-center" id="star-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden" required />
                        <label for="star{{ $i }}" class="text-3xl cursor-pointer text-gray-300 hover:text-yellow-400 star-label transition-colors duration-200">
                            &#9733;
                        </label>
                    @endfor
                </div>
                @error('rating')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="komentar" class="block text-gray-700 text-sm font-bold mb-2">Komentar</label>
                <textarea id="komentar" name="komentar" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4"></textarea>
                @error('komentar')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
                    Kirim Feedback
                </button>
            </div>
        </form>
    </div>
    @endcan

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Daftar Feedback</h2>
        <div id="feedbackList" class="space-y-6">
            @foreach ($feedbacks as $feedback)
                <div class="border-b border-gray-200 pb-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="text-2xl {{ $i <= $feedback->rating ? 'text-yellow-400' : 'text-gray-300' }}">&#9733;</span>
                                @endfor
                            </div>
                            <p class="text-gray-600 mb-2">{{ $feedback->komentar }}</p>
                            <p class="text-sm text-gray-500">Oleh: {{ $feedback->pelanggan->nama ?? 'Anonim' }}</p>
                        </div>
                        @can('delete', $feedback)
                        <form action="{{ route('feedback.destroy', $feedback) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 transition duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Pop-up Notification -->
<div id="notification" class="fixed inset-0 flex items-center justify-center hidden">
    <div class="bg-white border border-gray-300 rounded-lg p-6 shadow-lg">
        <p class="text-xl font-semibold text-gray-800 mb-4">Terima Kasih!</p>
        <p class="text-gray-600">Feedback Anda telah berhasil dikirim.</p>
        <button id="closeNotification" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-200">
            Tutup
        </button>
    </div>
</div>

<style>
@keyframes starPop {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

.star-pop {
    animation: starPop 0.3s ease-out;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const starRating = document.getElementById('star-rating');
    const stars = starRating.querySelectorAll('.star-label');
    const form = document.getElementById('feedbackForm');
    const notification = document.getElementById('notification');
    const closeNotification = document.getElementById('closeNotification');

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            stars.forEach((s, i) => {
                if (i <= index) {
                    s.classList.add('text-yellow-400', 'star-pop');
                    s.classList.remove('text-gray-300');
                } else {
                    s.classList.remove('text-yellow-400', 'star-pop');
                    s.classList.add('text-gray-300');
                }
            });
        });

        star.addEventListener('animationend', () => {
            star.classList.remove('star-pop');
        });
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                notification.classList.remove('hidden');
                form.reset();
                stars.forEach(s => {
                    s.classList.remove('text-yellow-400');
                    s.classList.add('text-gray-300');
                });
                
                // Refresh feedback list
                const feedbackList = document.getElementById('feedbackList');
                feedbackList.innerHTML = data.feedbackListHtml;
            }
        });
    });

    closeNotification.addEventListener('click', () => {
        notification.classList.add('hidden');
    });

    // Event delegation for delete buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-form')) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus feedback ini?')) {
                const form = e.target.closest('.delete-form');
                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        form.closest('.border-b').remove();
                    }
                });
            }
        }
    });
});
</script>
@endsection