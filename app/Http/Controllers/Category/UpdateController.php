<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(Request $request)
    {
        $categoriesData = $request->input('categories');
        foreach ($categoriesData as $categoryData) {
            DB::table('categories')
                ->where('id', $categoryData->id)
                ->update(['time' => $categoryData->time, 'scores' => $categoryData->scores]);
        }
        return response('Категории изменены', Response::HTTP_OK);
    }
}
