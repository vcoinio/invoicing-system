<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FruitsController extends Controller
{
    public function index()
    {
        $title = 'This is an object';
        return view('fruits.index', compact('title'));
    }
}
