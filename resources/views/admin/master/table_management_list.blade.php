@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Master Configuration</li>
        <li class="breadcrumb-item active" aria-current="page">Table Management List</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row grid-margin">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/admin/add-table-management')}}">
                            <i class="fa fa-plus"></i>
                            Add Table Management
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>Table name</th>
                                <th>Max person</th>
                                <th>Outlet Department Name</th>
                                <th>Outlet</th> 
                                <th>Activ</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataArray as $array)
                            <tr>
                                <td> {{ $array->table_name }} </td>
                                <td> {{ $array->max_person }} </td>
                                <td> {{ $array->outlet_department_name }} </td>
                                <td> {{ $array->outlet_name }} </td>
                                <td> 
                                    @if($array->active==1)
                                    <div class="badge badge-success badge-pill">Active</div>
                                    @else
                                    <div class="badge badge-warning badge-pill">InActive</div>
                                    @endif</td>
                                <td>
                                    <a class="btn-sm btn-warning" href="{{ url('/admin/edit-table-management/'.$array->id) }}">Edit</a>
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