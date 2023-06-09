<?php

namespace App\Http\Controllers\Admin\Quest;

use App\Http\Controllers\Controller;
use App\Http\Resources\Quest\QuestResource;
use App\Models\Quest;

class IndexAdminController extends Controller
{
    public function __invoke()
    {
        $quests=Quest::orderBy('id', 'DESC')->get();
        return QuestResource::collection($quests);
    }

}
