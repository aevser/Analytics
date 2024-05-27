<?php

namespace App\Jobs\Users;

use App\Models\User;
use Illuminate\Foundation\Bus\Dispatchable;

class Delete
{
    use Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $user_id
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $user = User::query()->delete($this->user_id);

        return $user;
    }
}
