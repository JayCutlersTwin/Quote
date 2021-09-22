<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteProducts extends Model
{
    use HasFactory;

    public function quote(){
        $this->belongsTo(Quote::class);
    }

    public function product() {
        $this->hasMany(Product::class);
    }

    protected $casts = [

    ];

    protected $fillable = [
        'product_id',
        'quote_id',
        'quantity',
    ];
}
