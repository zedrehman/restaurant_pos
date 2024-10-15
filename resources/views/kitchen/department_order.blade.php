@extends('layouts.admin')
@section('Css')
<link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}?version={{config('constant.script_version')}}" rel="stylesheet" type="text/css" />
@endsection

@section('dashboard_bar')
Departments Order
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body" style="padding: 5px;">
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-sm-3">
                        <select class="form-control" id="ddlOutlet">
                            <option value="0">--Outlet--</option>
                            @foreach ($outlets as $outlet)
                            <option value="{{$outlet->id}}"> {{ $outlet->outlet_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-9">
                        <ul class="nav nav-pills justify-content-end mb-4" id="ulKitchenDepartment"></ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="tab-content">
                            <div id="v-pills-home" class="tab-pane fade active show">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="tblOrderList" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>Date</th>
                                                        <th>Bill No</th>
                                                        <th>TBL No</th>
                                                        <th>Type</th>
                                                        <th>Item Name</th>
                                                        <th>Qty</th>
                                                        <th>Prep Time</th>
                                                        <th>Remain Time</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbodytblOrderList"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<script src="{{ asset('validation/kitchen_department_order.js') }}?version={{config('constant.script_version')}}"></script>
@endsection