<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use HasFactory;

    protected $table = 'members_tbl';

    protected $fillable = [
        'memberid',
        'password',
        'referral_code',
        'posting',
        'flag',
        'application_id',
        'roles',
    ];

    protected $primaryKey = 'memberid';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
