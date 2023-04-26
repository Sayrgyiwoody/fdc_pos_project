@extends('layouts.master')

@section('title','Register Page')

@section('content')
    <div class="login-form">
        <form action="{{route('register')}}" method="post">
            @csrf
            <div clamy-2 ss="form-group">
                <label><strong>Name</strong></label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Name" value="{{old('name')}}">
            </div>
            @error('name')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <div class="my-2 form-group">
                <label><strong>Email Address</strong></label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{old('email')}}">
            </div>
            @error('email')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <div class="form-group">
                <label><strong>Gender</strong></label>
                <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                    <option value="">Choose gender</option>
                    <option value="male" {{old('gender') == 'male' ? 'selected' : ' ';}}>male</option>
                    <option value="female" {{old('gender') == 'female' ? 'selected' : ' ';}}>female</option>
                </select>
            </div>
            @error('gender')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <div class="my-2 form-group">
                <label><strong>Phone Number</strong></label>
                <input class="form-control @error('phone') is-invalid @enderror" type="number" name="phone" placeholder="Phone Number" value="{{old('phone')}}">
            </div>
            @error('phone')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <div class="my-2 form-group">
                <label><strong>Address</strong></label>
                <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" placeholder="Address" value="{{old('address')}}">
            </div>
            @error('address')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <div class="my-2 form-group">
                <label><strong>Password</strong></label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" >
            </div>
            @error('password')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <div class="my-2 form-group">
                <label><strong>Confirm Password</strong></label>
                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Confirm Password">
            </div>
            @error('password_confirmation')
                <small class="text-danger">{{$message}}</small>
            @enderror

            <button class="btn w-100 mt-2 fw-bold" style="background-color: #6dbc45;" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{route('auth#loginPage')}}">Sign In</a>
            </p>
        </div>
    </div>
    @endsection
