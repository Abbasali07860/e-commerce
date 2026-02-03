@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Shop</h1>
                </div>
            </div>
            <div class="col-lg-7 d-flex justify-content-end align-items-center">
                <!-- Search Bar -->
                <form id="search-form" class="w-75 position-relative">
                    <input type="text" name="search" id="search-input"
                        class="form-control rounded-pill shadow-sm ps-4 pe-5"
                        placeholder="Search products..." autocomplete="off">
                    <button type="button" id="clear-search"
                        class="btn btn-light position-absolute top-50 end-10 translate-middle-y rounded-circle shadow-sm p-0"
                        style="display:none; width: 20px; height: 20px; font-size: 9px; right: 77px;">
                        <i class="fas fa-times"></i>
                    </button>

                    <button type="submit" class="btn btn-primary position-absolute top-50 end-0 translate-middle-y me-2 rounded-pill px-3"
                        style="height: 38px;">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row">
            <div id="product-list" class="row">
                @include('partials.product-item', ['products' => $products])
            </div>

            @if ($products->hasMorePages())
            <div class="text-center mt-3">
                <button id="load-more" class="btn btn-primary" data-page="2">Load More</button>
                <p id="no-more-items" class="alert alert-info mt-3 fade" role="alert" style="display: none;">
                    <i class="fas fa-info-circle me-2"></i> No more items to load.
                </p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection