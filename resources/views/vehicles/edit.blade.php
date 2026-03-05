@extends('layouts.app')

@section('content')

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
    <h2 class="text-2xl font-bold dark:text-white">Edit Vehicle: {{ $vehicle->name }}</h2>
    <a href="{{ route('vehicles.index') }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">&larr; Back to Vehicles</a>
</div>

<div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
    <form action="{{ route('vehicles.update', $vehicle) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle Name/Model</label>
                <input type="text" id="name" name="name" value="{{ old('name', $vehicle->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>

            <div>
                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="angkutan orang" {{ old('type', $vehicle->type) == 'angkutan orang' ? 'selected' : '' }}>Angkutan Orang</option>
                    <option value="angkutan barang" {{ old('type', $vehicle->type) == 'angkutan barang' ? 'selected' : '' }}>Angkutan Barang</option>
                </select>
            </div>
            
            <div>
                <label for="source" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Source</label>
                <select id="source" name="source" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="milik" {{ old('source', $vehicle->source) == 'milik' ? 'selected' : '' }}>Milik Sendiri</option>
                    <option value="sewa" {{ old('source', $vehicle->source) == 'sewa' ? 'selected' : '' }}>Sewa</option>
                </select>
            </div>
            
            <div>
                <label for="fuel_consumption" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fuel Consumption (km/L)</label>
                <input type="number" step="0.01" id="fuel_consumption" name="fuel_consumption" value="{{ old('fuel_consumption', $vehicle->fuel_consumption) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>

            <div>
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="available" {{ old('status', $vehicle->status) == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="unavailable" {{ old('status', $vehicle->status) == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>
            
            <div>
                <label for="condition" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Condition</label>
                <select id="condition" name="condition" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="bagus" {{ old('condition', $vehicle->condition) == 'bagus' ? 'selected' : '' }}>Bagus</option>
                    <option value="tidak bagus" {{ old('condition', $vehicle->condition) == 'tidak bagus' ? 'selected' : '' }}>Tidak Bagus</option>
                </select>
            </div>
        </div>
        
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Vehicle</button>
    </form>
</div>
@endsection
