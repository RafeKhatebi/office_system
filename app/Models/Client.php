<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'type',
        'company_name',
        'phone',
        'email',
        'address',
        'national_id',
        'status',
        'notes'
    ];

    protected $casts = [

    ];
}
