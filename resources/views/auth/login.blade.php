@extends('auth.template')
@section('content')
    <h4 class="text-dark text-center mb-4">LOGIN</h4>
    <form class="user" method="POST" action="{{url('login')}}">
        @csrf
        <div class="form-group">
            <input type="text" class="phone form-control form-control-user" placeholder="Enter Mobile Number" name="phone" value="{{ old('phone') }}">
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user" placeholder="Enter Password" name="password">
        </div>
        <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">
    </form>

    <hr>

    <div class="text-center">
        Or
        <br>
        <a href="{{ url('register') }}" class="text-dark">Register your Account?</a>
        <!-- <a href="{{ url('#') }}" class="text-dark">Forget Password?</a> -->
    </div>

@endsection