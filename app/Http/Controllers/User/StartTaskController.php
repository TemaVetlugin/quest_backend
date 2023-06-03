<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PhotoStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class StartTaskController extends Controller
{
    public function __invoke(  Request $request)
    {
        $task_key= $request->input('task_key');
        $user=auth()->user();
        $user->update(['task_id' => $task_key]);
//        dd($hints);
        return response('Вы начали задание', Response::HTTP_OK);
    }

}
