<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'employee_id',
        'amount',
        'withdrawal_date',
        'payment_type',
        'reason'
    ];

    protected $casts = [
        'amount'  => 'decimal:2',
        'withdrawal_date' => 'date:Y-m-d'
    ];

    public function employee()
    {
        return $this->belongsTo(employee::class);
    }
}
