<?php

namespace App\Http\Controllers\Quest;

use App\Http\Controllers\Controller;
use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{


    public function __invoke(Request $request, Quest $quest)
    {
        $questData = $request->input('content');
        $data = json_decode($questData, true);
        if($request->file('file_start')){
            $file_start=$request->file('file_start');
            if (Storage::disk('public')->exists($quest['file_start'])) {
                // Удаляем файл
                Storage::disk('public')->delete($quest['file_start']);
            }
            $data['file'] = Storage::disk('public')->put('/quests', $file_start);
        }
        if($request->file('file_main')){
            $file_main=$request->file('file_main');
            if (Storage::disk('public')->exists($quest['file_main'])) {
                // Удаляем файл
                Storage::disk('public')->delete($quest['file_main']);
            }
            $data['file'] = Storage::disk('public')->put('/quests', $file_main);
        }
        if($request->file('file_end')){
            $file_end=$request->file('file_end');
            if (Storage::disk('public')->exists($quest['file_end'])) {
                // Удаляем файл
                Storage::disk('public')->delete($quest['file_end']);
            }
            $data['file'] = Storage::disk('public')->put('/quests', $file_end);
        }
        $quest->update($data);
        return response('Квест изменен', Response::HTTP_OK);
    }
}
