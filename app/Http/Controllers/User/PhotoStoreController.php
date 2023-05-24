<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PhotoStoreRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class PhotoStoreController extends Controller
{
    public function __invoke(  PhotoStoreRequest $request)
    {
        $data=$request->validated();
        $user = auth()->user();
//        dd($user['photo']);
        if (Storage::disk('public')->exists($user['photo'])) {
            // Удаляем файл
            Storage::disk('public')->delete($user['photo']);

        }
        $data['photo'] = Storage::disk('public')->put('/photos', $data['photo']);
        $user->update(['photo' => $data['photo']]);
        return response('Фото добавлено', Response::HTTP_OK);
    }

}
