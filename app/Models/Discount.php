<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'discount'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // public function getDicountAmountAttribute()
    // {
    //     return number_format($this->discount, 2);
    // }
}
