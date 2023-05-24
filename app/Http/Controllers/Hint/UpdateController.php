<?php

namespace App\Http\Controllers\Hint;

use App\Http\Controllers\Controller;
use App\Models\Hint;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Hint $hint)
    {
        $dataHint=$request->input('hint');
        $data=json_decode($dataHint, true);
        $hint->update($data);
        return response('Подсказка изменена', Response::HTTP_OK);
    }
}
