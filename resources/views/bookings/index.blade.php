@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
  {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
  {{ session('error') }}
</div>
@endif

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold dark:text-white">Bookings</h2>
    <div class="flex space-x-2">
        <a href="{{ route('export.bookings') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Export Excel</a>
        
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('bookings.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">New Booking</a>
        @endif
    </div>
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Vehicle</th>
                <th scope="col" class="px-6 py-3">Driver</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Approvals</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    #{{ $booking->id }}
                </td>
                <td class="px-6 py-4">
                    {{ $booking->vehicle->name ?? 'N/A' }} 
                    <br><span class="text-xs text-gray-400">{{ $booking->vehicle->type ?? '' }}</span>
                </td>
                <td class="px-6 py-4">
                    {{ $booking->driver->name ?? 'N/A' }}
                </td>
                <td class="px-6 py-4">
                    @if($booking->status == 'pending')
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Pending</span>
                    @elseif($booking->status == 'approved')
                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Approved</span>
                    @else
                        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Rejected</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <ul class="max-w-md space-y-1 text-xs text-gray-500 list-inside dark:text-gray-400">
                        @foreach($booking->approvals as $approval)
                        <li class="flex items-center">
                            @if($approval->status == 'approved')
                                <svg class="w-3.5 h-3.5 me-2 text-green-500 dark:text-green-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                            @elseif($approval->status == 'rejected')
                                <svg class="w-3.5 h-3.5 me-2 text-red-500 dark:text-red-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                                </svg>
                            @else
                                <svg class="w-3.5 h-3.5 me-2 text-gray-400 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                </svg>
                            @endif
                            L{{ $approval->level }}: {{ $approval->approver->name }} ({{ $approval->status }})
                        </li>
                        @endforeach
                    </ul>
                </td>
                <td class="px-6 py-4 flex space-x-2">
                    @php
                        $myApproval = $booking->approvals->where('approver_id', Auth::id())->first();
                        $canApprove = false;
                        if($myApproval && $myApproval->status === 'pending') {
                            if($myApproval->level == 1) {
                                $canApprove = true;
                            } else {
                                $level1 = $booking->approvals->where('level', 1)->first();
                                if($level1 && $level1->status === 'approved') {
                                    $canApprove = true;
                                }
                            }
                        }
                    @endphp
                    
                    @if($canApprove && $booking->status === 'pending')
                    <form action="{{ route('bookings.approve', $booking) }}" method="POST">
                        @csrf
                        <button type="submit" class="font-medium text-green-600 dark:text-green-500 hover:underline">Approve</button>
                    </form>
                    <form action="{{ route('bookings.reject', $booking) }}" method="POST">
                        @csrf
                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Reject</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td colspan="6" class="px-6 py-4 text-center">No bookings found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
