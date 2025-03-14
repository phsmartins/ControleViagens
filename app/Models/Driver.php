<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Date;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_date',
        'cnh',
        'status',
    ];

    public function trips(): BelongsToMany
    {
        return $this->belongsToMany(Trip::class, 'driver_trip');
    }

    public function getBirthDate(): string
    {
        return Date::parse($this->birth_date)->format('d/m/Y');
    }

    public function getAge(): int
    {
        return Carbon::parse($this->birth_date)->age;
    }

    public function getStatusTextAttribute(): string
    {
        return match ($this->status) {
            'available' => 'Disponível',
            'on_trip' => 'Em viagem',
            'inactive' => 'Inativo',
        };
    }
}
