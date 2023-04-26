@extends('admin.layouts.master')

@section('title','Order List')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        {{-- Header --}}
        @section('header')
        <form class="form-header" action="{{route('admin#orderListPage')}}" method="get">
            <input class="au-input au-input--xl" type="text" name="searchKey" value="{{request('searchKey')}}" placeholder="Search for order code..." />
            <button class="au-btn--submit" type="submit" >
                <i class="zmdi zmdi-search"></i>
            </button>
        </form>
        @endsection
        {{-- End Header --}}
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Customer Order List</h2>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary">
                            <i class="fa-solid fa-border-all me-2"></i> <span class="badge text-primary text-bg-light">{{$order->total()}}</span>
                        </button>
                        <div class="table-data__tool-right d-flex align-items-center">
                            <form action="{{route('admin#statusSort')}}" class="form-control d-flex" method="get">
                                <select name="status" class="form-select me-2" id="sortingStatus">
                                    <option value="" selected >All</option>
                                    <option value="0" @if(request('status') == '0') selected @endif>Pending</option>
                                    <option value="1" @if(request('status') == '1') selected @endif>Accepted</option>
                                    <option value="2" @if(request('status') == '2') selected @endif>Rejected</option>
                                </select>
                                <button class="btn btn-secondary">Sort</button>
                            </form>
                        </div>
                        <div class="btn btn-danger delete-order-all" style="padding-top: 13px;">Delete All <i class="fa-solid fa-trash"></i></div>
                    </div>
                    @if (count($order) != null)
                    {{-- Start Table --}}
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class="fw-bold" style="font-size: 16px">Id</th>
                                    <th class="fw-bold" style="font-size: 16px">Customer Name</th>
                                    <th class="fw-bold" style="font-size: 16px">Order Date</th>
                                    <th class="fw-bold" style="font-size: 16px">Order Code</th>
                                    <th class="fw-bold" style="font-size: 16px">Total Price</th>
                                    <th class="fw-bold" style="font-size: 16px">Order Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="orderTable">
                                    @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" id="orderId" value="{{$o->id}}">
                                        <td>{{$o->id}}</td>
                                        <td>{{$o->user_name}}</td>
                                        <td>{{$o->created_at->format('F-j-Y')}}</td>
                                        <td><a href="{{route('admin#orderInfo',$o->order_code)}}" class="btn btn-light text-primary">{{$o->order_code}}</a></td>
                                        <td>{{$o->total_price}} Ks</td>
                                        <td style="width:20%">
                                            <select class="form-select statusChange"  name="" id="">
                                                <option value="0" @if($o->status=='0') selected @endif>Pending</option>
                                                <option value="1" @if($o->status=='1') selected @endif>Accept</option>
                                                <option value="2" @if($o->status=='2') selected @endif>Reject</option>
                                            </select>
                                        </td>
                                        <input type="hidden" class="order_code" value="{{$o->order_code}}">
                                        <td><button class="btn btn-white text-danger delete-order shadow_2" ><i class="fa-solid fa-trash"></i></button></td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h3 class="text-secondary text-center">There's no order to show!<i class="fa-solid fa-face-frown-open ms-2"></i></h3>
                    @endif
                    <!-- END DATA TABLE -->
                    <div class="mt-2">
                        {{$order->appends(request()->query())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            //status change
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parendNode = $(this).parents('tr');
                $orderId = $parendNode.find('#orderId').val();

                $.ajax({
                    type : 'get',
                    url : '/admin/order/list/status/change',
                    data : {
                        'orderId' : $orderId,
                        'status' : $currentStatus
                    },
                    dataType : 'json',
                    success : function() {
                        Swal.fire({
                        icon: 'success',
                        title: 'Order Status has been changed',
                        showConfirmButton: true,
                        // timer: 1500
                    })
                    }
                })
            })
        });

        //Delete Order
        $('.delete-order').click(function() {
            $parentNode = $(this).parents('tr');
            $order_code = $parentNode.find('.order_code').val();
            Swal.fire({
            title: 'Are you sure?',
            text: "This Order will be removed from order list!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type : 'get',
                    url : '/admin/order/delete',
                    data : {'order_code' : $order_code},
                    dataType : 'json',
                    success : function() {
                        Swal.fire(
                        'Deleted!',
                        'Your Order has been deleted.',
                        'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/admin/order/list';
                            }
                        });
                    }

                });

            }
            })
        })

        //delete all order
        $('.delete-order-all').click(function() {
            Swal.fire({
            title: 'Are you sure?',
            text: "All orders will be deleted !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type : 'get',
                    url : '/admin/order/delete/all',
                    dataType : 'json',
                    success : function() {
                        Swal.fire(
                        'Deleted!',
                        'All orders have been deleted.',
                        'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/admin/order/list';
                            }
                        });
                    }

                });

            }
            })
        })
    </script>
@endsection

@section('scriptSource')




@endsection
