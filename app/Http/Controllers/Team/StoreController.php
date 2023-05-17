<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\StoreRequest;
use App\Models\Team;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $user = auth()->user();
        if($user->team_id!==null){
            $message='Вы уже зарегистрированы в команде';
            return response($message, Response::HTTP_OK);
        }
        $key = Str::random(6);
        $data=$request->validated();
        $data['creator_id']=$user->id;
        $data['key']=$key;
        $data['scores']=0;
        $team=Team::create($data);
        $user->update(['team_id' => $team->id]);
        return $key;
    }

}
