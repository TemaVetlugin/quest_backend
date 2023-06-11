<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class LinkController extends Controller
{
    public function __invoke(Request $request)
    {
        $link = url('/some-page');
        $email = $request->input('email');
        Mail::send('emails.link', ['link' => $link], function($message) use ($email) {
            $message->to($email);
            $message->subject('Ссылка на страницу для автризации');
        });

        return response('Сcылка для входа отправлена на ваш емаил', Response::HTTP_OK);
    }
}
