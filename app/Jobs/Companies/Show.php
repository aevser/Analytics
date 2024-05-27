<?php

namespace App\Jobs\Companies;

use App\Models\Companies\Company;
use Illuminate\Foundation\Bus\Dispatchable;

class Show
{
    use Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $company_id
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $company = Company::query()->findOrFail($this->company_id);

        return $company;
    }
}
