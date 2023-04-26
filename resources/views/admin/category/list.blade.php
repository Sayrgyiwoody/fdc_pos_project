@extends('admin.layouts.master')

@section('title','Category List')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        {{-- Header --}}
        @section('header')
        <form class="form-header" action="{{route('category#list')}}" method="get">
            <input class="au-input au-input--xl" type="text" name="searchKey" value="{{request('searchKey')}}" placeholder="Search for category name..." />
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
                                <h2 class="title-1 ">Category List</h2>
                            </div>

                        </div>
                        <button type="button" class="btn btn-primary">
                            <i class="fa-solid fa-database me-2"></i> <span class="badge text-primary text-bg-light">{{$categories->total()}}</span>
                        </button>
                        <div class="table-data__tool-right">
                            <a href="{{route('category#createPage')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small ">
                                    <i class="zmdi zmdi-plus"></i>add category
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
                    @if (count($categories) != null)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class="fw-bold text-center" style="font-size: 16px">Id</th>
                                    <th class="fw-bold" style="font-size: 16px">Category Name</th>
                                    <th class="fw-bold" style="font-size: 16px">Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($categories as $c)
                                    <tr class="tr-shadow">
                                        <td class="text-center">{{$c->id}}</td>
                                        <td style="width:30%">{{$c->name}}</td>
                                        <td style="width:30%">{{$c->created_at->format('F-j-Y')}}</td>
                                        <td style="width:20%">
                                            <a href="{{route('category#editPage',$c->id)}}" class="btn shadow_2 btn-light"><i class=" fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{route('category#delete',$c->id)}}" class="ms-2 btn shadow_2 btn-danger"><i class=" fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h3 class="text-secondary text-center">There's no category to show!<i class="fa-solid fa-face-frown-open ms-2"></i></h3>
                    @endif
                    <!-- END DATA TABLE -->
                    <div class="mt-2">
                    {{$categories->appends(request()->query())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
