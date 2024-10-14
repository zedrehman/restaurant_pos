@extends('layouts.admin')
@section('dashboard_bar')
User List
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row grid-margin">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/admin/add-user')}}">
                            <i class="fa fa-plus"></i>Add User
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>Outlet Name</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td> {{ $user->getOutlet->outlet_name }} </td>
                                <td> {{ $user->name }} </td>
                                <td> {{ $user->email }} </td>
                                <td> {{ $user->phone_no }} </td>
                                <td> {{ $user->getRole->role_name }} </td>
                                <td> @if($user->active==1)
                                    <div class="badge light badge-success">Active</div>
                                    @else
                                    <div class="badge light badge-warning">Inactive</div>
                                    @endif
                                </td>
                                <td>
                                    <span>
                                        <a class="text-warning mr-4" href="{{ url('/admin/edit-user/'.$user->id) }}"><i class="fa fa-pencil color-muted"></i></a>
                                        <a class="text-danger" href="{{ url('/admin/DeleteUser/'.$user->id) }}"><i class="fa fa-close color-danger"></i></a>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection