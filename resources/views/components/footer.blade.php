<footer class="footer-section">
    <div class="container relative">
        <div class="sofa-img">
            <!-- <img src="{{ asset('images/sofa.png') }}" alt="Image" class="img-fluid"> -->
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="subscription-form">
                    <h3 class="d-flex align-items-center">
                        <span class="me-1"><img src="{{ asset('images/envelope-outline.svg') }}" alt="Image" class="img-fluid"></span>
                        <span>Subscribe to Newsletter</span>
                    </h3>
                    <div id="subscription-message" class="alert d-none" role="alert"></div>
                    <form action="{{ route('subscribe') }}" method="POST" class="row g-3" id="subscription-form">
                        @csrf
                        <div class="col-auto">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name">
                        </div>
                        <div class="col-auto">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary" id="subscribe-btn">
                                <span class="fa fa-paper-plane"></span>
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row g-5 mb-5">
            <div class="col-lg-4">
                <div class="mb-4 footer-logo-wrap"><a href="{{ route('home') }}" class="footer-logo">Furni<span>.</span></a></div>
                <p class="mb-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant</p>
                <ul class="list-unstyled custom-social">
                    <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
                    <li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
                    <li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
                </ul>
            </div>
            <div class="col-lg-8">
                <div class="row links-wrap">
                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a href="{{ route('about') }}">About us</a></li>
                            <li><a href="{{ route('services') }}">Services</a></li>
                            <li><a href="{{ route('blog') }}">Blog</a></li>
                            <li><a href="{{ route('contact') }}">Contact us</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Knowledge base</a></li>
                            <li><a href="#">Live chat</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a href="#">Jobs</a></li>
                            <li><a href="#">Our team</a></li>
                            <li><a href="#">Leadership</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3">
                        <ul class="list-unstyled">
                            <li><a href="#">Nordic Chair</a></li>
                            <li><a href="#">Kruzo Aero</a></li>
                            <li><a href="#">Ergonomic Chair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top copyright">
            <div class="row pt-4">
                <div class="col-lg-6">
                    <p class="mb-2 text-center text-lg-start">Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a></p>
                </div>
                <div class="col-lg-6 text-center text-lg-end">
                    <ul class="list-unstyled d-inline-flex ms-auto">
                        <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
@push('scripts')
<script>
    function showToast(type, message) {
        var toastHtml = `
                <div aria-live="polite" aria-atomic="true" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
                    <div class="toast align-items-center text-white bg-${type} border-0" role="alert">
                        <div class="d-flex">
                            <div class="toast-body">
                                <i class="fas fa-check-circle me-2"></i> ${message}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            `;
        $('body').append(toastHtml);
        $('.toast').toast({
            delay: 3000
        }).toast('show');
        setTimeout(function() {
            $('.toast').remove();
        }, 3500);
    }
</script>

<script>
    $(document).ready(function() {
        // ------------------------------
        // Add To Cart Button Click
        // ------------------------------
        $(document).on('click', '.add-to-cart-btn', function(e) {
            e.preventDefault();

            const productId = $(this).data('product-id');
            const $button = $(this);

            let $actionsContainer, isDetailPage = false;

            if ($button.closest('.d-flex').length) {
                // Detail page
                $actionsContainer = $button.closest('.d-flex');
                isDetailPage = true;
            } else {
                // List page
                $actionsContainer = $button.closest('.card').find('.card-body');
            }

            $.ajax({
                url: '{{ route("cart.add") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId
                },
                success: function(res) {
                    if ($button.closest('.d-flex').length) {
                        // ✅ Detail Page
                        $actionsContainer.html(`
                        <div class="qty-box d-flex align-items-center me-3" data-product-id="${productId}">
                            <button type="button" class="qty-btn minus btn btn-outline-secondary btn-sm rounded-circle" style="width: 40px; height: 40px;">−</button>
                            <span class="qty-number px-2 fs-5 fw-semibold">1</span>
                            <button type="button" class="qty-btn plus btn btn-outline-secondary btn-sm rounded-circle" style="width: 40px; height: 40px;">+</button>
                        </div>
                        <a href="{{ route('cart') }}" class="btn btn-outline-dark btn-lg px-4 fw-semibold shadow-sm">View Cart</a>
                        <span class="badge bg-danger text-white in-cart-badge"
                            style="position: absolute; top: 10px; right: 10px; padding: 6px 12px; font-size: 0.85rem;">
                            In Cart
                        </span>
                    `);
                    } else {
                        // ✅ List Page
                        const $imgContainer = $button.closest('.product-image-container');
                        $button.remove();
                        $imgContainer.append(`
                        <span class="badge bg-danger text-white in-cart-badge"
                            style="position: absolute; top: 10px; right: 10px;">
                            In Cart
                        </span>
                    `);
                        $actionsContainer.append(`
                        <div class="qty-box d-flex justify-content-center align-items-center mt-3" data-product-id="${productId}">
                            <button type="button" class="qty-btn minus">−</button>
                            <span class="qty-number px-2">1</span>
                            <button type="button" class="qty-btn plus">+</button>
                        </div>
                    `);
                    }

                    // Update cart badge count
                    $('.cart-count').text(res.cartCount).addClass('animate');
                    setTimeout(() => $('.cart-count').removeClass('animate'), 400);

                    // Re-bind qty controls
                    bindQtyControls($actionsContainer.find('.qty-box'));

                    showToast('success', 'Product added to cart!');
                },
                error: function() {
                    showToast('danger', 'Failed to add product to cart.');
                }
            });
        });

        // ------------------------------
        // Qty Increment / Decrement Logic
        // ------------------------------
        function bindQtyControls(box) {
            const minus = box.find('.minus');
            const plus = box.find('.plus');
            const number = box.find('.qty-number');
            const productId = box.data('product-id');

            let lastSentQty = parseInt(number.text()) || 1; // last qty sent to backend

            minus.on('click', function(e) {
                e.preventDefault();
                let qty = parseInt(number.text()) || 1;

                if (qty > 1) {
                    qty--;
                    number.text(qty); // just update UI
                } else {
                    let url = "{{ route('cart.remove', ':id') }}";
                    url = url.replace(':id', productId);
                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function(res) {
                            if (res.success) {
                                const $card = box.closest('.product-card');
                                const $imgContainer = $card.find('.product-image-container');

                                // Remove qty box
                                box.remove();

                                // Remove all In Cart badges
                                $card.find('.in-cart-badge, .in-cart-rectangular, .badge').remove();

                                if ($card.length) {
                                    // ✅ List Page: Restore Add to Cart icon
                                    if ($imgContainer.find('.add-to-cart-btn').length === 0) {
                                        $imgContainer.append(`
                                                <button type="button"
                                                    class="btn btn-sm position-absolute top-0 end-0 m-2 add-to-cart-btn btn-primary"
                                                    data-product-id="${productId}"
                                                    title="Add to Cart">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                            `);
                                    }
                                } else {
                                    // ✅ Detail Page: Restore Add to Cart button + text
                                    const $actionsContainer = $('.d-flex.gap-3');
                                    $actionsContainer.html(`
                                            <button type="button" class="btn btn-primary btn-sm rounded-circle add-to-cart-btn shadow-sm"
                                                data-product-id="${productId}"
                                                title="Add to Cart"
                                                style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                            <h5><strong>Add To Cart</strong></h5>
                                        `);
                                }

                                // Update cart count
                                $('.cart-count').text(res.cartCount).addClass('animate');
                                setTimeout(() => $('.cart-count').removeClass('animate'), 400);

                                showToast('success', 'Item removed from cart!');
                            }
                        },
                        error: function() {
                            showToast('danger', 'Error removing item.');
                        }
                    });
                }
            });

            plus.on('click', function(e) {
                e.preventDefault();
                let qty = parseInt(number.text()) || 1;
                qty++;
                number.text(qty); // just update UI
            });

            // ✅ Update only when mouse leaves box
            box.on('mouseleave', function() {
                let currentQty = parseInt(number.text()) || 1;
                if (currentQty !== lastSentQty) {
                    lastSentQty = currentQty; // update tracker
                    updateQty(productId, currentQty); // send ajax
                }
            });
        }

        function updateQty(id, quantity) {
            $.ajax({
                url: '{{ route("cart.update-qty") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: id,
                    qty: quantity
                },
                success: function(res) {
                    if (res.success) {
                        showToast('success', 'Quantity updated successfully!');
                    } else {
                        showToast('danger', res.toast.message);
                    }
                },
                error: function() {
                    showToast('danger', 'Failed to update quantity.');
                }
            });
        }

        $('.qty-box').each(function() {
            bindQtyControls($(this));
        });

    });
</script>

<script>
    let page = 2;
    let currentSearch = '';
    let typingTimer;
    const typingDelay = 400;

    $(document).on('input', '#search-input', function() {
        clearTimeout(typingTimer);
        let val = $(this).val();
        currentSearch = val;

        $('#clear-search').toggle(val.length > 0);
        typingTimer = setTimeout(function() {
            page = 1;
            fetchProducts(page, true);
        }, typingDelay);
    });

    $(document).on('click', '#clear-search', function() {
        $('#search-input').val('');
        $(this).hide();
        currentSearch = '';
        page = 1;
        fetchProducts(page, true);
    });

    $(document).on('click', '#load-more', function() {
        fetchProducts(page, false);
    });

    function fetchProducts(pageNumber, reset = false) {
        $.ajax({
            url: "{{ route('load.more') }}",
            type: "GET",
            data: {
                page: pageNumber,
                search: currentSearch
            },
            beforeSend: function() {
                if (!reset) {
                    $('#load-more').text('Loading...').prop('disabled', true);
                }
            },
            success: function(response) {
                if (reset) {
                    if (response.html.trim().length === 0) {
                        $('#product-list').html(`
                            <div class="col-12 text-center my-5">
                                <img src="{{ asset('images/no-data.jpg') }}" 
                                     alt="No Data" 
                                     class="img-fluid mb-3" 
                                     style="max-width: 400px;">
                                <h4 class="text-muted fw-bold">No Products Found</h4>
                                <p class="text-secondary">Try different keywords or browse all products.</p>
                            </div>
                        `);
                        $('#load-more').hide();
                        $('#no-more-items').hide();
                        return;
                    }
                    $('#product-list').html(response.html);
                    page = 2;
                } else {
                    if (response.html.trim().length === 0) {
                        $('#load-more').hide();
                        $('#no-more-items').addClass('show').fadeIn();
                        return;
                    }
                    $('#product-list').append(response.html);
                    page++;
                }
                if (response.hasMore) {
                    $('#load-more').show().text('Load More').prop('disabled', false);
                    $('#no-more-items').hide();
                } else {
                    $('#load-more').hide();
                    $('#no-more-items').addClass('show').fadeIn();
                }
            },
            error: function() {
                alert('Something went wrong. Please try again later.');
                $('#load-more').text('Load More').prop('disabled', false);
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        function number_format(num, decimals) {
            return num.toFixed(decimals).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function updateTotals() {
            let subtotal = 0;
            $('tbody tr').each(function() {
                const qty = parseInt($(this).find('.quantity-amount').val()) || 1;
                const price = parseFloat($(this).find('.quantity-amount').data('price'));
                const total = qty * price;
                $(this).find('.product-total').text('₹' + number_format(total, 2));
                subtotal += total;
            });
            $('.subtotal, .total').text('₹' + number_format(subtotal, 2));
        }

        $('.increase, .decrease').click(function() {
            const input = $(this).closest('.input-group').find('.quantity-amount');
            let qty = parseInt(input.val()) || 1;
            qty = $(this).hasClass('increase') ? qty + 1 : Math.max(1, qty - 1);
            input.val(qty);
            updateTotals();
        });

        $('#cart-update-form').submit(function(e) {
            e.preventDefault();
            const data = $(this).serialize();
            $.ajax({
                url: '{{ route("cart.update") }}',
                method: 'POST',
                data: data,
                success: function(res) {
                    updateTotals();
                    if (res.success) {
                        showToast('success', 'Cart updated successfully!');
                    }
                },
                error: function() {
                    showToast('danger', 'Error updating cart.');
                }
            });
        });

        $('.remove-item').click(function() {
            const row = $(this).closest('tr');
            const productId = row.data('product-id');
            let url = "{{ route('cart.remove', ':id') }}";
            url = url.replace(':id', productId);
            $.ajax({
                url: url,
                method: 'GET',
                success: function(res) {
                    if (res.success) {
                        row.fadeOut(300, function() {
                            $(this).remove();
                            updateTotals();
                            $('.cart-count').text(res.cartCount).addClass('animate');
                            setTimeout(() => $('.cart-count').removeClass('animate'), 400);
                            $('.cart-total-count').text(res.cartCount);
                            showToast('success', 'Item removed from cart!');
                        });
                    }
                },
                error: function() {
                    showToast('danger', 'Error removing item.');
                }
            });
        });
    });
</script>
@endpush