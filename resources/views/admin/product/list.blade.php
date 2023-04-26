@extends('admin.layouts.master')

@section('title','Product List')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        {{-- Header --}}
        @section('header')
        <form class="form-header" action="{{route('product#list')}}" method="get">
            <input class="au-input au-input--xl" type="text" name="searchKey" value="{{request('searchKey')}}" placeholder="Search for product name..." />
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
                                <h2 class="title-1 ">product List</h2>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary">
                            <i class="fa-solid fa-gifts me-2"></i> <span class="badge text-primary text-bg-light">{{$products->total()}}</span>
                        </button>
                        <div class="table-data__tool-right">
                            <a href="{{route('product#createPage')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small ">
                                    <i class="zmdi zmdi-plus"></i>add product
                                </button>
                            </a>
                        </div>
                    </div>
                    {{-- For alert message --}}
                    @if (session('createAlert'))
                    <div class="col-5 offset-7">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-thumbs-up me-2"></i>{{session('createAlert')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif
                    @if (session('deleteAlert'))
                    <div class="col-5 offset-7">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-trash me-2"></i>{{session('deleteAlert')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif
                    @if (session('updateAlert'))
                    <div class="col-5 offset-7">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-wrench me-2 "></i>{{session('updateAlert')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif
                    @if (session('newPasswordAlert'))
                    <div class="col-5 offset-7">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{session('newPasswordAlert')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif
                    @if (count($products) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class="fw-bold" style="font-size: 16px">Id</th>
                                    <th class="fw-bold" style="font-size: 16px">Image</th>
                                    <th class="fw-bold" style="font-size: 16px">Name</th>
                                    <th class="fw-bold" style="font-size: 16px">Category</th>
                                    <th class="fw-bold" style="font-size: 16px">Price</th>
                                    <th class="fw-bold" style="font-size: 16px">View</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($products as $p)
                                    <tr class="tr-shadow">
                                        <td class="align-middle fw-bold">{{$p->id}}</td>
                                        <td class="col-2">
                                            <div style="width: 125px; height: 125px; overflow: hidden;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
                                                <img src="{{asset('storage/productImages/'.$p->image)}}" class="w-100 h-100 img-thumbnail" style="object-fit: cover; object-position:center;">
                                            </div>
                                        </td>
                                        <td>{{$p->name}}</td>
                                        <td>{{$p->category_name}}</td>
                                        <td>{{$p->price}} Ks</td>
                                        <td>{{$p->view_count}}</td>
                                        <td class="align-middle">
                                            <a href="{{route('product#view',$p->id)}}" class="btn btn-light shadow_2 me-2"><i class="text-primary fa-solid fa-eye"></i></a>
                                            <a href="{{route('product#editPage',$p->id)}}" class="btn btn-light shadow_2 me-2"><i class="text-success fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{route('product#delete',$p->id)}}" class="btn btn-light shadow_2"><i class="text-danger fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h3 class="text-secondary text-center">There's no product to show!<i class="fa-solid fa-face-frown-open ms-2"></i></h3>
                    @endif
                    <!-- END DATA TABLE -->
                    <div class="mt-3">
                    {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
