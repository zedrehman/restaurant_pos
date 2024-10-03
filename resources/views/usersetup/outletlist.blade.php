@extends('layouts.admin')

@section('dashboard_bar')
Outlet List
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body" style="padding: 0px;">
                <div class="row" style="margin: 10px;">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/usersetup/addoutlet')}}">
                            <i class="fa fa-plus"></i>Add Outlet
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Outlet Name</th>
                                <th>Phone</th>
                                <th>Zip Code</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($outlets as $out)
                            <tr>
                                <td> <img src="{{ asset('outlet/'.$out->logo) }}" width="100"></td>
                                <td> {{ $out->outlet_name }} </td>
                                <td> {{ $out->contact_phone }} </td>
                                <td> {{ $out->zip_code }} </td>
                                <td> @if($out->active==1)
                                    <div class="badge light badge-success">Active</div>
                                    @else
                                    <div class="badge light badge-warning">Inactive</div>
                                    @endif
                                </td>
                                <td>
                                    <span>
                                        <a class="text-warning mr-4" href="{{ url('/usersetup/editoutlet/'.$out->id) }}"><i class="fa fa-pencil color-muted"></i></a>
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