<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    public function __invoke(DepositRequest $request, User $user): JsonResponse
    {
        $amount = $request->validated()['amount'];
        $wallet = $user->wallet;

        DB::transaction(function () use ($wallet, $user, $amount) {
            $wallet->balance += $amount;
            $wallet->save();

            $wallet->transactions()->create([
                'type' => 'deposit', // extract in php enums
                'amount' => $amount,
            ]);
        });

        return response()->json([
            'data' => [
                'message' => 'Deposit successful',
                'balance' => $wallet->balance
            ],
        ]);
    }
}
