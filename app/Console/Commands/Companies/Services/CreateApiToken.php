<?php

namespace App\Console\Commands\Companies\Services;

use App\Models\Companies\Services\ApiToken;
use Illuminate\Console\Command;

class CreateApiToken extends Command
{
    /**
     * Команда для добавления нового токена в БД
     *
     * Параметры:
     * {account_id} - идентификатор аккаунта
     * {api_service_id} - идентификатор сервиса
     * {token_type_id} - идентификатор типа токена
     * {api_token} - сам токен
     *
     * Вызов команды:
     * php artisan create-token {account_id} {api_service_id} {api_type_id} {api_token}
     *
     * @var string
     */

    protected $signature = 'create-token {account_id} {api_service_id} {api_type_id} {api_token}';

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
        $account_id = $this->argument('account_id');
        $service_id = $this->argument('api_service_id');
        $type_id = $this->argument('api_type_id');
        $token = $this->argument('api_token');

        $token = ApiToken::query()->create([
            'account_id' => $account_id,
            'api_service_id' => $service_id,
            'api_type_id' => $type_id,
            'api_token' => $token
        ]);

        $this->info('Команда по созданию токена выполнена успешно');
    }
}
