<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke()
    {
        $roadmaps=User::orderBy('scores', 'DESC')->get();
        return UserResource::collection($roadmaps);
    }

}