<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('price', 'like', "%{$search}%");
        }

        $products = $query->paginate(8);
        return view('shop', compact('products'));
    }

    public function loadMore(Request $request)
    {
        $page = $request->input('page', 1);
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('price', 'like', "%{$search}%");
        }

        $products = $query->paginate(8, ['*'], 'page', $page);

        if ($request->ajax()) {
            $html = view('partials.product-item', ['products' => $products])->render();
            return response()->json([
                'html' => $html,
                'hasMore' => $products->hasMorePages(),
            ]);
        }

        return view('shop', ['products' => $products]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }
}
