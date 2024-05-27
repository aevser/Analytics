<?php

namespace App\Jobs\Companies\Cabinets\Accounts;

use App\Models\Companies\Account;
use Illuminate\Foundation\Bus\Dispatchable;

class Index
{
    use Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $account = Account::all();

        return $account;
    }
}
