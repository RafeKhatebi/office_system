<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'client_id',
        'title',
        'description',
        'project_type',
        'status',
        'priority',
        'start_date',
        'expected_end_date',
        'actual_end_date',
    ];

    protected $casts = [
        'start_date'        => 'date:Y-m-d',
        'expected_end_date' => 'date:Y-m-d',
        'actual_end_date'   => 'date:Y-m-d',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
