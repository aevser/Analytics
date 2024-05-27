<?php

namespace App\Jobs\Companies\Cabinets;

use App\Models\Companies\Cabinet;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $company_id,
        public string $name,
        public bool $active
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $cabinet = Cabinet::query()->create([
            'company_id' => $this->company_id,
            'name' => $this->name,
            'active' => $this->active
        ]);

        return $cabinet;
    }
}
