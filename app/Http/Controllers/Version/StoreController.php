<?php

namespace App\Http\Controllers\Version;

use App\Http\Controllers\Controller;
use App\Http\Requests\Version\StoreRequest;
use App\Http\Resources\Admin\CardResource;
use App\Models\Version;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(  StoreRequest $request)
    {
        $data=$request->validated();
        $data['main_image'] = Storage::disk('public')->put('/versions', $data['main_image']);
        Version::create($data);
        return response([]);
    }

}
