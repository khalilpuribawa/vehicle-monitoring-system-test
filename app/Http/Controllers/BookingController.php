<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\User;
use App\Models\Approval;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            $bookings = Booking::with(['vehicle', 'driver', 'approvals.approver'])->latest()->get();
        } else {
            // Approvers see bookings they need to approve
            $bookings = Booking::whereHas('approvals', function($q) use ($user) {
                $q->where('approver_id', $user->id);
            })->with(['vehicle', 'driver', 'approvals.approver'])->latest()->get();
        }

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $vehicles = Vehicle::where('status', 'available')->get();
        $drivers = Driver::where('status', 'available')->get();
        $approvers = User::whereIn('role', ['approver', 'approver_level_1', 'approver_level_2'])->get(); // Based on how db is seeded

        return view('bookings.create', compact('vehicles', 'drivers', 'approvers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'approver_1_id' => 'required|exists:users,id|different:approver_2_id',
            'approver_2_id' => 'required|exists:users,id',
        ]);

        $booking = Booking::create([
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'admin_id' => Auth::id(),
            'status' => 'pending',
        ]);

        // Create Level 1 Approval
        Approval::create([
            'booking_id' => $booking->id,
            'approver_id' => $request->approver_1_id,
            'level' => 1,
            'status' => 'pending',
        ]);

        // Create Level 2 Approval
        Approval::create([
            'booking_id' => $booking->id,
            'approver_id' => $request->approver_2_id,
            'level' => 2,
            'status' => 'pending',
        ]);

        Log::create([
            'user_id' => Auth::id(),
            'action' => "Created booking ID: " . $booking->id,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function approve(Booking $booking)
    {
        $user = Auth::user();
        $approval = $booking->approvals()->where('approver_id', $user->id)->first();

        if (!$approval) {
            return back()->with('error', 'Unauthorized access.');
        }

        // Sequential Check
        if ($approval->level == 2) {
            $level1 = $booking->approvals()->where('level', 1)->first();
            if ($level1->status !== 'approved') {
                return back()->with('error', 'Level 1 must approve first.');
            }
        }

        $approval->update(['status' => 'approved']);
        Log::create(['user_id' => $user->id, 'action' => "Approved booking ID: {$booking->id} (Level {$approval->level})"]);

        // Check overall status
        $allApproved = $booking->approvals()->where('status', 'approved')->count() == 2;
        if ($allApproved) {
            $booking->update(['status' => 'approved']);
        }

        return back()->with('success', 'Booking approved.');
    }

    public function reject(Booking $booking)
    {
        $user = Auth::user();
        $approval = $booking->approvals()->where('approver_id', $user->id)->first();

        if (!$approval) {
            return back()->with('error', 'Unauthorized access.');
        }

        $approval->update(['status' => 'rejected']);
        $booking->update(['status' => 'rejected']);
        
        Log::create(['user_id' => $user->id, 'action' => "Rejected booking ID: {$booking->id} (Level {$approval->level})"]);

        return back()->with('success', 'Booking rejected.');
    }
}
