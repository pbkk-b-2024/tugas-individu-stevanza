@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Dashboard Admin Service</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h2 class="text-xl font-semibold mb-4">Booking Hari Ini</h2>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Pelanggan</th>
                            <th class="py-3 px-6 text-left">Motor</th>
                            <th class="py-3 px-6 text-left">Keluhan</th>
                            <th class="py-3 px-6 text-center">Status</th>
                            <th class="py-3 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach($todayBookings as $booking)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                {{ $booking->user->name }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $booking->motor->merk }} {{ $booking->motor->model }} ({{ $booking->motor->nomor_plat }})
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ Str::limit($booking->keluhan, 50) }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span class="bg-{{ $booking->status == 'completed' ? 'green' : ($booking->status == 'in_progress' ? 'yellow' : 'red') }}-200 text-{{ $booking->status == 'completed' ? 'green' : ($booking->status == 'in_progress' ? 'yellow' : 'red') }}-600 py-1 px-3 rounded-full text-xs">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <form action="{{ route('services.updateStatus', $booking) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="text-sm border rounded px-2 py-1 mr-2">
                                        <option value="in_progress" {{ $booking->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <select name="mekanik_id" class="text-sm border rounded px-2 py-1 mr-2">
                                        @foreach($availableMechanics as $mechanic)
                                            <option value="{{ $mechanic->id }}" {{ $booking->mekanik_id == $mechanic->id ? 'selected' : '' }}>
                                                {{ $mechanic->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-xs font-bold py-1 px-2 rounded">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div>
            <h2 class="text-xl font-semibold mb-4">Mekanik Tersedia</h2>
            <ul class="bg-white shadow-md rounded-lg p-4">
                @foreach($availableMechanics as $mechanic)
                    <li class="mb-2">{{ $mechanic->nama }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection