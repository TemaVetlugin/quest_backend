<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddController extends Controller
{
    public function __invoke(Request $request)
    {
        $user_id = $request->input('userId');
        $user  = User::where('id', $user_id)->first();
        if(!$user){
            return response('Пользователя с таким id не существует', Response::HTTP_OK);
        }
        $admin = auth()->user();
        $team = Team::where('creator_id', $admin->id)->first();
        if (!$team) {
            return response('Вы не являетесь капитаном команды', Response::HTTP_OK);
        }
        if ($user->team_id==$team->id) {
            return response('Пользователь уже состоит в команде', Response::HTTP_OK);
        }
        if ($user->team_id) {
            return response('Пользователь состоит в другой команде', Response::HTTP_OK);
        }
        $admin = auth()->user();
        $team = Team::where('creator_id', $admin->id)->first();
        if (!$team) {
            return response('Вы не являетесь капитаном команды', Response::HTTP_OK);
        }
        $count = User::where('team_id', $team->id)->count();
        if($count>5){
            return response('Команда укомплектована', Response::HTTP_OK);
        }
        $user->update(['team_id' => $team->id]);

        return response('Пользователь добавлен', Response::HTTP_OK);
    }
}
