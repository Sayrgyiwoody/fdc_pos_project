@extends('admin.layouts.master')

@section('title','Order List')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        {{-- Header --}}
        @section('header')
        <h3>Order Information</h3>
        @endsection
        {{-- End Header --}}
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-4 offset-1 bg-white px-4 py-2 shadow">
                    <h3 class="my-2"><i class="fa-solid fa-clipboard-list me-2"></i>Order Info</h3>
                    <span class="text-success"><i class="fa-solid fa-truck me-2"></i>Delivery Fee included</span>
                    <div class="row">
                        <div class="col-6 mt-3">
                            <p><i class="fa-solid fa-user me-2"></i>Name</p>
                            <p><i class="fa-solid fa-ticket me-2"></i>Order Code</p>
                            <p><i class="fa-solid fa-clock me-2"></i>Order Date</p>
                            <p><i class="fa-solid fa-money-check-dollar me-2"></i>Total</p>
                            <p><i class="fa-solid fa-circle-info me-2"></i>Status</p>
                        </div>
                        <div class="col-6 mt-3">
                            <p>{{strtoupper($order->user_name)}}</p>
                            <p>{{$order->order_code}}</p>
                            <p>{{$order->created_at->format('F-j-Y')}}</p>
                            <p>{{$order->total_price}} Ks</p>
                            <p>@if ($order->status == 0)
                                <span class="text-info"><i class="fa-solid fa-hourglass-start"></i> Pending</span>
                                @elseif ($order->status == 1)
                                <span class="text-success"><i class="fa-solid fa-thumbs-up"></i> accepted</span>
                                @elseif ($order->status == 2)
                                <span class="text-danger"><i class="fa-solid fa-file-circle-xmark"></i> rejected</span>
                                @endif</p>
                        </div>
                    </div>
                </div>
                <div class="col-3 offset-4">
                    <a class="text-decoration-none text-dark fw-bold" href="{{route('admin#orderListPage')}}"><i class="fa-solid fa-arrow-left me-2"></i>Back to List Page</a>
                </div>
            </div>
            <div class="row">
                <div class="col-10 offset-1">
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class="fw-bold" style="font-size: 16px">Product Id</th>
                                    <th class="fw-bold" style="font-size: 16px">Image</th>
                                    <th class="fw-bold" style="font-size: 16px">Product Name</th>
                                    <th class="fw-bold" style="font-size: 16px">Order Date</th>
                                    <th class="fw-bold" style="font-size: 16px">Qty</th>
                                    <th class="fw-bold" style="font-size: 16px">Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($orderInfo as $o)
                                    <tr class="tr-shadow">
                                        <td class="align-middle text-center fw-bold">{{$o->product_id}}</td>
                                        <td class="col-2">
                                            <div style="width: 125px; height: 125px; overflow: hidden;box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
                                                <img src="{{asset('storage/productImages/'.$o->image_name)}}" class="w-100 h-100 img-thumbnail" style="object-fit: cover; object-position:center;">
                                            </div>
                                        </td>
                                        <td>{{$o->product_name}}</td>
                                        <td>{{$o->created_at->format('F-j-Y')}}</td>
                                        <td>{{$o->qty}}</td>
                                        <td>{{$o->total}} Ks</td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{$orderInfo->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END MAIN CONTENT-->

@endsection

