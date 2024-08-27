<?php

namespace App\Models;

use App\Models\Shift;
use App\Models\ShiftSlot;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrafficPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_bn',
        'logo',
        'zone_id',
    ];

    /**
     * Get the zone that owns the Traffic Point
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }


    /**
     * Get all of the shifts for the Traffic Point
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    /**
     * Get all of the shiftSlots for the Traffic Point
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shiftSlots()
    {
        return $this->hasMany(ShiftSlot::class);
    }
}
