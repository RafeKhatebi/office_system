<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'employee_id',
        'payroll_month',
        'basic_salary',
        'allowances',
        'overtime_amount',
        'deductions',
        'gross_salary',
        'net_salary',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'basic_salary'    => 'decimal:2',
        'allowances'      => 'decimal:2',
        'overtime_amount' => 'decimal:2',
        'deductions'      => 'decimal:2',
        'gross_salary'    => 'decimal:2',
        'net_salary'      => 'decimal:2',
        'paid_at'         => 'date:Y-m-d',
    ];

    public function employee()
    {
        return $this->belongsTo(employee::class);
    }
}
