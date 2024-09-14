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
     * Get the shifts that owns the SlotBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
    /**
     * Get the district that owns the SlotBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get the thana that owns the SlotBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }

    /**
     * Get the zone that owns the SlotBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }


    /**
     * Get the Traffic Point that owns the SlotBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trafficPoint()
    {
        return $this->belongsTo(TrafficPoint::class);
    }
}
