<?php

namespace App\Jobs\Companies\Cabinets;

use App\Models\Companies\Cabinet;
use Illuminate\Foundation\Bus\Dispatchable;

class Show
{
    use Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $cabinet_id
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $cabinet = Cabinet::query()->findOrFail($this->cabinet_id);

        return $cabinet;
    }
}
