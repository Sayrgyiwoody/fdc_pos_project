@extends('admin.layouts.master')

@section('title','Product Edit Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <!-- HEADER DESKTOP-->
        @section('header')
        <h4>Admin Product Edit Page</h4>
        @endsection
        <!-- HEADER DESKTOP-->
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3"><i class="fa-solid fa-table-list me-2"></i>List</button></a>
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2 fw-bold">Edit Product Information</h3>
                            </div>
                            <hr>
                            <form action="{{route('product#edit',$product->id)}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mx-auto" style="width:300px;height:300px;overflow:hidden;box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;">
                                            <img src="{{asset('storage/productImages/'.$product->image)}}" class="img-thumbnail w-100 h-100" style="object-fit:cover;object-position:center;" >
                                            </div>
                                            <label for="productImage" class="control-label mt-3 fw-bold mb-3">Product Image :</label>
                                            <input type="file" name="productImage" class="form-control @error('productImage') is-invalid @enderror">
                                            @error('productImage')
                                                <span class="invalid-feedback">{{$message}}</span>
                                            @enderror
                                            <div class="row">
                                                <div class="mt-4">
                                                    <button type="submit" class="btn text-white w-100" style="background-color: #002d72;">
                                                        <i class="fa-solid fa-upload me-2"></i>
                                                        <span id="payment-button-amount">Update</span>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-6 border-start border-secondary border-3">
                                            <label for="productName" class="control-label fw-bold mb-1">Product Name</label>
                                            <input id="cc-pament" name="productName" type="text" class="form-control @error('productName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product Name..." value="{{old('productName',$product->name)}}">
                                            @error('productName')
                                                <span class="invalid-feedback">{{$message}}</span>
                                            @enderror
                                            <label for="categoryId" class="control-label fw-bold mt-3 mb-1">Category</label>
                                                <select name="categoryId" id="" class="form-select @error('categoryId') is-invalid @enderror">
                                                    <option value="" selected >Choose Category</option>
                                                    @foreach ($categories as $category )
                                                        <option value="{{$category->id}}" @if($old_category_id == $category->id || old('categoryId') == $category->id) selected @endif>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            @error('categoryId')
                                                <span class="invalid-feedback">{{$message}}</span>
                                            @enderror
                                            <label for="productDescription" class="control-label mt-3 fw-bold mb-1">Description</label>
                                            <textarea name="productDescription"  id="" cols="" rows="4" class="form-control @error('productDescription') is-invalid @enderror" placeholder="Enter Product Description...">{{old('productDescription',$product->description)}}</textarea>
                                            @error('productDescription')
                                                <span class="invalid-feedback">{{$message}}</span>
                                            @enderror
                                            <label for="productWaiting" class="control-label mt-3 fw-bold mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="productWaiting" value="{{old('productWaiting',$product->waiting_time)}}" type="text" class="form-control @error('productWaiting') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product Waiting Time...">
                                            @error('productWaiting')
                                                <span class="invalid-feedback">{{$message}}</span>
                                            @enderror
                                            <label for="productPrice" class="control-label mt-3 fw-bold mb-1">Price</label>
                                            <input id="cc-pament" name="productPrice" value="{{old('productPrice',$product->price)}}" type="number" class="form-control @error('productPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product price...">
                                            @error('productPrice')
                                                <span class="invalid-feedback">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
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
