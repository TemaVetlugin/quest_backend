<?php

namespace App\Http\Controllers\Admin\Picture;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PictureStoreRequest;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(  PictureStoreRequest $request)
    {
        $data=$request->validated();
        $data['file'] = Storage::disk('public')->put('/pictures', $data['file']);
        $picture = Picture::create($data);

        if (!$picture) {
            return response('Не удалось добавить фото', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response('Фото добавлено', Response::HTTP_OK);
    }

}
