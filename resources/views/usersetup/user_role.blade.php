@extends('layouts.admin')

@section('dashboard_bar')
User Role
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body" style="padding: 0px;">
                <div class="row" style="margin: 10px;">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/usersetup/adduserrole/0')}}">
                            <i class="fa fa-plus"></i>Add Outlet
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>No Of Users</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($UserRole as $out)
                            <tr>
                                <td> {{ $out->role_name }} </td>
                                <td> {{ $out->total_users }} </td>
                                <td>
                                    <span>
                                        <a class="text-warning mr-4" href="{{ url('/usersetup/adduserrole/'.$out->id) }}"><i class="fa fa-pencil color-muted"></i></a>
                                        <a class="text-danger" href="{{ url('/usersetup/DeleteUserRole/'.$out->id) }}"><i class="fa fa-close color-danger"></i></a>
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