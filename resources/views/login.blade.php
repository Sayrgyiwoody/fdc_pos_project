@extends('layouts.master')

@section('title','Login Page')

@section('content')
    <div class="login-form">
        <form action="{{route('login')}}" method="post">
            @csrf
            <div class="form-group my-2">
                <label><strong>Email Address</strong></label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{old('email')}}">
            </div>
            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="form-group my-2">
                <label><strong>Password</strong></label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
            </div>
            @error('password')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <button class="btn fw-bold w-100 mt-2" style="background-color: #6dbc45;" type="submit">sign in</button>

        </form>
        <div class="register-link">
            <p>
                Don't you have account?
                <a href="{{route('auth#registerPage')}}">Sign Up Here</a>
            </p>
        </div>
    </div>
@endsection
