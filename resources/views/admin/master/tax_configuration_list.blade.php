@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Master Configuration</li>
        <li class="breadcrumb-item active" aria-current="page">Tax Configuration  List</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row grid-margin">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/admin/add-tax-configuration')}}">
                            <i class="fa fa-plus"></i>
                            Add Tax Configuration
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Tax value</th>
                                <th>Tax Display Name</th>
                                <th>Product Group Name</th> 
                                <th>Activ</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($taxConfiguration as $tx)
                            <tr>
                                <td> {{ $tx->tax_name }} </td>
                                <td> {{ $tx->tax_value }} </td>
                                <td> {{ $tx->tax_display_name }} </td>
                                <td> {{ $tx->product_group_name }} </td>
                                <td> 
                                    @if($tx->active==1)
                                    <div class="badge badge-success badge-pill">Active</div>
                                    @else
                                    <div class="badge badge-warning badge-pill">InActive</div>
                                    @endif</td>
                                <td>
                                    <a class="btn-sm btn-warning" href="{{ url('/admin/edit-tax-configuration/'.$tx->id) }}">Edit</a>
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