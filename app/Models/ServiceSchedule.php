<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSchedule extends Model
{
    protected $fillable = [
        'vehicle_id',
        'service_date',
        'description',
        'cost',
        'status', // scheduled, completed
    ];

    protected function casts(): array
    {
        return [
            'service_date' => 'date',
        ];
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
