@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Menu Management</li>
        <li class="breadcrumb-item active" aria-current="page">Menu Categories List</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row grid-margin">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/admin/menu-management/add-menu-categories')}}">
                            <i class="fa fa-plus"></i>
                            Add Menu Categories
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image
                                <th>Activ</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataArray as $data)
                            <tr>
                                <td> {{ $data->category_name }} </td>
                                <td> 
                                    @if ($data->image)
                                    <img src="{{ asset('menu/menu_category/'.$data->image) }}" width="100">
                                    @else
                                    <img src="{{ 'https://ui-avatars.com/api/?name=' }}{{$data->category_name}}" width="100"></th>
                                    @endif
                                </td>
                                <td> 
                                    @if($data->active==1)
                                    <div class="badge badge-success badge-pill">Active</div>
                                    @else
                                    <div class="badge badge-warning badge-pill">InActive</div>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn-sm btn-warning" href="{{ url('/admin/menu-management/edit-menu-categories/'.$data->id) }}">Edit</a>
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