<?php

namespace App\Jobs\Companies;

use App\Models\Companies\Company;
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
        $company = Company::all();

        return $company;
    }
}
