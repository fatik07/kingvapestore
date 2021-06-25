<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // mengambil data kategori sebanyak 6 dengan fungsi take(), lalu get untuk ambil data
        $categories = Category::take(6)->get();
        // mengambil data dari relasi galery di model product
        $products = Product::with('galleries')->take(8)->get();

        return view('pages.home', compact('categories','products'));
    }
}
