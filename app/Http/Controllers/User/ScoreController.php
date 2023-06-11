<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class ScoreController extends Controller
{
    public function __invoke()
    {
        $user_auth = auth()->user();
        $data['scores']=$user_auth->scores;
        $data['name']=$user_auth->name;
        $data['photo']=$user_auth->photo;
        $user_id=$user_auth->id;
        $users = User::orderBy('scores', 'DESC')->get();

        $index = $users->search(function ($user) use ($user_id) {
        return $user->id == $user_id;
        });
        $data['place'] = $index + 1; // добавляем 1, потому что индексы начинаются с 0

        return $data;
    }

}
