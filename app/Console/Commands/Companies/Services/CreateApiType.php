<?php

namespace App\Console\Commands\Companies\Services;

use App\Models\Companies\Services\ApiType;
use Illuminate\Console\Command;

class CreateApiType extends Command
{
    /**
     * Команда для добавления нового типа токена в БД
     *
     * Параметр:
     * {name} - имя типа
     *
     * Вызов команды:
     * php artisan create-token-type "name"
     *
     * @var string
     */

    protected $signature = 'create-token-type {name}';

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

        $token_type = ApiType::query()->create([
            'name' => $name
        ]);

        $this->info('Команда по созданию типа токена выполнена успешно');
    }
}
