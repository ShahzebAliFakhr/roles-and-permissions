@extends('auth.template')
@section('content')
    <h4 class="text-dark text-center mb-4">REGISTER</h4>
    <form class="user" method="POST" action="{{url('register')}}">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Enter Full Name" name="name" value="{{ old('name') }}">
            @if($errors->has('name'))
              @foreach($errors->get('name') as $e)
                  <small class="text-danger">{{ $e }}</small>
              @endforeach
            @endif
        </div>
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Enter Email Address" name="email" value="{{ old('email') }}">
            @if($errors->has('email'))
              @foreach($errors->get('email') as $e)
                  <small class="text-danger">{{ $e }}</small>
              @endforeach
            @endif
        </div>
        <div class="form-group">
            <input type="text" class="phone form-control" placeholder="Enter Mobile Number" name="phone" value="{{ old('phone') }}">
            @if($errors->has('phone'))
              @foreach($errors->get('phone') as $e)
                  <small class="text-danger">{{ $e }}</small>
              @endforeach
            @endif
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Enter Password" name="password" autocomplete="new-password">
            @if($errors->has('password'))
              @foreach($errors->get('password') as $e)
                  <small class="text-danger">{{ $e }}</small>
              @endforeach
            @endif
        </div>
        <div class="form-group">
            <select class="form-control" name="role_id" required>
                @foreach($roles as $r)
                    <option value="{{ $r['id'] }}">{{ $r['name'] }}</option>
                @endforeach
            </select>
        </div>
        <input type="submit" class="btn btn-primary btn-user btn-block" value="Register">
    </form>

    <hr>

    <div class="text-center">
        Or
        <br>
        <a href="{{ route('login') }}" class="text-dark">Already have an account? Login here</a>
    </div>

@endsection