<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'number',
            'level',
            'debt',


    ];


   public function residents(){
       return $this->hasMany(Resident::class);
   }
    public function payments() {
        return $this->hasMany(Payment::class);
    }

}
