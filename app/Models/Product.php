<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'slug', 'image'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    public function discountExists()
    {
        if($this->discount()->exists()) {
            return number_format($this->discount->discount, 2);
        } else{
            return '0.00';
        }
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getProductPriceAttribute()
    {
        return number_format($this->price, 2);
    }
}
