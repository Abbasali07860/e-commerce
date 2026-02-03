@foreach($products as $product)
    @php
        $cart = session('cart', []);
        $inCart = isset($cart[$product->id]);
        $cartQty = $inCart ? $cart[$product->id]['quantity'] : 1;
    @endphp

    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
        <div class="card h-100 shadow-sm border product-card">
            <div class="product-image-container">
                <a href="{{ route('product.show', $product->id) }}">
                    <img src="{{ asset($product->image) }}" class="card-img-top product-thumbnail" alt="{{ $product->title }}">
                </a>
                @if(!$inCart)
                    <button
                        type="button"
                        class="btn btn-sm position-absolute top-0 end-0 m-2 add-to-cart-btn btn-primary"
                        data-product-id="{{ $product->id }}"
                        title="Add to Cart">
                        <i class="fas fa-cart-plus"></i>
                    </button>
                @endif
            </div>
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="product-details d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title mb-1">{{ $product->title }}</h5>
                        <p class="text-success fw-bold mb-0">₹{{ number_format($product->price, 2) }}</p>
                    </div>
                    @if($inCart)
                        <span class="badge bg-danger text-white"
                                    style="position: absolute; top: 10px; right: 10px;">
                                    In Cart
                        </span>
                    @endif
                </div>
                @if($inCart)
                    <div class="qty-box d-flex justify-content-center align-items-center" data-product-id="{{ $product->id }}">
                        <button type="button" class="qty-btn minus">−</button>
                        <span class="qty-number px-2">{{ $cartQty }}</span>
                        <button type="button" class="qty-btn plus">+</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endforeach