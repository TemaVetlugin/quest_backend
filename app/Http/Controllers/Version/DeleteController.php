<?php

namespace App\Http\Controllers\Version;

use App\Models\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{
    public function __invoke( Version $version)
    {
        $version->delete();
        return response([]);
    }
}
