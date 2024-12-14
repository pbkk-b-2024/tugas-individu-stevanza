@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold mb-4">Welcome to Gian Motors</h1>
                
                <div class="mb-6">
                    <p>Gian Motors is your trusted partner for all your automotive needs. With state-of-the-art equipment and expert mechanics, we provide top-notch service for all makes and models.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Quick Service Booking Widget -->
                    <div class="bg-blue-100 dark:bg-blue-800 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Quick Service Booking</h2>
                        <p class="mb-4">Schedule your next service appointment with ease.</p>
                        <a href="{{ route('services.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Book Now
                        </a>
                    </div>

                    <!-- Our Services Widget -->
                    <div class="bg-green-100 dark:bg-green-800 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Our Services</h2>
                        <p class="mb-4">Explore our wide range of automotive services.</p>
                        <a href="{{ route('services.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            View Services
                        </a>
                    </div>

                    <!-- Customer Feedback Widget -->
                    <div class="bg-yellow-100 dark:bg-yellow-800 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Customer Feedback</h2>
                        <p class="mb-4">We value your opinion. Share your experience with us.</p>
                        <a href="{{ route('feedback') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Give Feedback
                        </a>
                    </div>
                </div>

                @if(auth()->user()->isAdmin())
                    <div class="mt-8 p-4 bg-red-100 dark:bg-red-800 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Admin Dashboard</h2>
                        <p>Welcome, Admin! Access advanced features and management tools here.</p>
                        <a href="{{ route('admin.dashboard') }}" class="mt-2 inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Go to Admin Dashboard
                        </a>
                    </div>
                @endif

                @if(auth()->user()->isUser())
                    <div class="mt-8 p-4 bg-purple-100 dark:bg-purple-800 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Your Account</h2>
                        <p>Welcome back! View your service history, upcoming appointments, and more.</p>
                        <a href="{{ route('user.dashboard') }}" class="mt-2 inline-block bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                            View Account Details
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection