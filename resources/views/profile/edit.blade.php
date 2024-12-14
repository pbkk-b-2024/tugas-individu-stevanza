@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200 mb-6">{{ __('Edit Profile') }}</h2>

            <!-- Notification for successful update -->
            @if (session('status') === 'profile-updated')
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ __('Profile updated successfully!') }}
                </div>
            @endif

            <!-- Update Profile Information Form -->
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Name') }}</label>
                    <input id="name" type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300" />
                    @error('name')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300" />
                    @error('email')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Alamat (Optional) -->
                <div class="mb-4">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Address') }} (Optional)</label>
                    <input id="alamat" type="text" name="alamat" value="{{ old('alamat', auth()->user()->pelanggan->alamat ?? '') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300" />
                    @error('alamat')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nomor Telepon (Optional) -->
                <div class="mb-4">
                    <label for="nomor_telepon" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Phone Number') }} (Optional)</label>
                    <input id="nomor_telepon" type="text" name="nomor_telepon" value="{{ old('nomor_telepon', auth()->user()->pelanggan->nomor_telepon ?? '') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300" />
                    @error('nomor_telepon')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Update Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('New Password') }}</label>
                    <input id="password" type="password" name="password"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300" />
                    @error('password')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-200">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-gray-300" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                        {{ __('Update Profile') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection