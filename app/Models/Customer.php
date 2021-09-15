<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function customer(){
        $this->hasMany(Quote::class);
    }

    protected $fillable = [
        'firstname',
        'lastname',
        'streetname',
        'city',
        'postcode',
        'email',
        'phone'
    ];
}
