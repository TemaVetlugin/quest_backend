<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\StoreRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class UserDeleteController extends Controller
{
    public function __invoke(Request $request)
    {

        $user_id = $request->input('userId');
        $user  = User::where('id', $user_id)->first();
        if($user->team_id===null){
            $message='У пользователя нет команды';
        }
        else{
            $user->update(['team_id' => null]);

            $message='Пользователь покинул команду';
        }
        return response($message, Response::HTTP_OK);
    }

}
