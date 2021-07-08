<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'expense_name',
        'expense_for',
        'paid_at',
        'amount',
        'payment_method',
        'expense_notes',

    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d'
    ];

}
