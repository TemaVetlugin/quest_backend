<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\StoreRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class JoinController extends Controller
{
    public function __invoke(Request $request)
    {
        $key = $request->input('key');
        $team = Team::where('key', $key)->first();
        $user = auth()->user();

        if ($team) {
            if($user->team_id!==null){
                $message='Вы уже зарегистрированы в команде';
                return response($message, Response::HTTP_OK);
            }
            else{
                $count = User::where('team_id', $team->id)->count();
                if($count>9){
                    return response('Команда укомплектована', Response::HTTP_OK);
                }
                $user->update(['team_id' => $team->id]);
            }
        } else {
            return response('Такой команды не существует', Response::HTTP_OK);
        }
        return response('Вы присоединились к команде', Response::HTTP_OK);
    }

}
