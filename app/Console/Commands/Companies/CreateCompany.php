<?php

namespace App\Console\Commands\Companies;

use App\Models\Companies\Company;
use Illuminate\Console\Command;

class CreateCompany extends Command
{
    /**
     * Команда для добавления новой компании в БД
     *
     * Параметр:
     * {name} - название компаниии
     *
     * Вызов команды:
     * php artisan create-company "name"
     *
     * @var string
     */

    protected $signature = 'create-company {name}';

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

        $company = Company::query()->create([
            'name' => $name
        ]);

        $this->info('Команда по созданию компании выполнена успешно');
    }
}
