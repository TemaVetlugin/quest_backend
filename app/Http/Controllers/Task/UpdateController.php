<?php

namespace App\Http\Controllers\Quest;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Quest $quest)
    {
        $data=$request->input();
        $quest->update($data);
        return response('Квест изменен', Response::HTTP_OK);
    }
}
