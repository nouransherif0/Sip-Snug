<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'badge',
        'address',
        'working_hours',
        'days_label',
        'opening_time',
        'closing_time',
        'phone',
        'google_maps_url',
        'status',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'formatted_working_hours',
    ];

    protected static function booted(): void
    {
        static::saving(function ($loc) {
            if ($loc->opening_time && $loc->closing_time) {
                $days = $loc->days_label ?: 'Daily';
                $open = date('h:i A', strtotime($loc->opening_time));
                $close = date('h:i A', strtotime($loc->closing_time));
                $loc->working_hours = "{$days}: {$open} - {$close}";
            }
        });
    }

    public function getFormattedWorkingHoursAttribute(): string
    {
        if ($this->opening_time && $this->closing_time) {
            $days = $this->days_label ?: 'Daily';
            $open = date('h:i A', strtotime($this->opening_time));
            $close = date('h:i A', strtotime($this->closing_time));
            return "{$days}: {$open} - {$close}";
        }

        return $this->working_hours ?: 'Daily: 08:00 AM - 11:00 PM';
    }
}
