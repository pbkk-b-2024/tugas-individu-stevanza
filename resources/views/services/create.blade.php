@extends('layouts.app')

@section('title', 'Layanan Servis')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Layanan Servis</h1>

    @can('create', App\Models\Servis::class)
    <div class="mb-4">
        <a href="{{ route('services.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Tambah Servis Baru
        </a>
    </div>
    @endcan

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Motor</th>
                    <th class="py-3 px-6 text-left">Mekanik</th>
                    <th class="py-3 px-6 text-left">Pelanggan</th>
                    <th class="py-3 px-6 text-center">Status</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($services as $service)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $service->id }}</td>
                    <td class="py-3 px-6 text-left">{{ $service->motor->name }}</td>
                    <td class="py-3 px-6 text-left">{{ $service->mekanik->name }}</td>
                    <td class="py-3 px-6 text-left">{{ $service->pelanggan->name }}</td>
                    <td class="py-3 px-6 text-center">
                        <span class="bg-{{ $service->status == 'completed' ? 'green' : ($service->status == 'in_progress' ? 'yellow' : 'red') }}-200 text-{{ $service->status == 'completed' ? 'green' : ($service->status == 'in_progress' ? 'yellow' : 'red') }}-600 py-1 px-3 rounded-full text-xs">
                            {{ ucfirst($service->status) }}
                        </span>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            @can('view', $service)
                            <a href="{{ route('services.show', $service) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            @endcan
                            @can('update', $service)
                            <a href="{{ route('services.edit', $service) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                            @endcan
                            @can('delete', $service)
                            <form action="{{ route('services.destroy', $service) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus servis ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-4 transform hover:text-red-500 hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
