@extends('layouts.admin')
@section('dashboard_bar')
User Role
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/usersetup/SaveUserRole')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_role_id" value="@if(isset($UserRole)){{ $UserRole->id }}@endif">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="form-group">
                                <label>Role Name <span style="color:red;">*</span></label>
                                <input type="text" name="role_name" class="form-control" placeholder="Role Name" value="@if(isset($UserRole)){{ $UserRole->role_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>&nbsp;</label><br>
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection