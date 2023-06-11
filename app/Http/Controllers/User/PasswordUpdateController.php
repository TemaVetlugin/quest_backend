<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class PasswordUpdateController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        $password = $request->input('password');
        $data['password']=bcrypt($password);;
        $user->update($data);
        return response('Пароль изменена', Response::HTTP_OK);
    }
}
