<?php

namespace App\Http\Controllers\Api\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company as Requests;
use App\Jobs\Companies as Jobs;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Jobs\Index::dispatchSync();

        return response()->json(['company' => $company], Response::HTTP_OK);
    }

    public function show($company)
    {
        $company = Jobs\Show::dispatchSync($company);

        return response()->json(['company' => $company], Response::HTTP_OK);
    }

    public function store(Requests\Store $request)
    {
        $company = Jobs\Create::dispatchSync(
            name: $request->name,
            address: $request->address,
            phone: $request->phone,
            email: $request->email,
            website_url: $request->website_url
        );

        return response()->json('Компания создана', Response::HTTP_CREATED);
    }

    public function update(Requests\Update $request, $company)
    {
        $company = Jobs\Update::dispatchSync(
            company_id: $company,
            name: $request->name,
            address: $request->address,
            phone: $request->phone,
            email: $request->email,
            website_url: $request->website_url
        );

        return response()->json('Данные компании обновлены', Response::HTTP_OK);
    }

    public function destroy($company)
    {
        $company = Jobs\Delete::dispatchSync($company);

        return response()->json('Компания удалена', Response::HTTP_OK);
    }
}
