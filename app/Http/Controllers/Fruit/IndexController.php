<?php

namespace App\Http\Controllers\Fruit;

use App\Models\User;
use App\Models\Fruit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\Fruit\FruitResorce;

class IndexController extends Controller
{
    public function __invoke()
    {
        $fruits=Fruit::all();
        return FruitResorce::collection($fruits);
    }

}
