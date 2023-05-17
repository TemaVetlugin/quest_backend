<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PhotoStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestDoneController extends Controller
{
    public function __invoke(  Request $request)
    {
        $quest_id= $request->input('quest_id');
        $quest_scores= $request->input('quest_scores');
        $user=auth()->user();
        $scores=$user->scores+$quest_scores;
        $user->update(['scores' => $scores]);
        $user->quests()->updateExistingPivot($quest_id, ['mode' => 1]);
//        dd($hints);
        return response([]);
    }

}
