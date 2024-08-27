<?php

namespace App\Models;

use App\Models\Thana;
use App\Models\TrafficPoint;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_bn',
        'logo',
        'thana_id',
    ];

    /**
     * Get the thana that owns the Zone
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }


    /**
     * Get all of the trafficPoints for the Zone
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trafficPoints()
    {
        return $this->hasMany(TrafficPoint::class);
    }
}
