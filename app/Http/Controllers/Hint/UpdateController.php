<?php

namespace App\Http\Controllers\Hint;

use App\Http\Controllers\Controller;
use App\Models\Hint;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke( Request $request, Hint $version)
    {
        $data=$request->validated();
        if(isset($data['main_image'])){
            $data['main_image'] = Storage::disk('public')->put('/versions', $data['main_image']);}
        $version->update($data);
        return response([]);
    }

}
