<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Response;

class EditController extends Controller
{
    public function __invoke(Category $category)
    {
        return response($category, Response::HTTP_OK);
    }
}
