<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function apiGetCategories()
    {
        $categories = Category::with('parent')->get();

        return response()->json($categories);
    }
}
