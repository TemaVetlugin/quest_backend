<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class LinkController extends Controller
{
    public function __invoke(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        $email = $user->email;
        $secret_id=$user->id*$user->id+410;
        $secret_id*=6;
        $secret_id-=199;
        $link = 'https://domain/' . $secret_id;
        return $link;
        Mail::send('emails.link', ['link' => $link], function($message) use ($email) {
            $message->to($email);
            $message->subject('Ссылка на страницу для автризации');
        });

        return response('Сcылка для входа отправлена на ваш емаил', Response::HTTP_OK);
    }
}
