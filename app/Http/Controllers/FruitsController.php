<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Fruit;

class FruitsController extends Controller
{
    public function index()
    {
        $title = 'This is an object';
        return view('fruits.index', compact('title'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('fruits.create')->with('categories', $categories);
    }
    public function store(Request $request)
    {
        $request->validate([
            'FruitName' => 'required|unique:fruits',
            'Unit' => 'required',
            'Price' => 'required|float|min:0|max:1000000',
        ]);

        $fruit = Fruit::create([
            'FruitName' => $request->input('FruitName'),
            'Unit' => $request->input('Unit'),
            'Price' => $request->input('Price'),
            'Categoryid' => $request->input('CategoryId')

        ]);
        $fruit->save();
        return redirect('/fruits');
    }
}
