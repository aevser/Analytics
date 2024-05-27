<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\Stocks as Jobs;
use Illuminate\Http\Response;

class StockController extends Controller
{
    public function getStock($account_id)
    {
        $stock = Jobs\GetStock::dispatchSync($account_id);

        if ($stock === 'success') {
            return response()->json(['success' => 'Данные получены успешно'], Response::HTTP_CREATED);
        }

        return response()->json(['error' => 'Данные не были получены'], Response::HTTP_NOT_FOUND);
    }
}