<?php

namespace App\Jobs\Companies\Cabinets;

use App\Models\Companies\Cabinet;
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
        $cabinet = Cabinet::all();

        return $cabinet;
    }
}
