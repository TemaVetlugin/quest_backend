<?php

namespace App\Http\Controllers\Version;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VersionResource;
use App\Models\Version;

class IndexController extends Controller
{
    public function __invoke()
    {
        $versions=Version::orderBy('id', 'DESC')->get();
        return VersionResource::collection($versions);
    }

}
