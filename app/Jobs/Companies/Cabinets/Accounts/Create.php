<?php

namespace App\Jobs\Companies\Cabinets\Accounts;

use App\Models\Companies\Account;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $cabinet_id,
        public int $user_id,
        public string $name,
        public string $phone,
        public string $email,
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $account = Account::query()->create([
           'cabinet_id' => $this->cabinet_id,
           'user_id' => $this->user_id,
           'name' => $this->name,
           'phone' => $this->phone,
           'email' => $this->email,
        ]);

        return $account;
    }
}