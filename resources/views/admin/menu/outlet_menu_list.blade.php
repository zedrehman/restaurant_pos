@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Menu Management</li>
        <li class="breadcrumb-item active" aria-current="page">Outlet Menu List</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row grid-margin">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/admin/menu-management/add-outlet-menu')}}">
                            <i class="fa fa-plus"></i>
                            Add Menu Categories
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>Menu Name</th>
                                <th>Outlet name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataArray as $data)
                            <tr>
                                <td> {{ $data->menu_name }} </td>
                                <td> {{ $data->getOutlet->outlet_name }} </td>
                                <td>
                                    <a class="btn-sm btn-warning" href="{{ url('/admin/menu-management/add-item/'.$data->id) }}">Add Item</a>
                                    <a class="btn-sm btn-warning" href="{{ url('/admin/menu-management/edit-outlet-menu/'.$data->id) }}">Edit</a>
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