<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->year('year');
            $table->date('acquisition_date');
            $table->integer('km_at_acquisition');
            $table->string('renavam')->unique();
            $table->string('license_plate')->unique();
            $table->enum('status', ['available', 'on_trip', 'inactive'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
