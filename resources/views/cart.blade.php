@extends('layouts.app')

@section('title', 'Cart')

@section('content')

@php
$cart = session('cart', []);
$subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
@endphp
<!-- Toast Container -->
<div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055;"></div>

<div class="hero-section bg-dark text-white py-4 mb-4">
    <div class="container d-flex align-items-center">
        <i class="fas fa-shopping-cart fa-2x me-3"></i>
        <div>
            <h1 class="fw-bold mb-0">Your Shopping Cart</h1>
            <small class="text-light opacity-75">Review your selected items before checkout</small>
        </div>
    </div>
</div>

<!-- Cart Section -->
<div class="container pb-5">
    <form method="post" id="cart-update-form">
        @csrf
        <div class="table-responsive shadow-sm rounded">
            <table class="table align-middle table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(session('cart', []) as $id => $item)
                    <tr data-product-id="{{ $id }}">
                        <td style="width:80px;">
                            <a href="{{ route('product.show', $item['id']) }}">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" class="img-fluid rounded">
                            </a>
                        </td>
                        <td>
                            <h6 class="fw-semibold mb-1">{{ $item['title'] }}</h6>
                        </td>
                        <td class="text-center">₹{{ number_format($item['price'], 2) }}</td>
                        <td class="text-center">
                            <div class="input-group input-group-sm justify-content-center">
                                <button class="btn btn-outline-secondary decrease" type="button">−</button>
                                <input type="text" class="form-control text-center quantity-amount"
                                    style="max-width:50px;"
                                    name="quantity[{{ $id }}]"
                                    value="{{ $item['quantity'] }}"
                                    data-price="{{ $item['price'] }}">
                                <button class="btn btn-outline-secondary increase" type="button">+</button>
                            </div>
                        </td>
                        <td class="text-center product-total">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-danger remove-item">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <p class="mb-0 text-muted">Your cart is empty.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Buttons -->
        <div class="row mt-4">
            <div class="col-md-6 mb-2">
                <button type="submit" class="btn btn-dark w-100 py-2 fw-semibold">Update Cart</button>
            </div>
            <div class="col-md-6 mb-2">
                <a href="{{ route('shop') }}" class="btn btn-outline-dark w-100 py-2 fw-semibold">Continue Shopping</a>
            </div>
        </div>
    </form>
    @php
    $coupon = session('coupon');
    $discount = 0;
    if ($coupon) {
        if ($coupon->type === 'fixed') {
            $discount = $coupon->value;
        } elseif ($coupon->type === 'percent') {
            $discount = ($subtotal * $coupon->value) / 100;
        }
    }
    $total = max($subtotal - $discount, 0);
    @endphp
    <!-- Totals + Coupon -->
    <div class="row mt-5">
        <!-- Coupon Section -->
        <div class="col-lg-6 mb-4">
            <h5 class="fw-bold mb-3">Coupon</h5>
            <p class="text-muted small">Enter your coupon code if you have one.</p>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Coupon Code" id="c_code">
                <button class="btn btn-dark fw-semibold" type="button" id="apply-coupon">Apply Coupon</button>
            </div>
        </div>

        <!-- Cart Totals Section -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body" style="padding: 25px">
                    <h5 class="fw-bold border-bottom pb-2 mb-3">
                        Cart Totals (<span class="cart-total-count">{{ count(session('cart', [])) }}</span>)
                    </h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <strong class="subtotal">₹{{ number_format($subtotal, 2) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Total</span>
                        <strong class="total">₹{{ number_format($subtotal, 2) }}</strong>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn btn-dark w-100 py-2 fw-semibold">Proceed To Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection