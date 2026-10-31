<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'train_id',
        'seat_id'
    ];
    public function train(): BelongsTo
    {
        return $this->belongsTo(Train::class);
    }

    public function bookings(): HasMany
    {
        return $this->HasMany(Booking::class);
    }
}
