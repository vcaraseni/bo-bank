<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferRequest;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    /**
     * @param TransferRequest $request
     * @return JsonResponse
     */
    public function __invoke(TransferRequest $request): JsonResponse
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            $fromWallet = Wallet::query()
                ->where('user_id', $validated['from_user_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $toWallet = Wallet::query()
                ->where('user_id', $validated['to_user_id'])
                ->lockForUpdate()
                ->firstOrFail();

            $amount = $validated['amount'];

            if ($fromWallet->balance < $amount) {
                throw new Exception('Insufficient funds');
            }

            if ($fromWallet->id === $toWallet->id) {
                throw new Exception('Cannot transfer to the same wallet.');
            }

            $fromWallet->balance -= $amount;
            $toWallet->balance += $amount;

            $fromWallet->save();
            $toWallet->save();

            $fromWallet->transactions()->create([
                'type' => 'transfer_out',
                'amount' => $amount,
                'related_wallet_id' => $toWallet->id,
            ]);

            $toWallet->transactions()->create([
                'type' => 'transfer_in',
                'amount' => $amount,
                'related_wallet_id' => $fromWallet->id,
            ]);
        });

        return response()->json([
            'data' => [
                'message' => 'Transfer completed',
            ]
        ]);
    }
}
