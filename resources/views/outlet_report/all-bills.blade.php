@extends('layouts.app')
<style>
    .table td {
        padding: 0.5rem 0.5rem !important;
    }

    .table th {
        padding: 0.5rem 0.5rem !important;
    }
</style>

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <a class="btn btn-sm btn-dark" style="width: 120px;">All Bills</a>
                <a class="btn btn-sm btn-dark" style="width: 120px;">Today's Bills</a>
            </div>
            <div class="col-sm-4">

            </div>
            <div class="col-sm-4">

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div style="max-height: calc(100vh - 350px);overflow-y: auto;overflow-x:hidden;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order Id</th>
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
    var outlet_id = "{{$outlet_id}}";
</script>
<script src="{{ asset('validation/all_bills.js') }}?version={{config('constant.script_version')}}"></script>
@endsection