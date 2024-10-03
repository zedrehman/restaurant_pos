@extends('layouts.admin')
@section('dashboard_bar')
SMS Master
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body" style="padding: 5px;">
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-sm-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/appsetting/addsms')}}" style="margin-right: 10px;">
                            <i class="fa fa-plus"></i>Add SMS
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Outlet Name</th>
                                <th>API</th>
                                <th>Sender Id</th>
                                <th>Template Id</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($SMSList as $Items)
                            <tr>
                                <td> {{ $Items->outlet_name }} </td>
                                <td> {{ $Items->api }} </td>
                                <td> {{ $Items->sender_id }} </td>
                                <td> {{ $Items->template_id }} </td>
                                <td>
                                    <span>
                                        <a class="text-warning mr-4" href="{{ url('/appsetting/editsms/'.$Items->id) }}"><i class="fa fa-pencil color-muted"></i></a>
                                        <a class="text-danger" href="{{ url('/appsetting/deletesms/'.$Items->id) }}"><i class="fa fa-close color-danger"></i></a>
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