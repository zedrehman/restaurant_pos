@extends('layouts.admin')

@section('dashboard_bar')
TAX
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row grid-margin">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/admin/add-tax-configuration')}}">
                            <i class="fa fa-plus"></i>Add Tax
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm" id="dataTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Tax value</th>
                                <th>Tax Display Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($taxConfiguration as $tx)
                            <tr>
                                <td> {{ $tx->tax_name }} </td>
                                <td> {{ $tx->tax_value }}% </td>
                                <td> {{ $tx->tax_display_name }} </td>
                                <td>
                                    @if($tx->active==1)
                                    <div class="badge badge-success badge-pill">Active</div>
                                    @else
                                    <div class="badge badge-warning badge-pill">InActive</div>
                                    @endif
                                </td>
                                <td>
                                    <span>
                                        <a class="text-warning mr-4" href="{{ url('/admin/edit-tax-configuration/'.$tx->id) }}"><i class="fa fa-pencil color-muted"></i></a>
                                        <a class="text-danger" href="{{ url('/admin/delete-tax-configuration/'.$tx->id) }}"><i class="fa fa-close color-danger"></i></a>
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