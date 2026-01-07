<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialReport extends Model
{
    protected $fillable = [
        'report_type',
        'from',
        'to',
        'total_income',
        'total_expense',
        'total_withdrawal',
        'net_result'
    ];

    protected $casts = [
        'from'             => 'date:Y-m-d',
        'to'               => 'date:Y-m-d',
        'total_income'     => 'decimal:2',
        'total_expense'    => 'decimal:2',
        'total_withdrawal' => 'decimal:2',
        'net_result'       => 'decimal:2'
    ];  
}
