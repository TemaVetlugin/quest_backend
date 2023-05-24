<?php

namespace App\Http\Controllers\Quest;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EditController extends Controller
{
    public function __invoke(Quest $quest)
    {
        return response($quest, Response::HTTP_OK);
    }
}
