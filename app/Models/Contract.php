<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'project_id',
        'contract_number',
        'amount',
        'currency',
        'payment_type',
        'signed_date',
        'status',
        'contract_file',
        'notes',
    ];

    protected $casts = [
        'amount'    => 'decimal:2',
        'signed_date' => 'date:Y-m-d'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
