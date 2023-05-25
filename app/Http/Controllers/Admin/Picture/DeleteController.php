<?php

namespace App\Http\Controllers\Admin\Picture;

use App\Models\News;
use App\Models\Picture;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;



class DeleteController extends Controller
{
    public function __invoke( $picture) {
        $picture = Picture::find($picture);
        if (!$picture) {
            return response('Изображение не найдено', Response::HTTP_NOT_FOUND);
        }

        Storage::disk('public')->delete($picture['file']);
        $picture->delete();
        return response('Изображение удалена', Response::HTTP_OK);
    }
}
