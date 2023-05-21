<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data=$request->validated();
        $data['password']= Hash::make($data['password']);
        $user = User::where('email', $data['email'])->first();

        if($user) return response('Пользователь с таким email-ом уже существует', 401);

        $user['role']=0;

        $user = User::create($data);

        $token = auth()->tokenById($user->id);
        return response(['access_token'=>$token], Response::HTTP_OK);
    }

}
