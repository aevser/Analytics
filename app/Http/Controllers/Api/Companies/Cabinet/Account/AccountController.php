<?php

namespace App\Http\Controllers\Api\Companies\Cabinet\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Cabinet\Account as Requests;
use App\Jobs\Companies\Cabinets\Accounts as Jobs;
use Carbon\Carbon;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    public function index()
    {
        $account = Jobs\Index::dispatchSync();

        return response()->json(['account' => $account], Response::HTTP_OK);
    }

    public function show($account)
    {
        $account = Jobs\Show::dispatchSync($account);

        return response()->json(['account' => $account], Response::HTTP_OK);
    }

    public function store(Requests\Store $request)
    {
        $account = Jobs\Create::dispatchSync(
            cabinet_id: $request->cabinet_id,
            user_id: $request->user_id,
            name: $request->name,
            phone: $request->phone,
            email: $request->email,
        );

        return response()->json(['success' => 'Аккаунт успешно создан'], Response::HTTP_CREATED);
    }

    public function update(Requests\Update $request, $account)
    {
        $account = Jobs\Update::dispatchSync(
            account_id: $account,
            cabinet_id: $request->cabinet_id,
            user_id: $request->user_id,
            name: $request->name,
            phone: $request->phone,
            email: $request->email,
        );

        return response()->json(['success' => 'Данные аккаунта успешно обновлены'], Response::HTTP_OK);
    }

    public function destroy($account)
    {
        $account = Jobs\Delete::dispatchSync($account);

        return response()->json(['success' => 'Аккаунт успешно удален'], Response::HTTP_OK);
    }
}
