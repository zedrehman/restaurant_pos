@extends('layouts.admin')

@section('dashboard_bar')
Overall Reports
@endsection

@section('Css')
<link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}?version={{config('constant.script_version')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="d-sm-flex mb-lg-4 mb-2">
    <div class="dropdown mb-2 ml-auto mr-3">
        <a href="javascript:void(0)" class="btn btn-primary btn-rounded light" data-toggle="dropdown"
            aria-expanded="false">
            <i class="las la-bolt scale5 mr-3"></i>
            All Status
            <i class="las la-angle-down ml-3"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-center">
            <a class="dropdown-item" href="javascript:void(0);"><span class="text-primary">On Delivery</span></a>
            <a class="dropdown-item" href="javascript:void(0);"><span class="text-primary">New Order</span></a>
            <a class="dropdown-item" href="javascript:void(0);"><span class="text-success">Delivery</span></a>
        </div>
    </div>
    <input class="d-inline-block form-control date-button btn btn-primary light btn-rounded" id="timepicker"
        placeholder="Today">
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive rounded card-table">
            <table class="table border-no order-table mb-4 table-responsive-lg dataTablesCard" id="tblOrder">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order Id</th>
                        <th>Date</th>
                        <th>Bill No</th>
                        <th>Table NO</th>
                        <th>Type</th>
                        <th>Customer</th>
                        <th>D. Boy</th>
                        <th>Payment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $intRow = 1;
                    ?>
                    @foreach ($OrderTable as $Item)
                    <tr class="trtable" data-id="{{$Item->id}}">
                        <td>{{$intRow}}</td>
                        <td>{{$Item->id}}</td>
                        <td>{{$Item->created_at}}</td>
                        <td>{{$Item->kot}}</td>
                        <td>@if($Item->table_id != 0) {{$Item->table_id}} @else - @endif</td>
                        <td>{{$Item->bill_type}} @if(isset($Item->quick_bill_type)) - {{$Item->quick_bill_type}} @endif</td>
                        <td></td>
                        <td></td>
                        <td>{{$Item->payment_mode}}</td>
                    </tr>
                    <?php
                    $intRow++;
                    ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item Name </th>
                            <th>Oty</th>
                            <th>Price</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-sm-6">
                <h4>Bill Details</h4>
            </div>
        </div>
    </div>
</div>
@endsection
@section('JsScript')
<script>
    var baseUrl = "{{url('/')}}";
    var _token = "{{ csrf_token() }}";
</script>

<script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}?version={{config('constant.script_version')}}" type="text/javascript"></script>
<script src="{{ asset('validation/over_all_reports.js') }}?version={{config('constant.script_version')}}"></script>
@endsection