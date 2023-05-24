<?php

namespace App\Http\Controllers\Question;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $question = $request->input();
        $new_question=Question::create($question);
        return response('Вопрос добавлен',Response::HTTP_OK);
    }

}
