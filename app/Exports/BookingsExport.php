<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Booking::with(['vehicle', 'driver', 'admin'])->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Vehicle', 'Driver', 'Creator', 'Status', 'Created At'
        ];
    }

    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->vehicle->name ?? 'N/A',
            $booking->driver->name ?? 'N/A',
            $booking->admin->name ?? 'N/A',
            $booking->status,
            $booking->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
