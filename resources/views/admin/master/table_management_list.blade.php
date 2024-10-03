@extends('layouts.admin')
@section('dashboard_bar')
Table Management
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row grid-margin">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/admin/add-table-management')}}">
                            <i class="fa fa-plus"></i>
                            Add Table
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>Table name</th>
                                <th>Max person</th>
                                <th>Outlet</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataArray as $array)
                            <tr>
                                <td> {{ $array->table_name }} </td>
                                <td> {{ $array->max_person }} </td>
                                <td> {{ $array->outlet_name }} </td>
                                <td>
                                    @if($array->active==1)
                                    <div class="badge badge-success badge-pill">Active</div>
                                    @else
                                    <div class="badge badge-warning badge-pill">InActive</div>
                                    @endif
                                </td>
                                <td>
                                    <span>
                                        <a class="text-warning mr-4" href="{{ url('/admin/edit-table-management/'.$array->id) }}"><i class="fa fa-pencil color-muted"></i></a>
                                        <a class="text-danger" href="{{ url('/admin/delete-table-management/'.$array->id) }}"><i class="fa fa-close color-danger"></i></a>
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