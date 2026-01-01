<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    protected $fillable = [
        'first_name',
        'last_name', 
        'job_title',
        'hire_date',
        'phone',
        'emergency_phone',
        'gender',
        'date_of_birth',
        'national_id',
        'status'
    ];

    protected $casts = [
        'hire_date' => 'date: Y-m-d',
        'date_of_birth' => 'date: Y-m-d',

    ];
}
