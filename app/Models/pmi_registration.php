<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pmi_registration extends Model
{
    use HasFactory;

    protected $table = 'pmi_registration';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'application_id',
        'name',
        'father_name',
        'dob',
        'age',
        'community',
        'gender',
        'martialstatus',
        'blood_group',
        'mobile_number',
        'email',
        'qualification',
        'occupation',
        'social_media',
        'state',
        'constitution',
        'district',
        'taluk',
        'block',
        'part',
        'other_details',
        'address',
        'photo',
        'voter_id',
        'id_proof',
        'referral',
        'regi_flag',
        'memberid',
        'regi_status',
        'aadhaar_id',
        'aadhaar_proof'
    ];
}
