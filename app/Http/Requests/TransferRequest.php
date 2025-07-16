<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'from_user_id' => [
                'required',
                'exists:users,id',
            ],
            'to_user_id' => [
                'required',
                'exists:users,id',
                'different:from_user_id',
            ],
            'amount' => [
                'required',
                'numeric',
                'min:' . config('app.money.operations.min_amount', 0),
            ],
        ];
    }
}
