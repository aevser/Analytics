<?php

namespace App\Console\Commands\Companies\Services;

use App\Models\Companies\Services\ApiService;
use Illuminate\Console\Command;

class CreateApiService extends Command
{
    /**
     * Команда для добавления нового сервиса в БД
     *
     * Параметр:
     * {name} - название сервиса
     *
     * Вызов команды:
     * php artisan create-api-service "name"
     *
     * @var string
     */

    protected $signature = 'create-api-service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        $api_service = ApiService::query()->create([
            'name' => $name
        ]);

        $this->info('Команда по созданию сервиса выполнена успешно');
    }
}
