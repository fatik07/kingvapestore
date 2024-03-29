<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('galleries')->paginate(4);
        return view('pages.category', compact('categories','products'));
    }

    public function details(Request $request, $slug)
    {
        $categories = Category::all();

        $category = Category::where('slug', $slug)->firstOrFail();
        // mencari data sesuai dengan category id
        $products = Product::with('galleries')->where('categories_id', $category->id)->paginate(4);
        return view('pages.category', compact('categories','products'));
    }
}
