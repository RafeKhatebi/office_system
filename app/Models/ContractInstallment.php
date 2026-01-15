<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractInstallment extends Model
{
    protected $fillable = [
        'contract_id',
        'installment_no',
        'amount',
        'due_date',
        'status'
    ];

    protected $casts = [
        'due_date' => 'date:Y-m-d',
    ];
}
