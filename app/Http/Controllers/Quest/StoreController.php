<?php

namespace App\Http\Controllers\Quest;

use App\Models\Quest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Quest\StoreRequest;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data=$request->validated();
        $quest=Quest::create($data);
        return $quest->id;
    }

}
