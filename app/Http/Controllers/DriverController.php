<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::latest()->get();
        return \Inertia\Inertia::render('Drivers/Index', [
            'drivers' => $drivers
        ]);
    }

    public function create()
    {
        return \Inertia\Inertia::render('Drivers/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,busy',
        ]);

        $driver = Driver::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        Log::create([
            'user_id' => Auth::id(),
            'action' => "Added new driver: " . $driver->name,
        ]);

        return redirect()->route('drivers.index')->with('success', 'Driver added successfully.');
    }

    public function edit(Driver $driver)
    {
        return \Inertia\Inertia::render('Drivers/Edit', [
            'driver' => $driver
        ]);
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,busy',
        ]);

        $driver->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        Log::create([
            'user_id' => Auth::id(),
            'action' => "Updated driver: " . $driver->name,
        ]);

        return redirect()->route('drivers.index')->with('success', 'Driver updated successfully.');
    }
}
