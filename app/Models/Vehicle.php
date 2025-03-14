<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'year',
        'acquisition_date',
        'km_at_acquisition',
        'renavam',
        'license_plate',
        'status',
    ];

    public function getStatusTextAttribute(): string
    {
        return match ($this->status) {
            'available' => 'Disponível',
            'on_trip' => 'Em viagem',
            'inactive' => 'Inativo',
        };
    }

    public function getAcquisitionDate(): string
    {
        return Date::parse($this->acquisition_date)->format('d/m/Y');
    }

    public function kmAtAcquisitionFormatted(): Attribute
    {
        return Attribute::get(
            fn () => number_format($this->km_at_acquisition, 0, ',', '.')
        );
    }
}
