<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\Sales as Jobs;
use Illuminate\Http\Response;

class SaleController extends Controller
{
    public function getSale($account_id)
    {
        $sale = Jobs\GetSale::dispatchSync($account_id);

        if ($sale === 'success') {
            return response()->json('Данные получены', Response::HTTP_CREATED);
        }

        return response()->json('Не удалось получить данные', Response::HTTP_NOT_FOUND);
    }
}
