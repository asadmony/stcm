<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'thana_id',
        'zone_id',
        'traffic_point_id',
        'shift_id',
        'user_id',
        'date',
        'start_time',
        'end_time',
    ];
    /**
     * Get all of the shifts for the SlotBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }
}
