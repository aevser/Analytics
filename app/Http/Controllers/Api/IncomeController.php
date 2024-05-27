<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\Incomes as Jobs;
use Illuminate\Http\Response;

class IncomeController extends Controller
{
    public function getIncome($account_id)
    {
        $income = Jobs\GetIncome::dispatchSync($account_id);

        if ($income === 'success') {
            return response()->json(['success' => 'Данные получены успешно'], Response::HTTP_CREATED);
        }

        return response()->json(['error' => 'Данные не были получены'], Response::HTTP_NOT_FOUND);
    }
}
