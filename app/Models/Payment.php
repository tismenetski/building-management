<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payer_name',
        'paid_at',
        'payment_method',
        'amount',
        'payment_notes',
        'paid_for'
    ];

    public function apartment() {
        return $this->belongsTo(Apartment::class);
}

}
