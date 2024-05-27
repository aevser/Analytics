<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Доходы
Route::post('incomes/{account_id}', [Api\IncomeController::class, 'getIncome'])
    ->name('incomes');

// Заказы
Route::post('orders/{account_id}', [Api\OrderController::class, 'getOrder'])
    ->name('orders');

// Продажи
Route::post('sales/{account_id}', [Api\SaleController::class, 'getSale'])
    ->name('sales');

// Склады
Route::post('stocks/{account_id}', [Api\StockController::class, 'getStock'])
    ->name('stocks');
