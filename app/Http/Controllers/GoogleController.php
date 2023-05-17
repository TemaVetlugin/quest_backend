<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\JWT;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
//        dd(11111);
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
//        dd(11111);
        $user = Socialite::driver('google')->user();
        $user_exists  = User::where('email', $user->email)->first();
        //return redirect('/')->with('message', 'Добро пожаловать на страницу домашнего кабинета!');
        if(!$user_exists) {
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['password'] = $hashedPassword = bcrypt('googleauthorizedusergoogleauthorizeduser');
            $data['photo'] = $user->avatar;
            $new_user = User::create($data);

        }
        $credentials['email'] = $user->email;
        $credentials['password'] = 'googleauthorizedusergoogleauthorizeduser';
        $token = auth()->attempt($credentials);
        return redirect('/')->with('token', $token);
//        return view('main.index', compact('token'));
    }

}
