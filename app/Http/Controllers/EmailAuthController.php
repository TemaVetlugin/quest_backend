<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PhotoStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class EmailAuthController extends Controller
{
    public function __invoke(  Request $request)
    {

        $user = request()->input();
//        dd($user);
        $user_exists  = User::where('id', $user['id'])->first();
        if ($user_exists && $user_exists->access===0) {
            $credentials['email'] = $user_exists['email'];
            $credentials['password'] = $user_exists['[password]'];
            $token = auth()->attempt($credentials);
            return  $token;

        }
        //return redirect('/')->with('message', 'Добро пожаловать на страницу домашнего кабинета!');
        if(!$user_exists) {
            return response( 'Пользователь с таким email не зарегистрирован', 401);

        }

    }

}
