<?php

namespace App\Jobs\Companies;

use App\Models\Companies\Company;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $company_id,
        public string $name,
        public string $address,
        public string $phone,
        public string $email,
        public string $website_url
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

        $company->update([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'website_url' => $this->website_url
        ]);

        return $company;
    }
}
