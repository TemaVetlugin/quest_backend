<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Task $task)
    {
        $taskData = $request->input('task');
        $categoriesData = $request->input('categories');
        foreach ($categoriesData as $categoryData) {
            DB::table('categories')
                ->where('id', $categoryData->id)
                ->update(['time' => $categoryData->time, 'scores' => $categoryData->scores]);
        }
        $data = json_decode($taskData, true);
        if($request->file('file')){
            $file=$request->file('file');
            if (Storage::disk('public')->exists($task['file'])) {
                // Удаляем файл
                Storage::disk('public')->delete($task['file']);
            }
            $data['file'] = Storage::disk('public')->put('/tasks', $file);
        }
        if($request->file('file_qr')){
            $file=$request->file('file_qr');
            if (Storage::disk('public')->exists($task['file_qr'])) {
                // Удаляем файл
                Storage::disk('public')->delete($task['file_qr']);
            }
            $data['file_qr'] = Storage::disk('public')->put('/tasks', $file);
        }
        $task->update($data);
        return response('Задание изменено', Response::HTTP_OK);
    }
}
