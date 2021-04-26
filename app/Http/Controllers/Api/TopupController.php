<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TopupResource;
use App\Models\Topup;
use App\Models\Wallet;
use Illuminate\Http\Request;

class TopupController extends Controller
{
    public function index()
    {
        $topups = Topup::where('user_id', auth()->user()->id)->select('created_at', 'amount', 'id')->orderBy('created_at', 'DESC')->get();

        return TopupResource::collection($topups);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
        ]);


        $topup = Topup::create([
            'amount' => $validated['amount'],
            'user_id' => auth()->user()->id
        ]);

        if (auth()->user()->wallet()->exists()) {
            $currentBalance = auth()->user()->wallet->balance;
            $newBalance = $topup->amount + $currentBalance;
            auth()->user()->wallet->update(['balance' => $newBalance]);
        } else {
            $wallet = new Wallet(['balance' => $topup->amount]);
            auth()->user()->wallet()->save($wallet);
            
        }

        return $topup;
    }
}
