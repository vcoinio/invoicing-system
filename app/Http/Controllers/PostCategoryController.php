<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PostCategoryController extends Controller
{
    public function PostIndex()
    {
        $categories = DB::table("categories")->insert([
            "FruitType" => "Pear"
        ]);
        // $categories = DB::select(("SELECT * FROM categories;"));
        // categories = DB::table("categories")->where("id",1);
        dd($categories);
        // return view('categories.GetIndex');
    }
}
