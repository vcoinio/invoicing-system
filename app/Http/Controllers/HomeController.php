<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $userExists = auth()->check();
        return view('home.index', ['userExists' => $userExists]);
    }
}
