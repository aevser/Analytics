<?php

namespace App\Jobs\Users;

use App\Models\User;
use Illuminate\Foundation\Bus\Dispatchable;

class Show
{
    use Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public $user_id
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $user = User::query()->findOrFail($this->user_id);

        return $user;
    }
}