<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    public function customer(){
        $this->belongsTo(Customer::class);
    }

    public function product() {
        $this->hasMany(Product::class);
    }

    protected $casts = [
        'productnames' => 'array'
    ];

    protected $fillable = [
        'customer_id',
        'quotename',
        'productnames'
    ];
}
