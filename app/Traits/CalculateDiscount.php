<?php

namespace App\Traits;

use App\Models\Product;

trait CalculateDiscount 
{

    public function calculateDiscount(Product $product)
    {
        if($product->price >= 112 && $product->price <= 115) {
            $percentage = 0.25;
            $price = $product->price;

            $discount = ($percentage / 100) * $price;

            if($product->discount()->exists()){
                $product->discount()->update(['discount' => $discount]);

            } else {

                $product->discount()->create(['discount' => $discount]);
            }
        }

        if($product->price >= 120) {
            $percentage = 0.50;
            $price = $product->price;

            $discount = ($percentage / 100) * $price;

            $product->discount()->create(['discount' => $discount]);
        }
    }

}