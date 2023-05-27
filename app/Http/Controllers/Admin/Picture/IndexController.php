<?php

namespace App\Http\Controllers\Admin\Picture;

use App\Http\Controllers\Controller;
use App\Http\Resources\Picture\PhotoResource;
use App\Models\Picture;

class IndexController extends Controller
{
    public function __invoke()
    {
        $pictures=Picture::orderBy('id', 'DESC')->get();
        return PhotoResource::collection($pictures);
    }

}
