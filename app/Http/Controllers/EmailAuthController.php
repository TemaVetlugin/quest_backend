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
        $secret_id=$user['id']+199;
        $secret_id/=6;
        $secret_id-=410;
        $id = sqrt($secret_id);
        $id = intval($id);
//        dd($id);
//        dd($user);
        $user_exists  = User::where('id', $id)->first();
        $old_password=$user_exists['password'];
//        dd($old_password);

//        dd($user_exists);
        if ($user_exists && $user_exists->access!==0) {
            $user_exists->update(['password'=>bcrypt('youshouldchangethepassword')]);
            $credentials['email'] = $user_exists['email'];
            $credentials['password'] = 'youshouldchangethepassword';
            $token = auth()->attempt($credentials);
            $user_exists->update(['password'=>$old_password]);
            return  $token;

        }
        //return redirect('/')->with('message', 'Добро пожаловать на страницу домашнего кабинета!');
        if(!$user_exists) {
            return response( 'Пользователь с таким email не зарегистрирован', 401);

        }

    }

}
