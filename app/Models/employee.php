<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    protected $fillable = [
        'first_name',
        'last_name', 
        'job_title',
        'salary',
        'employee_code',
        'hire_date',
        'address',
        'phone',
        'emergency_phone',
        'gender',
        'date_of_birth',
        'national_id',
        'employment_type',
        'status'
    ];

    protected $casts = [
        'hire_date' => 'date: Y-m-d',
        'date_of_birth' => 'date: Y-m-d',
        'salary'        => 'decimal:2',

    ];


    protected static function booted()
    {
        static::creating(function ($employee) {
            $employee->employee_code = 'EMP-' . now()->format('Y') . '-' . str_pad(
                (self::max('id') + 1),
                3,
                '0',
                STR_PAD_LEFT
            );
        });
    }
}
