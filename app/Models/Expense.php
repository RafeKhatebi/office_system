<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'type',
        'expense_date',
        'payment_type',
        'frequency',
        'start_date',
        'end_date',
        'note'
    ];

    protected $casts = [
        'amount'       => 'decimal:2',
        'expense_date' => 'date:Y-m-d',
        'start_date'   => 'date:Y-m-d',
        'end_date'     => 'date:Y-m-d',
    ];
}
