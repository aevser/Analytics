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
            return response()->json('Данные получены', Response::HTTP_CREATED);
        }

        return response()->json('Не удалось получить данные', Response::HTTP_NOT_FOUND);
    }
}
