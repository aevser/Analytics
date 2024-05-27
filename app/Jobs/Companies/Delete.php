<?php

namespace App\Jobs\Companies;

use App\Models\Companies\Company;
use Illuminate\Foundation\Bus\Dispatchable;

class Delete
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
        $company = Company::destroy($this->company_id);

        return $company;
    }
}
