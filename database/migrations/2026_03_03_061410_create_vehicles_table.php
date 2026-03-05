<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['angkutan orang', 'angkutan barang']);
            $table->enum('source', ['milik', 'sewa']);
            $table->decimal('fuel_consumption', 10, 2)->default(0);
            $table->enum('status', ['available', 'unavailable'])->default('available');
            $table->enum('condition', ['bagus', 'tidak bagus'])->default('bagus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
