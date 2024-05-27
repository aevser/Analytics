<?php

namespace App\Jobs\Incomes;

use App\Models\Companies\Account;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GetIncome
{
    use Dispatchable;

    /**
     * Делаем запрос на получение данных о доходах и сохраняем в БД
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
        $response = Http::retry(5, 1000)->get("http://89.108.115.241:6969/api/incomes?dateFrom={$currentDate}&dateTo={$currentDate}&page=1&key=E6kUTYrYwZq2tN4QEtyzsbEBk3ie&limit=100");
        $data = $response->json();

        // Проверяем наличие данных
        if (empty($data['data'])) {
            Log::channel('income')->error('[GetIncome] Нет данных за сегодняшний день');

            return 'error';
        } else {
            // Перебираем данные и сохраняем в модель Income
            foreach ($data['data'] as $item) {
                Income::query()->create([
                    'account_id' => $this->account_id,
                    'income_id' => $item['income_id'],
                    'number' => $item['number'],
                    'date' => $item['date'],
                    'last_change_date' => $item['last_change_date'],
                    'supplier_article' => $item['supplier_article'],
                    'tech_size' => $item['tech_size'],
                    'barcode' => $item['barcode'],
                    'quantity' => $item['quantity'],
                    'total_price' => $item['total_price'],
                    'date_close' => $item['date_close'],
                    'warehouse_name' => $item['warehouse_name'],
                    'nm_id' => $item['nm_id'],
                    'status' => $item['status'],
                ]);
            }

            Log::channel('income')->info('[GetIncome] Успешно получены данные');

            return 'success';
        }
    }
}
