<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'name',
        'type',
        'source',
        'fuel_consumption',
        'status',
        'condition',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function fuelLogs()
    {
        return $this->hasMany(FuelLog::class);
    }

    public function serviceSchedules()
    {
        return $this->hasMany(ServiceSchedule::class);
    }
}
