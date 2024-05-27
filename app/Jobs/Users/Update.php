<?php

namespace App\Jobs\Users;

use App\Models\User;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $user_id,
        public string $name,
        public string $email,
        public string $password
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

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);

        return $user;
    }
}
