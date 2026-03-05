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

<div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
    <h2 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">Create New Booking</h2>
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="vehicle_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Vehicle</label>
                <select id="vehicle_id" name="vehicle_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="">Choose a vehicle</option>
                    @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }} - {{ $vehicle->type }} ({{ ucfirst($vehicle->condition) }})</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="driver_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Driver</label>
                <select id="driver_id" name="driver_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="">Choose a driver</option>
                    @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="approver_1_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Approver Level 1</label>
                <select id="approver_1_id" name="approver_1_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="">Select first approver</option>
                    @foreach($approvers as $approver)
                    <option value="{{ $approver->id }}">{{ $approver->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="approver_2_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Approver Level 2</label>
                <select id="approver_2_id" name="approver_2_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="">Select second approver</option>
                    @foreach($approvers as $approver)
                    <option value="{{ $approver->id }}">{{ $approver->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit Booking</button>
    </form>
</div>
@endsection
