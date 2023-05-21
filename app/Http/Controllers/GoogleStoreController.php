<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PhotoStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class GoogleStoreController extends Controller
{
    public function __invoke(  Request $request)
    {

        $user = request()->input();
        $user_exists  = User::where('email', $user->email)->first();
        //return redirect('/')->with('message', 'Добро пожаловать на страницу домашнего кабинета!');
        if(!$user_exists) {
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['password'] = $hashedPassword = bcrypt('googleauthorizedusergoogleauthorizeduser');
            $data['photo'] = $user->avatar;
            $data['role'] = 0;
            $new_user = User::create($data);

        }
        $credentials['email'] = $user->email;
        $credentials['password'] = 'googleauthorizedusergoogleauthorizeduser';
        $token = auth()->attempt($credentials);
        return  $token;
    }

}
