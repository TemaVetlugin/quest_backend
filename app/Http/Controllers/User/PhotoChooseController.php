<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PhotoStoreRequest;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class PhotoChooseController extends Controller
{
    public function __invoke(Request $request) {
        $pictureName = $request->input('photo');
        $picture = Picture::where('file', $pictureName)->first();
        if (!$picture) {
            return response('Изображение не найдено', Response::HTTP_NOT_FOUND);
        }
        $user = auth()->user();
        $user->update(['photo'=> $pictureName]);

        return response('Фото добавлено', Response::HTTP_OK);
    }

}
