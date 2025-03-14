<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'km_start',
        'km_end',
        'date_start',
        'date_end',
        'status'
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function drivers(): BelongsToMany
    {
        return $this->belongsToMany(Driver::class, 'driver_trip');
    }

    public function getDateStartFormattedAttribute(): string
    {
        return $this->date_start ? Carbon::parse($this->date_start)->format('d/m/Y H:i') : '';
    }

    public function getDateEndFormattedAttribute(): string
    {
        return $this->date_end ? Carbon::parse($this->date_end)->format('d/m/Y H:i') : '';
    }

    public function getStatusTextAttribute(): string
    {
        return match ($this->status) {
            'ongoing' => 'Em viagem',
            'completed' => 'Finalizada',
        };
    }
}
