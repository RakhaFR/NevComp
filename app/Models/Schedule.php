<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'train_id',
        'origin_station_id',
        'destination_station_id',
        'derpature_time',
        'arrival_time',
        'price'
    ];

    protected function casts(): array
    {
        return [
            'derpature_time' => 'datetime',
            'arrival_time' => 'datetime',
            'price' => 'integer'
        ];
    }

    public function train(): BelongsTo
    {
        return $this->belongsTo(Train::class);
    }

    public function originStation(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'origin_station_id');
    }

    public function destinationStation(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'destination_station_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function isDeparted(): bool
    {
        return $this->departure_time->isPast();
    }

    public function isLocked(): bool
    {
        return $this->bookings()->exists();
    }

    public function bookedSeatIds(): array
    {
        return $this->bookings()->pluck('seat_id')->all();
    }
}
