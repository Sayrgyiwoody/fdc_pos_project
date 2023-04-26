@extends('user.layout.master')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
    @section('header')
        <h3>Admin Account Information</h3>
    @endsection
    @if (session('updateAccountAlert'))
        <div class="col-5 offset-7">
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-wrench me-2 "></i>{{ session('updateAccountAlert') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2"><strong>Personal Information</strong></h3>
                        </div>
                        <hr>
                        <form action="" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group mt-3">
                                <div class="row ">
                                    <div class="col-lg-6 ">
                                        @if (Auth::user()->image == null && Auth::user()->gender == 'male')
                                            <img class="img-thumbnail" src="{{ asset('images/default_user.png') }}" />
                                        @endif
                                        @if (Auth::user()->image == null && Auth::user()->gender == 'female')
                                            <img class="img-thumbnail"
                                                src="{{ asset('images/default_female_user.png') }}" />
                                        @endif
                                        @if (Auth::user()->image)
                                            <div style="width: 300px; height: 300px; overflow: hidden;">
                                                <img class="img-thumbnail w-100 h-100"
                                                    style="object-fit: cover; object-position:center;"
                                                    src="{{ asset('storage/profileImages/' . Auth::user()->image) }}" />
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 ps-4">
                                        <div class="row mb-2">
                                            <div class="col-lg-1 fs-4 me-3 d-flex px-2">
                                                <label for="control-label" class="text-center my-auto"><i
                                                        class="fa-solid fa-user me-2"></i></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input readonly disabled type="text" name=""
                                                    class="form-control form-control-sm border-0 bg-white"
                                                    value="{{ Auth::user()->name }}" id="">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-lg-1 fs-4 me-3 d-flex px-2">
                                                <label for="role" class="text-center my-auto"><i
                                                        class="fa-solid fa-shield-halved me-2"></i></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" name="role"
                                                    class="form-control form-control-sm border-0 bg-white"
                                                    value="{{ Auth::user()->role }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-lg-1 fs-4 me-3 d-flex px-2">
                                                <label for="role" class="text-center my-auto"><i
                                                        class="fa-solid fa-venus-mars me-1"></i></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" name="role"
                                                    class="form-control form-control-sm border-0 bg-white"
                                                    value="{{ Auth::user()->gender }}" readonly disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-lg-1 fs-4 me-3 d-flex px-2">
                                                <label for="control-label" class="text-center my-auto"><i
                                                        class="fa-solid fa-envelope me-2"></i></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input readonly disabled type="text" name=""
                                                    class="form-control form-control-sm border-0 bg-white"
                                                    value="{{ Auth::user()->email }}" id="">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-lg-1 fs-4 me-3 d-flex px-2">
                                                <label for="control-label" class="text-center my-auto"><i
                                                        class="fa-solid fa-phone me-2"></i></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input readonly disabled type="text" name=""
                                                    class="form-control form-control-sm border-0 bg-white"
                                                    value="{{ Auth::user()->phone }}" id="">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-lg-1 fs-4 me-3 d-flex px-2">
                                                <label for="control-label" class="text-center my-auto"><i
                                                        class="fa-solid fa-calendar me-2"></i></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input readonly disabled type="text" name=""
                                                    class="form-control form-control-sm border-0 bg-white"
                                                    value="{{ Auth::user()->created_at->format('j-F-Y') }}"
                                                    id="">
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-lg-1 fs-4 me-3 px-2">
                                                <label for="control-label" class="text-center my-auto"><i
                                                        class="fa-solid fa-location-dot me-2"></i></label>
                                            </div>
                                            <div class="col-lg-9">
                                                <textarea readonly disabled name="" id="" cols="" rows="2"
                                                    class="form-control form-control-sm border-0 bg-white">{{ Auth::user()->address }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="float-end me-5">
                                <a href="{{ route('user#home') }}" class="btn btn-secondary"><i
                                        class="fa-solid fa-arrow-left me-2"></i>Back</a>
                                <a href="{{ route('user#updateAccountPage') }}" class="btn btn-primary"><i
                                        class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
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
