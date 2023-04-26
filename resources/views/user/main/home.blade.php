@extends('user.layout.master')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        @if (session('newPasswordAlert'))
            <div class="col-5 offset-7">
                <div class="alert alert-secondary alert-dismissible fade show text-primary border-dark" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i>{{ session('newPasswordAlert') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div class="row px-xl-5 mt-3">
            <div class="col-lg-3 mt-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-white w-100 rounded"
                    data-toggle="collapse" href="#navbar-vertical"
                    style="height: 65px; padding: 0 30px; border:3px solid #6dbc45 ;">
                    <h6 class="text-dark m-0 fw-bold"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <button class=" btn rounded p-2 btn-dark badge">{{ count($categories) }}</button>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                    id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100 ">
                        <a href="{{ route('user#home') }}" class="nav-item nav-link text-dark"><i
                                class="fa-solid fa-pizza-slice text-primary me-2"></i>All</a>
                        @foreach ($categories as $c)
                            <a href="{{ route('user#categoryFilter', $c->id) }}" class="nav-item nav-link text-dark"><i
                                    class="fa-solid fa-square text-primary me-2"></i>{{ $c->name }}</a>
                        @endforeach
                    </div>
                </nav>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3 px-2">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex">
                                <a href="{{ route('cart#list') }}" class="me-3 btn btn-primary position-relative rounded">
                                    <i class="fa fa-shopping-cart text-dark"></i>
                                    <i class="fa-solid fa-list text-dark"></i>
                                    <span style="font-size: 16px;"
                                        class=" cart-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $cartCount }}
                                    </span>
                                </a>
                                <a href="{{ route('user#orderListPage') }}"
                                    class="btn btn-primary position-relative rounded">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    Recent
                                    <span style="font-size: 16px;"
                                        class=" position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $orderCount }}
                                    </span>
                                </a>
                            </div>
                            <form class="form-header d-flex justify-content-center my-3 " action="{{ route('user#home') }}"
                                method="get">
                                <input class="form-control " type="text" name="searchKey"
                                    value="{{ request('searchKey') }}" placeholder="Search for product name..." />
                                <button class="btn btn-primary " type="submit">
                                    <i class="fa-solid fa-search"></i>
                                </button>
                            </form>
                            <div class="me-4">
                                <div class="dropdown">
                                    <button class="btn btn-dark rounded dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Sorting
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('user#home') }}">Newest First</a></li>
                                        <li><a class="dropdown-item" href="{{ route('user#homeAsc') }}">Oldest First</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="sortingProducts">
                        @if (count($products) != 0)
                            @foreach ($products as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1 p-2">
                                    <div class="product-item bg-light mb-4 shadow-sm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <div style="width: 300px; height:300px; overflow:hidden; margin:auto;">
                                                <img class="img-thumbnail w-100 h-100 rounded-0"
                                                    style="object-fit: cover;object-position:center;"
                                                    src="{{ asset('storage/productImages/' . $p->image) }}" alt="">
                                            </div>
                                            <div class="product-action">
                                                <input type="hidden" class="user-id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" class="product-id" value="{{ $p->id }}">
                                                <a class="btn btn-outline-dark btn-square add-cart-btn"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square "
                                                    href="{{ route('user#productDetail', $p->id) }}"><i
                                                        class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h4>{{ $p->price }} ks</h4>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row">
                                <div class=" col-6 offset-3 alert alert-secondary text-dark" role="alert">
                                    <i class="fa-solid fa-pizza-slice me-2 text-primary"></i>Sorry, There's no pizza
                                    available with this Category.
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                {{ $products->links() }}
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection


@if (session('contactMessage'))

    @section('scriptSource')
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('contactMessage') }}',
                showConfirmButton: true,
                // timer: 1500
            })
        </script>
    @endsection

@endif


@section('scriptSource')
    <script>
        $('.add-cart-btn').click(function() {
            $parentNode = $(this).parents('.product-item');
            $product_id = $parentNode.find('.product-id').val();
            $user_id = $parentNode.find('.user-id').val();
            $source = {
                'userId': $parentNode.find('.user-id').val(),
                'productId': $parentNode.find('.product-id').val(),
                'productCount': '1'
            }
            $.ajax({
                type: 'get',
                url: '/user/ajax/addToCart',
                data: $source,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Products ordered successfully.',
                            showConfirmButton: true,
                        })
                        newCartCount = Number($('.cart-count').text())+1;
                        $('.cart-count').text(newCartCount);
                    }
                }
            });
        })
    </script>
@endsection

