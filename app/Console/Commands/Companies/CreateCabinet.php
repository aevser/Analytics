<?php

namespace App\Console\Commands\Companies;

use App\Models\Companies\Cabinet;
use Illuminate\Console\Command;

class CreateCabinet extends Command
{
    /**
     * Команда для добавления нового кабинета в БД
     *
     * Параметры:
     * {company_id} - идентификатор компании
     * {name} - название кабинета
     *
     * Вызов команды:
     * php artisan create-cabinet {company_id} "name"
     *
     * @var string
     */

    protected $signature = 'create-cabinet {company_id} {name}';

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
        $company_id = $this->argument('company_id');
        $name = $this->argument('name');

        $cabinet = Cabinet::query()->create([
            'company_id' => $company_id,
            'name' => $name
        ]);

        $this->info('Команда по созданию кабинета выполнена успешно');
    }
}
