@extends('layouts.app')

@section('title', $product->title)

@section('content')
@php
    $cart = session('cart', []);
    $inCart = isset($cart[$product->id]);
    $cartQty = $inCart ? $cart[$product->id]['quantity'] : 1;
@endphp

<div class="container py-5">
    <div class="row">
        {{-- Single Section: Product Images and Info --}}
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4 rounded-3 bg-white" style="max-width: 100%;">
                <div class="row g-4">
                    {{-- Left Side: Product Images (Gallery Style) --}}
                    <div class="col-lg-5 col-md-12 text-center">
                        <div class="position-relative">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->title }} - Main" class="img-fluid rounded-2 mb-3" style="max-height: 450px; object-fit: contain; padding: 10px; border: 1px solid #ddd;">
                            @if($inCart)
                                <span class="badge bg-danger text-white in-cart-rectangular" style="position: absolute; top: 6px; right: 96px; animation: pulse 1.5s infinite;">
                                    In Cart
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Right Side: Product Info (Flipkart Style) --}}
                    <div class="col-lg-7 col-md-12">
                        <h2 class="fw-bold mb-3">{{ $product->title }}</h2>
                        
                        {{-- Rating / Reviews (Flipkart Style) --}}
                        <div class="mb-4 d-flex align-items-center">
                            <span class="badge bg-success me-3 p-2" style="font-size: 1rem;">4.3 ★</span>
                            <small class="text-muted">1,234 Ratings & 234 Reviews</small>
                        </div>

                        {{-- Price Section (Flipkart Style with Discount) --}}
                        <div class="mb-3">
                            <h3 class="text-primary fw-bold mb-1">₹{{ number_format($product->price, 2) }}</h3>
                            <p class="text-muted mb-1"><del>₹{{ number_format($product->price * 1.2, 2) }}</del> <span class="text-success fw-bold">(16% off)</span></p>
                            <p class="text-muted mb-4">Inclusive of all taxes</p>
                        </div>

                        {{-- Quantity & Actions --}}
                            <div class="d-flex gap-3 mb-4 position-relative align-items-center">
                                @if($inCart)
                                    <div class="qty-box d-flex align-items-center me-3" data-product-id="{{ $product->id }}">
                                        <button type="button" class="qty-btn minus btn btn-outline-secondary btn-sm rounded-circle" style="width: 40px; height: 40px;">−</button>
                                        <span class="qty-number px-2 fs-5 fw-semibold">{{ $cartQty }}</span>
                                        <button type="button" class="qty-btn plus btn btn-outline-secondary btn-sm rounded-circle" style="width: 40px; height: 40px;">+</button>
                                    </div>
                                    <a href="{{ route('cart') }}" class="btn btn-outline-dark btn-lg px-4 fw-semibold shadow-sm">View Cart</a>
                                @else
                                    <button type="button" class="btn btn-primary btn-sm rounded-circle add-to-cart-btn shadow-sm"
                                        data-product-id="{{ $product->id }}"
                                        title="Add to Cart"
                                        style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                    <h5><strong>Add To Cart</strong></h5>
                                @endif
                            </div>


                        {{-- Offers Section (Flipkart Style) --}}
                        <div class="mb-4">
                            <h6 class="fw-bold">Available Offers</h6>
                            <ul class="list-unstyled text-muted small">
                                <li class="mb-2">💳 Bank Offer: 10% instant discount on select cards</li>
                                <li class="mb-2">🏷 Special Price: Get extra 5% off</li>
                                <li>🚚 Free delivery on orders above ₹500</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn {
        transition: all 0.3s ease;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card {
        background: #f9f9f9;
    }
    .img-fluid {
        border: 1px solid #eee;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .text-primary {
        color: #2874f0 !important; /* Flipkart blue */
    }
</style>
@endsection