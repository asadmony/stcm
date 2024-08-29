<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'thana_id',
        'zone_id',
        'traffic_point_id',
        'date',
        'start_time',
        'end_time',
        'slots',
        'active',
    ];


    /**
     * Get the district that owns the ShiftSlot
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }


    /**
     * Get the thana that owns the ShiftSlot
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }


    /**
     * Get the zone that owns the ShiftSlot
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }


    /**
     * Get the trafficPoint that owns the ShiftSlot
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trafficPoint()
    {
        return $this->belongsTo(TrafficPoint::class);
    }


    /**
     * Get the shift that owns the ShiftSlot
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }


    /**
     * Get the Slot Bookings that owns the ShiftSlot
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slotBookings()
    {
        return $this->belongsTo(SlotBooking::class);
    }

}
