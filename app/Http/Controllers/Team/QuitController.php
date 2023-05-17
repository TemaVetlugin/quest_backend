<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\StoreRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class QuitController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        if($user->team_id===null){
            $message='У вас нет команды';

        }
        else{
            $team = Team::where('creator_id', $user->id)->first();

            $user->update(['team_id' => null]);
            $admin = User::where('team_id', $team->id)->first();
            if($admin){
                $team->update(['creator_id' => $admin->id]);
            }
            else{
                $team->delete();
            }
            $message='Вы покинули команду';
        }
        return response($message, Response::HTTP_OK);
    }

}
