@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Master Configuration</li>
        <li class="breadcrumb-item active" aria-current="page">Coupon  List</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row grid-margin">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/admin/add-coupon')}}">
                            <i class="fa fa-plus"></i>
                            Add Coupon
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>Coupon Name</th>
                                <th>Coupon Code</th>
                                <th>Coupon Type</th>
                                <th>amount</th> 
                                <th>max off</th> 
                                <th>end date</th> 
                                <th>Activ</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataArray as $data)
                            <tr>
                                <td> {{ $data->coupon_name }} </td>
                                <td> {{ $data->coupon_code }} </td>
                                <td>
                                    @if($data->coupon_type==1)
                                    <div class="badge badge-success badge-pill">Fixed</div>
                                    @else
                                    <div class="badge badge-warning badge-pill">Percentage</div>
                                    @endif</td>
                                </td>
                                <td> {{ $data->amount }} </td>
                                <td> {{ $data->max_off }} </td>
                                <td> {{ $data->end_date }} </td>
                                <td> 
                                    @if($data->active==1)
                                    <div class="badge badge-success badge-pill">Active</div>
                                    @else
                                    <div class="badge badge-warning badge-pill">InActive</div>
                                    @endif</td>
                                <td>
                                    <a class="btn-sm btn-warning" href="{{ url('/admin/edit-coupon/'.$data->id) }}">Edit</a>
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