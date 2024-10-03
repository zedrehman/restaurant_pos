@extends('layouts.admin')
@section('dashboard_bar')
Category
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row grid-margin">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/admin/menu-management/add-menu-categories')}}">
                            <i class="fa fa-plus"></i>
                            Add Category
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataArray as $data)
                            <tr>
                                <td> {{ $data->category_name }} </td>
                                <td>
                                    @if ($data->image)
                                    <img src="{{ asset('menu/menu_category/'.$data->image) }}" width="50">
                                    @else
                                    <img src="{{ 'https://ui-avatars.com/api/?name=' }}{{$data->category_name}}" width="50"></th>
                                    @endif
                                </td>
                                <td>
                                    @if($data->active==1)
                                    <div class="badge light badge-success">Active</div>
                                    @else
                                    <div class="badge light badge-warning">Inactive</div>
                                    @endif
                                </td>
                                <td>
                                    <span>
                                        <a class="text-warning mr-4" href="{{ url('/admin/menu-management/edit-menu-categories/'.$data->id) }}"><i class="fa fa-pencil color-muted"></i></a>
                                        <a class="text-danger"><i class="fa fa-close color-danger"></i></a>
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