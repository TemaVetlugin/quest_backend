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
        $data = $request->input('content');
        if($request->file('file_start')){
            $file_start=$request->file('file_start');
            if (Storage::disk('public')->exists($quest->file_start)) {
                // Удаляем файл
                Storage::disk('public')->delete($quest->file_start);
            }
            $data['file_start'] = Storage::disk('public')->putFile('/quests', $file_start);
        }
        if($request->file('file_main')){
            $file_main=$request->file('file_main');
            if (Storage::disk('public')->exists($quest->file_main)) {
                // Удаляем файл
                Storage::disk('public')->delete($quest->file_main);
            }
            $data['file_main'] = Storage::disk('public')->putFile('/quests', $file_main);
        }
        if($request->file('file_end')){
            $file_end=$request->file('file_end');
            if (Storage::disk('public')->exists($quest->file_end)) {
                // Удаляем файл
                Storage::disk('public')->delete($quest->file_end);
            }
            $data['file_end'] = Storage::disk('public')->putFile('/quests', $file_end);
        }
        dd($data);
        $quest->update($data);
        return response('Квест изменен', Response::HTTP_OK);
    }
}
