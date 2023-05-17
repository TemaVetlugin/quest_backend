<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Response;

class ShowController extends Controller
{
    public function __invoke(Quest $quest)
    {
        $user_id=auth()->user();
        $user = User::with(['quests'=>function($query){
            $query->withPivot(['mode'])->orderBy('id');
        }])->find($user_id);
        $user[0]['team'] = Team::where('id', $user[0]->team_id)->first();
        return $user;
    }
}
