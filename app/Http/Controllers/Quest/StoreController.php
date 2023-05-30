<?php

namespace App\Http\Controllers\Quest;

use App\Models\Quest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Quest\StoreRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $data=$request->input('content');
        $file_start=$request->file('file_start');
        if($file_start){
            $data['file_start']=Storage::disk('public')->put('/quests', $file_start);
        }
        $file_main=$request->file('file_main');
        if($file_main){
            $data['file_main']=Storage::disk('public')->put('/quests', $file_main);
        }
        $file_end=$request->file('file_end');
        if($file_end){
            $data['file_end']=Storage::disk('public')->put('/quests', $file_end);
        }
        $quest=Quest::create($data);
        return $quest->id;
    }

}
