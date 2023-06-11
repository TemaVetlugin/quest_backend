<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DataUpdateController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = auth()->user();
        $data['name']= $request->input('name');
        $user->update($data);
        return response('Имя изменено', Response::HTTP_OK);
    }
}
