@extends('template')
@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-dark float-left">{{ ucwords(strtolower($role->name)) }} Permissions</h4>
            <a href="{{url('roles')}}" class="btn btn-info btn-sm float-right"><i class="fa fa-arrow-left mr-2"></i> Back</a>
        </div>
        <div class="card-body">
            @if(Session::get("message") && Session::get("class"))
                <p class="alert alert-{{Session::get('class')}} text-center">{{ Session::get("message") }}</p>
            @endif
            <form action="{{ url('role/permissions/update') }}" method="POST">
            @csrf
                <div class="row">
                    <table class="table table-bordered">
                        <tr>
                           <th>Module</th> 
                           <th>Create</th> 
                           <th>Read</th> 
                           <th>Update</th> 
                           <th>Delete</th> 
                        </tr>
                        <tr>
                            <td>Roles</td>
                            <td>
                                <input type="checkbox" name="permissions[]" value="role_create" <?=(in_array('role_create', $permissions)) ? 'checked' : '' ?> <?=($role->id == 1) ? 'disabled' : ''?>>
                            </td>
                            <td>
                                <input type="checkbox" name="permissions[]" value="role_read" <?=(in_array('role_read', $permissions)) ? 'checked' : '' ?> <?=($role->id == 1) ? 'disabled' : ''?>>
                            </td>
                            <td>
                                <input type="checkbox" name="permissions[]" value="role_update" <?=(in_array('role_update', $permissions)) ? 'checked' : '' ?> <?=($role->id == 1) ? 'disabled' : ''?>>
                            </td>
                            <td>
                                <input type="checkbox" name="permissions[]" value="role_delete" <?=(in_array('role_delete', $permissions)) ? 'checked' : '' ?> <?=($role->id == 1) ? 'disabled' : ''?>>
                            </td>
                        </tr>
                    </table>
                    <div class="col-md-12">
                        <input type="hidden" name="id" value="{{ $role->id }}">
                        <input type="submit" class="btn btn-primary" value="UPDATE">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection