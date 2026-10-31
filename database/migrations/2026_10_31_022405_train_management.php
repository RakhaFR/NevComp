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
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('name',100);
            $table->string('city',100);
            $table->timestamps();
        });

        Schema::create('trains', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('class');
            $table->unsignedInteger('capacity')->default(32);
            $table->timestamps();
        });

        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('train_id')->constrained()->cascadeOnDelete();
            $table->string('seat_number', 10);
            $table->timestamps();

            $table->unique(['train_id', 'seat_number']);
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('train_id')->constrained()->restrictOnDelete();
            $table->foreignId('origin_station_id')->constrained('stations')->restrictOnDelete();
            $table->foreignId('destination_station_id')->constrained('stations')->restrictOnDelete();
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->unsignedInteger('price');
            $table->timestamps();
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code', 30)->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('schedule_id')->constrained()->restrictOnDelete();
            $table->foreignId('seat_id')->constrained()->restrictOnDelete();
            $table->unsignedInteger('total_price');
            $table->string('status', 20)->default('pending');
            $table->timestamps();

            $table->unique(['schedule_id', 'seat_id']);
        });

        Schema::create('booking_passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->string('name',100);
            $table->string('identity_number', 20);
            $table->string('phone', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_passengers');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('seats');
        Schema::dropIfExists('trains');
        Schema::dropIfExists('stations');
    }
};
