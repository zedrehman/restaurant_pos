@extends('layouts.admin')

@section('dashboard_bar')
Order List
@endsection

@section('Css')
<link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}?version={{config('constant.script_version')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-sm-5">

        <table class="table border-no order-table dataTablesCard" id="tblOrder">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Bill No</th>
                    <th>TBL No</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($OrderTable as $Item)
                <tr class="trtable" data-id="{{$Item->id}}">
                    <td>{{$Item->id}}</td>
                    <td>{{$Item->kot}}</td>
                    <td>@if($Item->table_id != 0) {{$Item->table_id}} @else - @endif</td>
                    <td>@if(isset($Item->quick_bill_type)) {{$Item->quick_bill_type}} @else {{$Item->bill_type}} @endif</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="col-sm-7">
        <div class="card">
            <div class="card-body" style="padding: 0px 5px 0px 5px;">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table-sm">
                            <thead>
                                <tr>
                                    <th>Item Name </th>
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