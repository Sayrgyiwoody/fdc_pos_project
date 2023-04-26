@extends('user.layout.master')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        @section('header')
        <h3>Admin Account Change Password</h3>
        @endsection
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2"><strong>Change Account Password</strong></h3>
                            </div>
                            <hr>
                            <form action="{{route('user#passwordChange')}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="oldPassword" class="control-label mb-1"><strong>Old Password</strong></label>
                                    <input id="cc-pament" name="oldPassword" type="password" class="form-control @if (session('changePasswordFail')) is-invalid @endif @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Old Password">
                                    @error('oldPassword')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                    @if (session('changePasswordFail'))
                                        <span class="invalid-feedback">{{session('changePasswordFail')}}</span>
                                    @endif
                                    <label for="newPassword" class="control-label mb-1 mt-3"><strong>New Password</strong></label>
                                    <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                    @error('newPassword')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                    <label for="confirmPassword" class="control-label mb-1 mt-3"><strong>Confirm Password</strong></label>
                                    <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password">
                                    @error('confirmPassword')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-block text-white bg-dark">
                                        <i class="fas fa-key me-2"></i>
                                        <span id="payment-button-amount">Change Password</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
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
