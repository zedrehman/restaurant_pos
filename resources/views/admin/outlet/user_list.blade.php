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
                                <td> @if($user->active==1)
                                    <div class="badge badge-success badge-pill">Active</div>
                                    @else
                                    <div class="badge badge-warning badge-pill">Inactive</div>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="{{ url('/admin/edit-user/'.$user->id) }}">Edit</a>
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