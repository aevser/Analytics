<?php

namespace App\Http\Controllers\Api\Companies\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\Cabinet as Requests;
use App\Jobs\Companies\Cabinets as Jobs;
use Illuminate\Http\Response;

class CabinetController extends Controller
{
    public function index()
    {
        $cabinet = Jobs\Index::dispatchSync();

        return response()->json(['cabinet' => $cabinet], Response::HTTP_OK);
    }

    public function show($cabinet)
    {
        $cabinet = Jobs\Show::dispatchSync($cabinet);

        return response()->json(['cabinet' => $cabinet], Response::HTTP_OK);
    }

    public function store(Requests\Store $request)
    {
        $cabinet = Jobs\Create::dispatchSync(
            company_id: $request->company_id,
            name: $request->name,
            active: $request->active
        );

        return response()->json(['success' => 'Кабинет успешно добавлен'], Response::HTTP_CREATED);
    }

    public function update(Requests\Update $request, $cabinet)
    {
        $cabinet = Jobs\Update::dispatchSync(
            cabinet_id: $cabinet,
            company_id: $request->company_id,
            name: $request->name,
            active: $request->active
        );

        return response()->json(['success' => 'Данные кабинета успешно обновлены'], Response::HTTP_OK);
    }

    public function destroy($cabinet)
    {
        $cabinet = Jobs\Delete::dispatchSync($cabinet);

        return response()->json(['success' => 'Кабинет успешно удален'], Response::HTTP_OK);
    }
}
