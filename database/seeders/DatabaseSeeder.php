<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Approver Level 1',
            'username' => 'approver1',
            'password' => Hash::make('approver123'),
            'role' => 'approver_level_1'
        ]);

        User::create([
            'name' => 'Approver Level 2',
            'username' => 'approver2',
            'password' => Hash::make('approver123'),
            'role' => 'approver_level_2'
        ]);

        // Vehicles
        Vehicle::create([
            'name' => 'Toyota HiAce',
            'type' => 'angkutan orang',
            'source' => 'milik',
            'fuel_consumption' => 12.5,
            'status' => 'available',
            'condition' => 'bagus'
        ]);

        Vehicle::create([
            'name' => 'Mitsubishi Triton',
            'type' => 'angkutan barang',
            'source' => 'sewa',
            'fuel_consumption' => 10.0,
            'status' => 'available',
            'condition' => 'bagus'
        ]);

        // Drivers
        Driver::create([
            'name' => 'Budi Santoso',
            'status' => 'available'
        ]);

        Driver::create([
            'name' => 'Andi Wijaya',
            'status' => 'available'
        ]);
    }
}
