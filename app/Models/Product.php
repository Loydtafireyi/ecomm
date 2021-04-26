<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'slug'];

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
            return $this->discount->discount;
        } else{
            return 0;
        }
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
