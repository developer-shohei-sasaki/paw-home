<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'last_name',
        'first_name',
        'birthday',
        'email',
        'password',
        'zip_code',
        'address'
    ];
}
