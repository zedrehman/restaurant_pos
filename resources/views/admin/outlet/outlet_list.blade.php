@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Configuration</li>
        <li class="breadcrumb-item active" aria-current="page">Outlet List</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row grid-margin">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/admin/add-outlet')}}">
                            <i class="fa fa-plus"></i>Add Outlet
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Logo</th>
                                <th>Outlet Id</th>
                                <th>Outlet Name</th>
                                <th>Phone</th>
                                <th>Brand Name</th>
                                <th>Active</th>
                                <th>Next Reset Bill Date</th>
                                <th>Registered At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($outlets as $out)
                            <tr>
                                <td>
                                    <a class="btn-sm btn-warning" href="{{ url('/admin/edit-outlet/'.$out->id) }}">Edit</a>
                                </td>
                                <td> <img src="{{ asset('outlet/'.$out->logo) }}" width="100"> </td>
                                <td> {{ $out->id }} </td>
                                <td> {{ $out->outlet_name }} </td>
                                <td> {{ $out->contact_phone }} </td>
                                <td> {{ $out->getBrand->brand_name }} </td>
                                <td> @if($out->active==1)
                                    <div class="badge badge-success badge-pill">Active</div>
                                    @else
                                    <div class="badge badge-warning badge-pill">Inactive</div>
                                    @endif
                                </td>
                                <td> {{ $out->next_reset_bill_date }} </td>
                                <td> {{ $out->created_at }} </td>
                            </tr>
                            next _reset_bill_date
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection