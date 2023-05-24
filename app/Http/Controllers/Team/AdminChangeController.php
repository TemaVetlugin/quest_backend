<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminChangeController extends Controller
{
    public function __invoke(User $user)
    {
        $admin = auth()->user();
        $team = Team::where('creator_id', $admin->id)->first();
        if(!$team) {
            return response('Вы не являетесь капитаном команды', Response::HTTP_OK);
        }
        if($user->team_id!==$team->id){

            return response($team, Response::HTTP_OK);
        }
        $team->update(['creator_id' => $user->id]);
        return response('Капитан команды изменен', Response::HTTP_OK);
    }
}
