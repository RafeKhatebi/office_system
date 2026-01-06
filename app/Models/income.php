<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class income extends Model
{
    protected $fillable = [
        'income_resource_id',
        'title',
        'amount',
        'income_method',
        'income_date',
        'customer_name',
        'notes'
    ];

    protected $casts = [
        'amount'  => 'decimal:2',
        'income_date' => 'date:Y-m-d'
    ];

    public function source()
    {
<<<<<<< Updated upstream
        return $this->belongsTo(IncomeResource::class, 'income_resource_id');
=======
        return $this->belongsTo()
>>>>>>> Stashed changes
    }
}
