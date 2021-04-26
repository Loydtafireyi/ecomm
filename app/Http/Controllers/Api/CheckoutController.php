<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $slug)
    {
        $product =  Product::where('slug', $slug)->firstOrFail();
        
        if (auth()->user()->wallet()->exists() && auth()->user()->wallet->balance > $product->price - $product->discountExists() ) {
            
            $walletCredit = auth()->user()->wallet->balance;
            $billingTotal = $product->price - $product->discountExists();

            $order = $product->orders()->create([
                'order_number' => uniqid(),
                'user_id' => auth()->user()->id,
                'billing_total' => $billingTotal,
            ]);

            auth()->user()->wallet()->update(['balance' => $walletCredit - $billingTotal]);
            
            return $order;
        }

        return response()->json('You have insuffient funds please top up your wallet');
    }
}
