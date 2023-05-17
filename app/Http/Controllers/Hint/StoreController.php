<?php

namespace App\Http\Controllers\Hint;

use App\Models\Hint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $hintsData = $request->input('hints');
        foreach ($hintsData as $hintData) {
            $new_hint=Hint::create($hintData);
        }
        return response([]);
    }

}
