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

    public function quoteProducts() {
        $this->hasMany(QuoteProducts::class);
    }

    protected $fillable = [
        'quotename',
        'customer_id',
        'order_complete',
    ];
}
