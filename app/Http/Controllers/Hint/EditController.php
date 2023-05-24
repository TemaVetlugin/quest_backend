<?php

namespace App\Http\Controllers\Hint;

use App\Http\Controllers\Controller;
use App\Models\Hint;
use Illuminate\Http\Response;

class EditController extends Controller
{
    public function __invoke(Hint $hint)
    {
        return response($hint, Response::HTTP_OK);
    }
}
