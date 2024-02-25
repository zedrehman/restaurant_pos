@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Configuration</li>
        <li class="breadcrumb-item active" aria-current="page">Brand List</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row grid-margin">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/admin/add-brand')}}">
                            <i class="fa fa-plus"></i>
                            Add Brand
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Logo</th>
                                <th>Brand Name</th>
                                <th>Short Name</th>
                                <th>Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $br)
                            <tr>
                                <td>
                                    <a class="btn-sm btn-warning" href="{{ url('/admin/edit-brand/'.$br->id) }}">Edit</a>
                                </td>
                                <td> <img src="{{ asset('brand/'.$br->id.'/'.$br->logo) }}" width="100"> </td>
                                <td> {{ $br->brand_name }} </td>
                                <td> {{ $br->brand_short_name }} </td>
                                <td> @if($br->active==1)
                                    <div class="badge badge-success badge-pill">Active</div>
                                    @else
                                    <div class="badge badge-warning badge-pill">Inactive</div>
                                    @endif
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