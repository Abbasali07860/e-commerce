<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $query = Product::orderBy('id', 'desc')->take(3);
        $products = $query->get();
        return view('index', compact('products'));
    }

    public function loadMore(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::orderBy('id', 'asc')->paginate(8, ['*'], 'page', $request->page);
            return view('partials.product-items', compact('products'))->render();
        }
    }

    public function shop()
    {
        $query = Product::orderBy('id', 'asc')->take(8);
        $products = $query->get();
        return view('shop', compact('products'));
    }
}
