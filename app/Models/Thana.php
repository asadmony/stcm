<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_bn',
        'logo',
        'district_id',
    ];

    /**
     * Get the district that owns the Thana
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }


    /**
     * Get all of the zones for the Thana
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function zones()
    {
        return $this->hasMany(Zone::class);
    }
}
