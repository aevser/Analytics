<?php

namespace App\Jobs\Stocks;

use App\Models\Companies\Account;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetStock
{
    use Dispatchable;

    /**
     * Делаем запрос на получение данных о складах и сохраняем в БД
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
        $response = Http::retry(5, 1000)->get("http://89.108.115.241:6969/api/stocks?dateFrom={$currentDate}&dateTo={$currentDate}&page=1&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=100");
        $data = $response->json();

        // Проверяем наличие данных
        if (empty($data['data'])) {
            Log::channel('stock')->error('[GetStock] Нет данных за сегодняшний день');

            return 'error';
        } else {
            // Перебираем данные из запроса и сохраняем в модель Stock
            foreach ($data['data'] as $item) {
                Stock::query()->create([
                    'account_id' => $this->account_id,
                    'date' => $item['date'],
                    'last_change_date' => $item['last_change_date'],
                    'supplier_article' => $item['supplier_article'],
                    'tech_size' => $item['tech_size'],
                    'barcode' => $item['barcode'],
                    'quantity' => $item['quantity'],
                    'is_supply' => $item['is_supply'],
                    'is_realization' => $item['is_realization'],
                    'quantity_full' => $item['quantity_full'],
                    'warehouse_name' => $item['warehouse_name'],
                    'in_way_to_client' => $item['in_way_to_client'],
                    'in_way_from_client' => $item['in_way_from_client'],
                    'nm_id' => $item['nm_id'],
                    'subject' => $item['subject'],
                    'category' => $item['category'],
                    'brand' => $item['brand'],
                    'sc_code' => $item['sc_code'],
                    'price' => $item['price'],
                    'discount' => $item['discount'],
                ]);
            }

            Log::channel('stock')->info('[GetStock] Успешно получены данные');

            return 'success';
        }
    }
}
