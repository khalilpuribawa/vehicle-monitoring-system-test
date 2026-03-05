@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
  {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
  <ul class="list-disc pl-5">
      @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </ul>
</div>
@endif

<div class="mb-6 flex items-center justify-between">
    <h2 class="text-2xl font-bold dark:text-white">Vehicle Detail: {{ $vehicle->name }}</h2>
    <a href="{{ route('vehicles.index') }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">&larr; Back to Vehicles</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <!-- Vehicle Info Card -->
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Profile</h5>
        <div class="mt-4 space-y-2 text-sm text-gray-700 dark:text-gray-300">
            <p><span class="font-semibold">Type:</span> <span class="capitalize">{{ $vehicle->type }}</span></p>
            <p><span class="font-semibold">Source:</span> <span class="capitalize">{{ $vehicle->source }}</span></p>
            <p><span class="font-semibold">Fuel Cons.:</span> {{ $vehicle->fuel_consumption }} km/L</p>
            <p><span class="font-semibold">Status:</span> 
                @if($vehicle->status == 'available')
                    <span class="text-green-600 font-medium">Available</span>
                @else
                    <span class="text-gray-500 font-medium">Unavailable</span>
                @endif
            </p>
            <p><span class="font-semibold">Condition:</span> 
                @if($vehicle->condition == 'bagus')
                    <span class="text-blue-600 font-medium">Bagus</span>
                @else
                    <span class="text-red-600 font-medium">Tidak Bagus</span>
                @endif
            </p>
        </div>
    </div>

    <!-- Add Fuel Record Card -->
    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 md:col-span-2">
        <h5 class="mb-4 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Record Fuel Refill</h5>
        <form action="{{ route('vehicles.fuel.store', $vehicle) }}" method="POST">
            @csrf
            <div class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-3">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                    <input type="date" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount (Litres)</label>
                    <input type="number" step="0.1" name="added_amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cost (Rp)</label>
                    <input type="number" step="1000" name="cost" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <div class="md:col-span-3">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes (Optional)</label>
                    <input type="text" name="notes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                </div>
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">Save Fuel Log</button>
        </form>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Add & List Service Schedules -->
    <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h5 class="mb-4 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Schedule Maintenance</h5>
            <form action="{{ route('vehicles.service.store', $vehicle) }}" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Service Date</label>
                        <input type="date" name="service_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Est. Cost (Rp)</label>
                        <input type="number" step="1000" name="cost" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input type="text" name="description" placeholder="e.g. Ganti Oli dan Filter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    </div>
                </div>
                <button type="submit" class="text-white bg-yellow-600 hover:bg-yellow-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-500 dark:hover:bg-yellow-600">Schedule Service</button>
            </form>
        </div>

        <div class="p-6">
            <h5 class="mb-4 text-md font-bold text-gray-900 dark:text-white">Service History</h5>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Desc.</th>
                            <th class="px-4 py-2">Status</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vehicle->serviceSchedules as $service)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-3">{{ $service->service_date->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">{{ $service->description }}</td>
                            <td class="px-4 py-3">
                                @if($service->status == 'scheduled')
                                    <span class="text-xs font-medium px-2 py-0.5 rounded bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">Scheduled</span>
                                @else
                                    <span class="text-xs font-medium px-2 py-0.5 rounded bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Completed</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($service->status == 'scheduled')
                                <form action="{{ route('vehicles.service.complete', $service) }}" method="POST" onsubmit="return confirm('Mark as completed?');">
                                    @csrf
                                    <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Complete</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-center">No service records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Usage History (Bookings) & Fuel Logs list -->
    <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-6 flex flex-col gap-6">
        <div>
            <h5 class="mb-4 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Usage History (Bookings)</h5>
            <div class="relative overflow-x-auto max-h-60 overflow-y-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Admin (Requested By)</th>
                            <th class="px-4 py-2">Driver</th>
                            <th class="px-4 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vehicle->bookings()->latest()->get() as $booking)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-3">{{ $booking->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">{{ optional($booking->admin)->name }}</td>
                            <td class="px-4 py-3">{{ optional($booking->driver)->name }}</td>
                            <td class="px-4 py-3 capitalize 
                                @if($booking->status == 'approved') text-green-600 
                                @elseif($booking->status == 'rejected') text-red-600
                                @else text-yellow-600 @endif
                            ">
                                {{ $booking->status }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-center">No bookings found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h5 class="mb-4 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Fuel Purchase Logs</h5>
            <div class="relative overflow-x-auto max-h-48 overflow-y-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Litres</th>
                            <th class="px-4 py-2">Cost</th>
                            <th class="px-4 py-2">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vehicle->fuelLogs()->latest()->get() as $fuel)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-4 py-3">{{ $fuel->date->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">{{ $fuel->added_amount }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($fuel->cost, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $fuel->notes }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-center">No fuel logs found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
