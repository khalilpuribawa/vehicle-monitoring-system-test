<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::latest()->get();
        return \Inertia\Inertia::render('Vehicles/Index', [
            'vehicles' => $vehicles
        ]);
    }

    public function create()
    {
        return \Inertia\Inertia::render('Vehicles/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:angkutan orang,angkutan barang',
            'source' => 'required|in:milik,sewa',
            'fuel_consumption' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
            'condition' => 'required|in:bagus,tidak bagus',
        ]);

        $vehicle = Vehicle::create([
            'name' => $request->name,
            'type' => $request->type,
            'source' => $request->source,
            'fuel_consumption' => $request->fuel_consumption,
            'status' => $request->status,
            'condition' => $request->condition,
        ]);

        Log::create([
            'user_id' => Auth::id(),
            'action' => "Added new vehicle: " . $vehicle->name,
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle added successfully.');
    }

    public function edit(Vehicle $vehicle)
    {
        return \Inertia\Inertia::render('Vehicles/Edit', [
            'vehicle' => $vehicle
        ]);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:angkutan orang,angkutan barang',
            'source' => 'required|in:milik,sewa',
            'fuel_consumption' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
            'condition' => 'required|in:bagus,tidak bagus',
        ]);

        $vehicle->update([
            'name' => $request->name,
            'type' => $request->type,
            'source' => $request->source,
            'fuel_consumption' => $request->fuel_consumption,
            'status' => $request->status,
            'condition' => $request->condition,
        ]);

        Log::create([
            'user_id' => Auth::id(),
            'action' => "Updated vehicle: " . $vehicle->name,
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load(['bookings.driver', 'bookings.admin', 'fuelLogs', 'serviceSchedules']);
        return \Inertia\Inertia::render('Vehicles/Show', [
            'vehicle' => $vehicle
        ]);
    }

    public function storeFuel(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'date' => 'required|date',
            'added_amount' => 'required|numeric|min:0.1',
            'cost' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $vehicle->fuelLogs()->create($request->all());

        Log::create([
            'user_id' => Auth::id(),
            'action' => "Added fuel log for vehicle: " . $vehicle->name,
        ]);

        return redirect()->route('vehicles.show', $vehicle)->with('success', 'Fuel record added successfully.');
    }

    public function storeService(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'service_date' => 'required|date',
            'description' => 'required|string',
            'cost' => 'required|numeric|min:0',
        ]);

        $vehicle->serviceSchedules()->create([
            'service_date' => $request->service_date,
            'description' => $request->description,
            'cost' => $request->cost,
            'status' => 'scheduled',
        ]);

        $vehicle->update(['status' => 'unavailable', 'condition' => 'tidak bagus']);

        Log::create([
            'user_id' => Auth::id(),
            'action' => "Added service schedule for vehicle: " . $vehicle->name,
        ]);

        return redirect()->route('vehicles.show', $vehicle)->with('success', 'Service schedule added successfully.');
    }

    public function completeService(\App\Models\ServiceSchedule $service)
    {
        $service->update(['status' => 'completed']);
        $service->vehicle->update(['status' => 'available', 'condition' => 'bagus']);

        Log::create([
            'user_id' => Auth::id(),
            'action' => "Completed service for vehicle: " . $service->vehicle->name,
        ]);

        return redirect()->back()->with('success', 'Service marked as completed.');
    }
}
