@extends('user.layout.master')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5 mt-5">
            <div class="col-lg-5 mb-30 d-flex align-items-center">
                <div class="ms-auto" style=" width:400px; height:400px;overflow:hidden;">
                    <img class="img-thumbnail w-100 h-100" style="object-fit: cover;object-position:center;" src="{{asset('storage/productImages/'. $product->image)}}" alt="">
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{$product->name}}</h3>
                    <input type="hidden" value="{{Auth::user()->id}}" id="userId">
                    <input type="hidden" value="{{$product->id}}" id="productId">
                    <div class=" mb-3">
                        <i class="fa-solid fa-eye"></i>
                        <span class="">{{$product->view_count+1}}</span>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$product->price}} Ks</h3>
                    <p class="mb-4 overflow-auto" style="white-space: pre-wrap;max-height:200px">{{$product->description}}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" id="orderCount" class="form-control bg-secondary border-0 text-center" value="1" >
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary px-3" id="btnAddToCart"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2 align-items-center justify-content-between">
                        <div class="">
                            <strong class="text-dark mr-2">Share on:</strong>
                            <div class="d-inline-flex">
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                            </div>
                        </div>
                        <div class="">
                            <a href="{{route('user#home')}}" class="btn btn-dark rounded shadow"><i class="fa-solid fa-arrow-left me-2"></i>Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($products as $p )
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <div style="width: 300px; height:300px;overflow:hidden;">
                                <img class="img-thumbnail w-100 h-100" style="object-fit: cover;object-position:center;" src="{{asset('storage/productImages/'. $p->image)}}" alt="">
                            </div>
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{route('user#productDetail',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{$p->price}} Ks</h5>
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->

@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('#btnAddToCart').click(function(){
                $source = {
                    'userId' : $('#userId').val(),
                    'productId' : $('#productId').val(),
                    'productCount' : $('#orderCount').val()
                };
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/addToCart',
                    data : $source,
                    dataType : 'json',
                    success : function (response) {
                        if(response.status == 'success') {
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
            });
            });

    </script>
@endsection
