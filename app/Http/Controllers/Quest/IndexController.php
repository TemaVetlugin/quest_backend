<?php

namespace App\Http\Controllers\Quest;

use App\Http\Controllers\Controller;
use App\Http\Resources\Quest\QuestResource;
use App\Models\Quest;

class IndexController extends Controller
{
    public function __invoke()
    {
        $quests=Quest::where('available', 1)->orderBy('id', 'DESC')->get();
        return QuestResource::collection($quests);
    }

}
