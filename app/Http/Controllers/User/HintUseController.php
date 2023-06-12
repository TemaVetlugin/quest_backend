<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PhotoStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class HintUseController extends Controller
{
    public function __invoke(Request $request)
    {
        $hint_scores= $request->input('scores');
        $user=auth()->user();
        $data['quest_scores']=$user->quest_scores-$hint_scores;
//        dd($data);
        $user->update($data);
        return response('Вы активировали подсказку', Response::HTTP_OK);
    }

}
