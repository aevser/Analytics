<?php

namespace App\Jobs\Companies\Cabinets\Accounts;

use App\Models\Companies\Account;
use Illuminate\Foundation\Bus\Dispatchable;

class Delete
{
    use Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $account_id
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $account = Account::destroy($this->account_id);

        return $account;
    }
}
