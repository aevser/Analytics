<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User as Requests;
use App\Jobs\Users as Jobs;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        $user = Jobs\Index::dispatchSync();

        return response()->json(['user' => $user], 200);
    }

    public function show($user)
    {
        $user = Jobs\Show::dispatchSync($user);

        return response()->json(['user' => $user], 200);
    }

    public function store(Requests\Store $request)
    {
        $users = Jobs\Create::dispatchSync(
            name: $request->name,
            email: $request->email,
            password: $request->password,
        );

        return response()->json(['success' => 'Пользователь успешно добавлен'], Response::HTTP_CREATED);
    }

    public function update(Requests\Update $request, $user)
    {
        $user = Jobs\Update::dispatchSync(
            user_id: $user,
            name: $request->name,
            email: $request->email,
            password: $request->password
        );

        return response()->json(['success' => 'Данные пользователя успешно обновлены'], Response::HTTP_CREATED);
    }

    public function destroy($user)
    {
        $user = Jobs\Delete::dispatchSync($user);

        return response()->json(['success' => 'Пользователь успешно удален'], Response::HTTP_CREATED);
    }
}
