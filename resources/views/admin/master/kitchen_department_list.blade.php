@extends('layouts.admin')

@section('dashboard_bar')
Kitchen Department
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row grid-margin">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/admin/add-kitchen-department')}}">
                            <i class="fa fa-plus"></i>
                            Add Kitchen Department
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Outlet Name</th>
                                <th>Department Name</th>

                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataArray as $array)
                            <tr>
                                <td> {{ $array->outlet_name }} </td>
                                <td> {{ $array->kitchen_department_name }} </td>

                                <td>
                                    @if($array->active==1)
                                    <div class="badge light badge-success">Active</div>
                                    @else
                                    <div class="badge light badge-warning">InActive</div>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn-sm btn-warning" href="{{ url('/admin/edit-kitchen-department/'.$array->id) }}">Edit</a>
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