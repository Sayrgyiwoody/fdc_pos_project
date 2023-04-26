@extends('admin.layouts.master')

@section('title','Product View Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <!-- HEADER DESKTOP-->
        @section('header')
        <h4>Admin Product View Page</h4>
        @endsection
        <!-- HEADER DESKTOP-->
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2 fw-bold text-primary">Product Information</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <div style="width:400px;height:400px;overflow:hidden;box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;" >
                                        <img src="{{asset('storage/productImages/'.$product->image)}}" alt="" class="img-thumbnail w-100 h-100" style="object-fit:cover;object-postion:center;">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h4>{{$product->name}}</h4>
                                    <button class="btn btn-sm btn-light border"><i class="fa-solid fa-eye text-primary"></i><span class="ms-2 ">{{$product->view_count}}</span></button>
                                    <button class="btn btn-sm btn-light border"><i class="fa-solid fa-money-bill text-warning"></i><span class="ms-2 ">{{$product->price}} Ks</span></button>
                                    <button class="btn btn-sm btn-light border"><i class="fa-solid fa-stopwatch text-info"></i><span class="ms-2 ">{{$product->waiting_time}}</span></button>
                                    <button class="btn btn-sm btn-light border"><i class="fa-solid fa-pizza-slice text-danger"></i><span class="ms-2 fw-bold">{{$product->category_name}}</span></button>
                                    <p class="text-muted mt-2 overflow-auto" style="white-space: pre-wrap;max-height:300px;">{{$product->description}}</p>
                                    <div class="">
                                        <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left me-2"></i>Back</button></a>
                                        <a href="{{route('product#editPage',$product->id)}}"><button class="btn bg-dark text-white my-3"><i class="fa-solid fa-file-pen me-2"></i>Edit</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
