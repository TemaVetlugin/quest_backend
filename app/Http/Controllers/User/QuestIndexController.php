<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use App\Models\User;
use Illuminate\Http\Response;

class QuestIndexController extends Controller
{
    public function __invoke()
    {
        $user=auth()->user();
        $user = User::with(['quests'=>function($query){
            $query->withPivot(['mode', 'time'])->orderBy('id');
        }])->find($user->id);
        return $user;
    }
}
