<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'nid',
        'nid_photo',
        'birth_certificate',
        'birth_certificate_photo',
        'father_name',
        'mother_name',
        'gender',
        'mobile_no',
        'address',
        'education_institute',
        'education_level',
        'education_id',
        'date_of_birth',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
