@extends('admin.layouts.master')

@section('title','Product Create Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <!-- HEADER DESKTOP-->
        @section('header')
        <h4>Admin Product Create Page</h4>
        @endsection
        <!-- HEADER DESKTOP-->
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3"><i class="fa-solid fa-table-list me-2"></i>List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2 fw-bold">Create Product</h3>
                            </div>
                            <hr>
                            <form action="{{route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="productName" class="control-label fw-bold mb-1">Product Name</label>
                                    <input id="cc-pament" name="productName" type="text" class="form-control @error('productName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product Name..." value="{{old('productName')}}">
                                    @error('productName')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                    <label for="categoryId" class="control-label fw-bold mt-3 mb-1">Category</label>
                                        <select name="categoryId" id="" class="form-select @error('categoryId') is-invalid @enderror">
                                            <option value="">Choose Category</option>
                                            @foreach ($categories as $category )
                                                <option value="{{$category->id}}" @if(old('categoryId') == $category->id) selected @endif >{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    @error('categoryId')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                    <label for="productDescription" class="control-label mt-3 fw-bold mb-1">Description</label>
                                    <textarea name="productDescription"  id="" cols="" rows="4" class="form-control @error('productDescription') is-invalid @enderror" placeholder="Enter Product Description...">{{old('productDescription')}}</textarea>
                                    @error('productDescription')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                    <label for="productImage" class="control-label mt-3 fw-bold mb-1">Image</label>
                                    <input type="file" name="productImage" class="form-control @error('productImage') is-invalid @enderror">
                                    @error('productImage')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                    <label for="productWaiting" class="control-label mt-3 fw-bold mb-1">Waiting Time</label>
                                    <input id="cc-pament" name="productWaiting" value="{{old('productWaiting')}}" type="text" class="form-control @error('productWaiting') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product Waiting Time...">
                                    @error('productWaiting')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                    <label for="productPrice" class="control-label mt-3 fw-bold mb-1">Price</label>
                                    <input id="cc-pament" name="productPrice" value="{{old('productPrice')}}" type="number" class="form-control @error('productPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product price...">
                                    @error('productPrice')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-lg w-100 mt-3 btn-info btn-block text-white" style="background-color: #002d72;">
                                        <span id="payment-button-amount">Create</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
