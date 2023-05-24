<?php

namespace App\Http\Controllers\Admin\Quest;

use App\Http\Controllers\Controller;
use App\Http\Resources\Quest\QuestResource;
use App\Models\Quest;

class OpenController extends Controller
{
    public function __invoke(Quest $quest)
    {
        $quest->update(['available'=> 1]);
        return response('Квест открыт');
    }

}
