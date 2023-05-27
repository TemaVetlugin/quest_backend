<?php

namespace App\Http\Controllers\Admin\Photo;

use App\Models\News;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;



class DeleteController extends Controller
{
    public function __invoke(User $user) {
        if($user->photo==null){
            return response('У пользователя нет фото профиля', Response::HTTP_OK);
        }
        if(stripos($user['photo'], 'https') === false) {
//            return '11111';
            if (Storage::disk('public')->exists($user['photo'])) {
                // Удаляем файл
                Storage::disk('public')->delete($user['photo']);

            }
        }
//        return '222222';
        $user->update(['photo' => null]);
        return response('Изображение удалена', Response::HTTP_OK);
    }
}
