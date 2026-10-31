<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Station extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'city'
    ];
    public function originSchedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'origin_station_id');
    }

    public function destinationSchedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'destination_station_id');
    }

    public function isUsed(): bool
    {
        return $this->originSchedules()->exists() || $this->destinationSchedules()->exists();
    }
}
