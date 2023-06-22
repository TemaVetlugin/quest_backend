<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Response;

class StartedController extends Controller
{
    public function __invoke()
    {
//        dd(111);
        $user = auth()->user();
        $team = Team::where('id', $user->team_id)->first();
        if($team) {
            $data['started_at'] = $team->started_at;
            $data['hints'] = $team->hints;
            return $data;
        }
        else{
            return response('Вы не состоите в команде', Response::HTTP_OK);
        }
    }

}
