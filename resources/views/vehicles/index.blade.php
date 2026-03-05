@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
  {{ session('success') }}
</div>
@endif

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold dark:text-white">Vehicles Management</h2>
    <a href="{{ route('vehicles.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add Vehicle</a>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Type</th>
                <th scope="col" class="px-6 py-3">Source</th>
                <th scope="col" class="px-6 py-3">Fuel Cons. (km/L)</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Condition</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vehicles as $vehicle)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <a href="{{ route('vehicles.show', $vehicle) }}" class="text-blue-600 hover:underline dark:text-blue-400">{{ $vehicle->name }}</a>
                </td>
                <td class="px-6 py-4 capitalize">{{ $vehicle->type }}</td>
                <td class="px-6 py-4 capitalize">{{ $vehicle->source }}</td>
                <td class="px-6 py-4">{{ $vehicle->fuel_consumption }}</td>
                <td class="px-6 py-4">
                    @if($vehicle->status == 'available')
                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Available</span>
                    @else
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Unavailable</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    @if($vehicle->condition == 'bagus')
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Bagus</span>
                    @else
                        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Tidak Bagus</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('vehicles.edit', $vehicle) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
            @empty
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td colspan="7" class="px-6 py-4 text-center">No vehicles found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
