<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FruitsController extends Controller
{
    public function FruitIndex()
    {
        $title = 'This is an object';
        return view('fruits.FruitIndex', compact('title'));
    }
}
