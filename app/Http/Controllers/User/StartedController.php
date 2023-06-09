<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class StartedController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $data['started_at'] = $user->started_at;
        $data['hints'] = $user->hints;
        return $data;
    }

}
