<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $categoriesData = $request->input('categories');
        foreach ($categoriesData as $categoryData) {
            $new_category=Category::create($categoryData);
        }
        return response([]);
    }

}
