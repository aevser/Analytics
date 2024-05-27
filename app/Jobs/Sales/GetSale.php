<?php

namespace App\Jobs\Sales;

use App\Models\Companies\Account;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetSale
{
    use Dispatchable;

    /**
     * Делаем запрос на получение данных о продажах и сохраняем в БД
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
        $response = Http::retry(5, 1000)->get("http://89.108.115.241:6969/api/sales?dateFrom={$currentDate}&dateTo={$currentDate}&page=1&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=100");
        $data = $response->json();

        // Проверяем наличие данных
        if (empty($data['data'])) {
            Log::channel('sale')->error('[GetSale] Нет данных за сегодняшний день');

            return 'error';
        } else {
            // Перебираем данные и сохраняем в модель Sale
            foreach ($data['data'] as $item) {
                Sale::query()->create([
                    'account_id' => $this->account_id,
                    'g_number' => $item['g_number'],
                    'date' => $item['date'],
                    'last_change_date' => $item['last_change_date'],
                    'supplier_article' => $item['supplier_article'],
                    'tech_size' => $item['tech_size'],
                    'barcode' => $item['barcode'],
                    'total_price' => $item['total_price'],
                    'discount_percent' => $item['discount_percent'],
                    'is_supply' => $item['is_supply'],
                    'is_realization' => $item['is_realization'],
                    'promo_code_discount' => $item['promo_code_discount'],
                    'warehouse_name' => $item['warehouse_name'],
                    'country_name' => $item['country_name'],
                    'oblast_okrug_name' => $item['oblast_okrug_name'],
                    'region_name' => $item['region_name'],
                    'income_id' => $item['income_id'],
                    'sale_id' => $item['sale_id'],
                    'odid' => $item['odid'],
                    'spp' => $item['spp'],
                    'for_pay' => $item['for_pay'],
                    'finished_price' => $item['finished_price'],
                    'price_with_disc' => $item['price_with_disc'],
                    'nm_id' => $item['nm_id'],
                    'subject' => $item['subject'],
                    'category' => $item['category'],
                    'brand' => $item['brand'],
                    'is_storno' => $item['is_storno'],
                ]);
            }

            Log::channel('order')->info('[GetOrder] Успешно получены данные');

            return 'success';
        }
    }
}
