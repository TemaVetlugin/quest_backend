<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    public function __invoke(Team $team)
    {
        $user = auth()->user();
        if($team->creator_id===$user->id){
            $message=true;
        }
        else{
            $message=false;
        }
        return response($message, Response::HTTP_OK);
    }
}
