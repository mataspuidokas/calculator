<?php

namespace App\Actions;

use App\Http\Resources\CalculatorResource;
use App\Models\Calculator;

class GetHistoryByUserId
{
    public function handle(int $userId, $perPage = 10)
    {
        $history = Calculator::where('user_id', $userId)->latest()->paginate($perPage);

        return CalculatorResource::collection($history);
    }
}
