@extends('user.layout.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row p-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table id="dataTable" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cart as $c)
                        <tr>
                            <td class="col-2 ">
                                <div class="mx-auto" style="width: 100px; height: 100px; overflow: hidden;">
                                    <img src="{{asset('storage/productImages/'.$c->image)}}" class=" w-100 h-100 img-thumbnail" style="object-fit: cover; object-position:center;">
                                </div>
                            </td>
                            <td class="align-middle">{{$c->product_name}}<input type="hidden" id="userId" value="{{$c->user_id}}"><input id="productId" type="hidden" value="{{$c->product_id}}"><input type="hidden" id="cartId" value="{{$c->id}}"></td>
                            <td class="align-middle" id="product_price">{{$c->product_price}} Ks</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" id="qty" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$c->qty}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="total">{{$c->product_price*$c->qty}} Ks</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger btn-remove"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{$cart->links()}}
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{$totalPrice}} Ks</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000 Ks</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="totalPrice">{{$totalPrice+3000}} Ks</h5>
                        </div>
                    <button class="btn btn-block btn-primary fw-bold mt-3 py-2 order-btn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger fw-bold delete-all-btn py-2">Delete All</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection


@section('scriptSource')
    <script src="{{asset('js/cart.js')}}"></script>
    <script>
        //Order cart
        $('.order-btn').click(function () {

            $random = Math.floor(Math.random() * 100000001);
            $orderList = [];
            $('#dataTable tbody tr').each(function(index,row) {
                $userId = $(row).find('#userId').val();
                $productId = $(row).find('#productId').val();
                $total = Number($(row).find('#total').text().replace('Ks',''));
                $qty = $(row).find('#qty').val();
                $orderCode = 'POS' + $random;

                $orderList.push({
                    'user_id' : $userId,
                    'product_id' : $productId,
                    'total' : $total,
                    'qty' : $qty,
                    'order_code' :$orderCode
                });
            })
            $.ajax({
                        type : 'get',
                        url : '/user/order/list',
                        data : Object.assign({},$orderList),
                        dataType : 'json',
                        success : function (response) {
                            if(response.status == 'true') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Products ordered successfully.',
                                    showConfirmButton: true,
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = '/user/home';
                                    }
                                });
                            }
                        }
                    });
        });
        //Delete all from cart list
        $('.delete-all-btn').click(function() {
            $('#dataTable tbody tr').remove();
            $.ajax({
                type: 'get',
                url : '/user/ajax/delete/cart/all',
                dataType : 'json',
                success :function() {
                Swal.fire({
                        icon: 'success',
                        title: 'All Carts have been deleted',
                        showConfirmButton: true,
                        // timer: 1500
                })
            }
            });

        });

        //Delete Each Cart
        $('.btn-remove').click(function(){
        $parentNode = $(this).parents('tr');
        $newTotal = $parentNode.find('#total').text().replace('Ks','');
        $sub_total -= Number($newTotal);
        $('#subTotal').html(`${$sub_total} Ks`);
        $('#totalPrice').html(`${$sub_total+3000} Ks`);

        $userId = $parentNode.find('#userId').val();
        $productId = $parentNode.find('#productId').val();
        $cartId = $parentNode.find('#cartId').val();
        $parentNode.remove();


        $.ajax({
            type : 'get',
            url : '/user/ajax/delete/cart',
            data : {
                'userId' : $userId,
                'productId' : $productId,
                'cartId' : $cartId
            },
            dataType : 'json',
            success :function() {
                Swal.fire({
                        icon: 'success',
                        title: 'Cart has been deleted',
                        showConfirmButton: true,
                        // timer: 1500
                })
            }
        });
        });
    </script>

@endsection
