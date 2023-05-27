<?php

namespace App\Http\Controllers\Admin\Photo;

use App\Http\Controllers\Controller;
use App\Http\Resources\Photo\PhotoResource;
use App\Models\Picture;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __invoke()
    {
        $photos = DB::table('users')->where('photo', 'NOT LIKE', 'pictures%')->get(['id', 'photo']);
//        return response($photos, Response::HTTP_OK);
        return PhotoResource::collection($photos);
    }

}
