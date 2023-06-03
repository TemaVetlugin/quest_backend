<?php

namespace App\Http\Controllers\Admin\Quest;

use App\Http\Controllers\Controller;
use App\Http\Resources\Quest\QuestResource;
use App\Models\Quest;
use Illuminate\Http\Response;

class HideController extends Controller
{
    public function __invoke(Quest $quest)
    {
        $quest->update(['available'=> 0]);
        return response('Квест скрыт', Response::HTTP_OK);
    }

}
