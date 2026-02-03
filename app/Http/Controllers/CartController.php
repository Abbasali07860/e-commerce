<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Coupon;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'title' => $product->title,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1
            ];
        }
        session()->put('cart', $cart);
        return response()->json([
            'success'   => true,
            'cartCount' => count($cart)
        ]);
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', ['cart' => $cart]);
    }
    public function updateCart(Request $request)
    {
        $quantities = $request->input('quantity', []);
        $cart = session()->get('cart', []);

        foreach ($quantities as $id => $qty) {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = max(1, (int) $qty); 
            }
        }
        session()->put('cart', $cart);
        return response()->json(['success' => true, 'cartCount' => count($cart)]);
    }
    public function updateQty(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->product_id;
        $qty = $request->qty;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = max(1, (int) $qty); 
            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'cartCount' => count($cart),
            ]);
        }
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return response()->json([
            'success'   => true,
            'cartCount' => count($cart)
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $code = trim($request->code);
        $coupon = Coupon::where('code', $code)
            ->where('status', 1)
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })
            ->first();

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired coupon.']);
        }

        session()->put('coupon', $coupon);
        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully!',
            'coupon' => $coupon
        ]);
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
        return response()->json(['success' => true, 'message' => 'Coupon removed.']);
    }
}
