@extends('template')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-dark float-left">Edit Profile</h4>
        </div>
        <div class="card-body">
            @if(Session::get("message") && Session::get("class"))
                <p class="alert alert-{{Session::get('class')}} text-center">{{ Session::get("message") }}</p>
            @endif
            <form method="POST" action="{{ url('profile/update') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Name</label>
                            <div class="col-md-8">
                                <input type="text" name="name" value="{{ $profile->name }}" class="form-control" placeholder="Enter Name" required>
                                @if($errors->has('name'))
                                  @foreach($errors->get('name') as $e)
                                      <small class="text-danger">{{ $e }}</small>
                                  @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Email</label>
                            <div class="col-md-8">
                                <input type="text" value="{{ $profile->email }}" name="email" class="form-control" placeholder="Enter Email" <?=($profile->email) ? 'readonly' : ''?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Phone</label>
                            <div class="col-md-8">
                                <input type="text" value="{{ $profile->phone }}" class="phone form-control" placeholder="Enter Mobile" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Password</label>
                            <div class="col-md-8">
                                <input type="password" name="password" class="form-control" placeholder="Enter Password" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Roles</label>
                            <div class="col-md-8">
                                <select class="form-control" name="role_id" required>
                                @foreach($roles as $r)
                                    <option <?=($r['id'] == $profile->role_id) ? 'selected' : '' ?> value="{{ $r['id'] }}">{{ $r['name'] }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Picture</label>
                            <div class="col-md-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image" accept="image/png,image/jpeg,image/jpg" onchange="imageChanged('#image')">
                                    <input type="hidden" name="image_old" value="{{ $profile->image}}">
                                    <label class="custom-file-label" id="image_label" for="image">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-flex align-items-bottom">
                        @if(file_exists(public_path($profile->image)) && $profile->image != NULL)
                            <img src="{{ asset($profile->image) }}" class="img-fluid rounded mb-3">
                        @else
                            <img src="{{ asset('uploads/user-photos/default.jpg') }}" class="img-fluid rounded mb-3">
                        @endif
                    </div>
                    <div class="col-md-12">
                        <input type="submit" value="UPDATE" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection