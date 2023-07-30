<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        // dd($categories);
        return view('categories.index', ['categories' => $categories,]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $category = Category::create([
            'FruitType' => $request->input('FruitType')
        ]);
        $category->save();

        return redirect('/categories')->with('success');
    }
}
