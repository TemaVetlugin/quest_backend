<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PhotoStoreRequest;
use App\Models\Team;
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
        $team=Team::where('id', $user->team_id)->first();
        $data['quest_scores']=$team->quest_scores-$hint_scores;
        $data['hints'] = $team->hints + 1;
//        dd($data);
        $team->update($data);
        return response('Вы активировали подсказку', Response::HTTP_OK);
    }

}
