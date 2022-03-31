@extends('template')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-dark float-left">Roles</h4>
            <a href="javascript:void(0)" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#AddRoleBox"><i class="fa fa-plus mr-2"></i> Add</a>
        </div>
        <div class="card-body">
            @if(Session::get("message") && Session::get("class"))
                <p class="alert alert-{{Session::get('class')}} text-center">{{ Session::get("message") }}</p>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    	@forelse($roles as $r)
                    	<tr>
                            <td>{{ $r['name'] }}</td>
                            <td>{!!($r['status'] == 'Y') ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Deactivated</span>'!!}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="editRole('{{ $r['name'] }}', '{{ $r['status'] }}', {{ $r['id'] }})" class="btn btn-info btn-sm mr-1">EDIT</a>
                                <a href="javascript:void(0)" onclick="deleteConfirmation('{{ url('role/delete/'.$r['id']) }}')" class="btn btn-danger btn-sm mr-1">DELETE</a>
                                <a href="{{ url('role/permissions/'.$r['id']) }}" class="btn btn-success btn-sm mr-1">PERMISSIONS</a>
                            </td>
                        </tr>
                    	@empty
                    	<tr><td colspan="3">No Record Found!</td></tr>
                    	@endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Role -->
<div class="modal fade" id="AddRoleBox" tabindex="-1" role="dialog" aria-labelledby="AddRoleLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ url('role/save') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="AddRoleLabel">Add Role</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Role Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Y">Yes</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="SAVE" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Role -->
<div class="modal fade" id="EditRoleBox" tabindex="-1" role="dialog" aria-labelledby="EditRoleLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ url('role/update') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="EditRoleLabel">Edit Role</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Role Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ old('name') }}" id="edit_name">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" id="edit_status">
                            <option value="Y">Yes</option>
                            <option value="N">No</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_id" name="id">
                    <input type="submit" value="UPDATE" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script type="text/javascript">
    function editRole(name, status, id){
        $('#edit_name').val(name);
        $('#edit_status').val(status);
        $('#edit_id').val(id);
        $('#EditRoleBox').modal('show');
    }
</script>
@endsection