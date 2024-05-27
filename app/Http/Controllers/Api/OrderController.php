<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\Orders as Jobs;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function getOrder($account_id)
    {
        $order = Jobs\GetOrder::dispatchSync($account_id);

        if ($order === 'success') {
            return response()->json('Данные получены', Response::HTTP_CREATED);
        }

        return response()->json('Не удалось получить данные', Response::HTTP_NOT_FOUND);
    }
}
