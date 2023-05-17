<?php

namespace App\Http\Controllers\Version;

use App\Http\Controllers\Controller;
use App\Http\Requests\Version\StoreRequest;
use App\Http\Resources\Admin\CardResource;
use App\Models\Version;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke( StoreRequest $request, Version $version)
    {
        $data=$request->validated();
        if(isset($data['main_image'])){
            $data['main_image'] = Storage::disk('public')->put('/versions', $data['main_image']);}
        $version->update($data);
        return response([]);
    }

}
