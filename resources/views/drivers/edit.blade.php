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
    <h2 class="text-2xl font-bold dark:text-white">Edit Driver: {{ $driver->name }}</h2>
    <a href="{{ route('drivers.index') }}" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">&larr; Back to Drivers</a>
</div>

<div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
    <form action="{{ route('drivers.update', $driver) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Driver Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $driver->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>

            <div>
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="available" {{ old('status', $driver->status) == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="busy" {{ old('status', $driver->status) == 'busy' ? 'selected' : '' }}>Busy</option>
                </select>
            </div>
        </div>
        
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Driver</button>
    </form>
</div>
@endsection
