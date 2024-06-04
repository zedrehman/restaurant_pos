@extends('layouts.app')
@section('Css')
<style>
    .text-bold {
        font-weight: bold;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-8">
        <div class="row" style="max-height: 205px;overflow: auto;">
            @foreach ($tablesArray as $key => $data)
            <div class="col-sm-2 divTable" style="padding: 0px;" data-id="{{$data->id}}">
                <div class="card text-white align-items-center bg-nifty-primary">
                    <div class="card-body" style="padding: 10px 1.437rem;">
                        <h4 style="margin-bottom: 0px;">{{$data->table_name}}</h4>
                    </div>
                </div>
            </div>
            @endforeach
            <input type="hidden" id="hdnSelectedTable" value="0">
            <!-- <div class="col-sm-2" style="padding: 0px;">
                <div class="card bg-mint text-white align-items-center">
                    <div class="card-body" style="padding: 10px 1.437rem;">
                        <h4 style="margin-bottom: 0px;">AC 6</h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-2" style="padding: 0px;">
                <div class="card bg-success text-white align-items-center">
                    <div class="card-body" style="padding: 10px 1.437rem;">
                        <h4 style="margin-bottom: 0px;">AC 6</h4>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-sm-12" style="padding-left: 0px;">
                <a class="btn btn-sm btn-dark" style="width: 120px;">Filter Tables</a>
                <a class="btn btn-sm btn-dark" style="width: 120px;">Change Table</a>
                <a class="btn btn-sm btn-dark" style="width: 120px;">Add Customer</a>
                <a class="btn btn-sm btn-dark" style="width: 120px;" id="btnRefresh">Refresh</a>
                <a class="btn btn-sm btn-dark" style="width: 120px;" id="btnLoadMenu">Load Menu</a>
                <a class="btn btn-sm btn-success" style="width: 140px;"><i class="ti-info-alt"></i> Serving Table</a>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-sm-12" style="padding: 0px;">
                <div class="row">
                    <div class="col-sm-4" style="padding: 0px;">
                        <div style="max-height: calc(100vh - 225px);overflow-y: auto;overflow-x:hidden;">
                            <ul class="list-group" id="ulMenuCategory">
                                @foreach ($MenuCategory as $Item)
                                <li class="list-group-item d-flex justify-content-between align-items-center listMenuCategory" data-id="{{$Item->id}}">
                                    {{$Item->category_name}}
                                    <span class="badge bg-nifty-primary rounded-pill">0</span>
                                </li>
                                @endforeach
                            </ul>
                            <input type="hidden" id="hdnSelectedCategory" value="0">
                        </div>
                    </div>
                    <div class="col-sm-8" style="padding-left: 0px;">
                        <div style="max-height: calc(100vh - 225px);overflow-y: auto;overflow-x:hidden;">
                            <div class="row" id="divMenuList"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-sm-4" style="padding-right: 0px;padding-left: 5px;">
        <div class="card">
            <div class="card-body" style="padding:0px 15px 0px 15px;">
                <div class="row">
                    <div class="col-sm-12" style="text-align: center;">
                        <a type="button" class="btn btn-sm btn-outline-success" id="btnDineIn">Dine In</a>
                        <a type="button" class="btn btn-sm btn-outline-dark" id="btnPickUpDelivery">Pick Up / Delivery</a>
                        <a type="button" class="btn btn-sm btn-outline-dark" id="btnQuickBill">Quick Bill</a>
                        <input type="hidden" id="hdnSelectedOrderType" value="Dine In">
                    </div>
                </div>
                <div class="row" id="divDineIn">
                    <div class="col-sm-12" style="text-align: center;">
                        <div style="text-align: center;border-bottom: 1px solid #e2e2e2;margin: 5px 0px 5px 0px;"></div>
                        <a type="button" class="btn btn-sm btn-outline-success">Order / KOT</a>
                        <a type="button" class="btn btn-sm btn-outline-dark">Billing</a>
                    </div>
                    <div class="col-sm-12 bg-success" style="margin-top: 5px;">
                        <label style="margin-top: 5px;">KOT 1</label>
                        <button type="button" class="btn btn-sm btn-outline-dark" style="float: right;">Remote KOT</button>
                    </div>
                </div>
                <div class="row" id="divPickUpDevelivery">
                    <div class="col-sm-12" style="text-align: center;">
                        <div style="text-align: center;border-bottom: 1px solid #e2e2e2;margin: 5px 0px 5px 0px;"></div>
                        <a type="button" class="btn btn-sm btn-outline-success">Order / KOT</a>
                        <a type="button" class="btn btn-sm btn-outline-success">Billing</a>
                        <input type="checkbox">Pick Up
                        <a type="button" class="btn btn-sm btn-dark">New Order</a>
                    </div>
                </div>
                <div class="row" id="divQuickBill">
                    <div class="col-sm-12" style="text-align: center;">
                        <div style="text-align: center;border-bottom: 1px solid #e2e2e2;margin: 5px 0px 5px 0px;"></div>
                        <input type="checkbox"> KOT <input type="checkbox"> Bill No <input type="checkbox"> eBill <b>No:1</b>
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
</script>
<script src="{{ asset('validation/order_table.js') }}?version={{config('constant.script_version')}}"></script>
@endsection