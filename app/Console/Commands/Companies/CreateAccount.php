<?php

namespace App\Console\Commands\Companies;

use App\Models\Companies\Account;
use Illuminate\Console\Command;

class CreateAccount extends Command
{
    /**
     * Команда для добавление ногово аккаунта в БД
     *
     * Параметры:
     * {cabinet_id} - идентификатор кабинета
     * {name} - название аккаунта
     *
     * Вызов команды:
     * php artisan create-account {cabinet_id} {name}
     *
     * @var string
     */

    protected $signature = 'create-account {cabinet_id} {name}';

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
        $cabinet_id = $this->argument('cabinet_id');
        $name = $this->argument('name');

        $account = Account::query()->create([
            'cabinet_id' => $cabinet_id,
            'name' => $name
        ]);

        $this->info('Команда по аккаунта выполнена успешно');
    }
}
