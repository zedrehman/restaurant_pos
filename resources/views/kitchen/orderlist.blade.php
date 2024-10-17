@extends('layouts.admin')

@section('dashboard_bar')
Order List
@endsection

@section('Css')
<link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}?version={{config('constant.script_version')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row" style="margin-bottom: 10px;">
    <div class="col-sm-4">
        <select class="form-control" id="ddlOutlet">
            <option value="0">--Outlet--</option>
            @foreach ($outlets as $outlet)
            <option value="{{$outlet->id}}"> {{ $outlet->outlet_name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="col-sm-5">
        <table class="table border-no order-table dataTablesCard" id="tblOrder">
            <thead>
                <tr>
                    <th>#</th>
                    <th>KOT</th>
                    <th>TBL No</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody id="tbodytblOrderList"></tbody>
        </table>
    </div>
    <div class="col-sm-7" style="padding-left: 0px;display: none;" id="divBillItems">
        <div class="card">
            <div class="card-body" style="padding: 0px 5px 0px 5px;">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table-sm" id="tblBillingMenu" style="width: 100%;" data-id="">
                            <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Qty</th>
                                    <th>Department</th>
                                    <th>Prep Time</th>
                                    <th>Remain Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyBillingMenu"></tbody>
                        </table>
                    </div>

                </div>
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
<script src="{{ asset('validation/kitchen_order_list.js') }}?version={{config('constant.script_version')}}"></script>
@endsection