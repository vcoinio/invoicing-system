<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function CategoryIndex()
    {
        $categories = Category::all();
        // dd($categories);
        return view('categories.CategoryIndex', ['categories' => $categories,]);
    }
}
