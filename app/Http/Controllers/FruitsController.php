<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Fruit;

class FruitsController extends Controller
{
    public function index()
    {
        $fruits = Fruit::all();
        return view('fruits.index', ['fruits' => $fruits]);
    }


    public function create()
    {

        $categories = Category::all();
        return view('fruits.create', ['categories' => $categories,]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'FruitName' => 'required|unique:fruits',
            'Unit' => 'required',
            'Price' => 'required|min:0|max:1000000',
        ]);

        $fruit = Fruit::create([
            'FruitName' => $request->input('FruitName'),
            'Unit' => $request->input('Unit'),
            'Price' => $request->input('Price'),
            'FruitCategory' => $request->input('selectedCategory')


        ]);
        $fruit->save();
        return redirect('/fruits')->with('success');
    }
}
