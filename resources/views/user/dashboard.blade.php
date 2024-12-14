@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-4">User Dashboard</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Service History -->
                    <div class="bg-blue-100 dark:bg-blue-800 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Service History</h2>
                        <p class="mb-4">View your past service records.</p>
                        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            View History
                        </a>
                    </div>

                    <!-- Upcoming Appointments -->
                    <div class="bg-green-100 dark:bg-green-800 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Upcoming Appointments</h2>
                        <p class="mb-4">Check your scheduled services.</p>
                        <a href="#" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            View Appointments
                        </a>
                    </div>

                    <!-- Submit Feedback -->
                    <div class="bg-yellow-100 dark:bg-yellow-800 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Submit Feedback</h2>
                        <p class="mb-4">Share your experience with us.</p>
                        <a href="{{ route('feedback') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Give Feedback
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection