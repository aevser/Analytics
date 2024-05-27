<?php

namespace App\Jobs\Orders;

use App\Models\Companies\Account;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetOrder
{
    use Dispatchable;

    /**
     * Делаем запрос на получение данных о заказах и сохраняем в БД
     */
    public function __construct(
        public $account_id
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Загружаем модель
        $account = Account::query()->findOrFail($this->account_id);

        // Получаем текущую дату
        $currentDate = Carbon::now()->format('Y-m-d');

        // Отправляем запрос и повторяем, если есть ограничение на сервере
        $response = Http::retry(5, 1000)->get("http://89.108.115.241:6969/api/orders?dateFrom={$currentDate}&dateTo={$currentDate}&page=1&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=100");
        $data = $response->json();

        // Проверяем наличие данных
        if (empty($data['data'])) {
            Log::channel('order')->error('[GetOrder] Нет данных за сегодняшний день');

            return 'error';
        } else {
            // Перебираем данные и сохраняем в модель Order
            foreach ($data['data'] as $item) {
                Order::query()->create([
                    'account_id' => $this->account_id,
                    'g_number' => $item['g_number'],
                    'date' => $item['date'],
                    'last_change_date' => $item['last_change_date'],
                    'supplier_article' => $item['supplier_article'],
                    'tech_size' => $item['tech_size'],
                    'barcode' => $item['barcode'],
                    'total_price' => $item['total_price'],
                    'discount_percent' => $item['discount_percent'],
                    'warehouse_name' => $item['warehouse_name'],
                    'oblast' => $item['oblast'],
                    'income_id' => $item['income_id'],
                    'odid' => $item['odid'],
                    'nm_id' => $item['nm_id'],
                    'subject' => $item['subject'],
                    'category' => $item['category'],
                    'brand' => $item['brand'],
                    'is_cancel' => $item['is_cancel'],
                    'cancel_dt' => $item['cancel_dt'],
                ]);
            }

            Log::channel('order')->info('[GetOrder] Успешно получены данные');

            return 'success';
        }
    }
}
