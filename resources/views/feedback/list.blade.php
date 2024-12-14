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