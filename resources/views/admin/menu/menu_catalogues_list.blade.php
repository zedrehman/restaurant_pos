@extends('layouts.admin')
@section('dashboard_bar')
Items
@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body" style="padding: 10px;">
                <div class="row grid-margin">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/admin/menu-management/add-menu-catalogues')}}">
                            <i class="fa fa-plus"></i>
                            Add Items
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm" id="dataTable">
                        <thead>
                            <tr>
                                <th>Outlet</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataArray as $data)
                            <tr>
                                <td>
                                    @if($data->getOutlet)
                                    {{ $data->getOutlet->outlet_name }}
                                    @endif
                                </td>
                                <td> {{ $data->menu_name }} </td>
                                <td> {{ $data->short_code }} </td>
                                <td> {{ $data->getMenuCategory->category_name }} </td>
                                <td>
                                    @if ($data->image)
                                    <img src="{{ asset('menu/menu_catalogues/'.$data->image) }}" width="50">
                                    @else
                                    <img src="{{ 'https://ui-avatars.com/api/?name=' }}{{$data->category_name}}" width="50"></th>
                                    @endif
                                </td>
                                <td> {{ $data->sale_price }} </td>
                                <td> {{ $data->current_stock }} </td>
                                <td>
                                    @if($data->active==1)
                                    <div class="badge badge-success badge-pill">Active</div>
                                    @else
                                    <div class="badge badge-warning badge-pill">InActive</div>
                                    @endif
                                </td>
                                <td>
                                    <span>
                                        <a class="text-warning mr-4" href="{{ url('/admin/menu-management/edit-menu-catalogues/'.$data->id) }}"><i class="fa fa-pencil color-muted"></i></a>
                                        <a class="text-danger" href="{{ url('/admin/menu-management/delete-menu-catalogues/'.$data->id) }}"><i class="fa fa-close color-danger"></i></a>
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