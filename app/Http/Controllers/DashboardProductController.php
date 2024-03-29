<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\ProductGallery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProductRequest;

class DashboardProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['galleries', 'category'])->where('users_id', Auth::user()->id)->get();
        return view('pages.dashboard-products', compact('products'));
    }

    // memabuat fungsi product detail
    public function details(Request $request, $id)
    {
        $product = Product::with(['galleries','user','category'])->findOrFail($id);
        $categories = Category::all();
        return view('pages.dashboard-products-details', compact('product','categories'));
    }

    // memabuat fungsi product create
    public function create()
    {
        $categories = Category::all();
        return view('pages.dashboard-products-create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);

        $gallery = [
            'products_id' => $product->id,
            'photos' => $request->file('photo')->store('assets/product','public'),
        ];

        ProductGallery::create($gallery);

        return redirect()->route('dashboard-product');
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('dashboard-product');
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();
        $data['photos'] = $request->file('photos')->store('assets/product','public');

        ProductGallery::create($data);

        return redirect()->route('dashboard-product-details', $request->products_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard-product-details', $item->products_id);
    }

}
