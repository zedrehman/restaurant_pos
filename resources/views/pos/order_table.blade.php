@extends('layouts.app')
@section('Css')
<style>
    .text-bold {
        font-weight: bold;
    }

    .table-sm th,
    .table-sm td {
        padding: 3px;
    }

    .table-sm td input {
        height: 25px;
    }

    .payment-mode {
        display: inline-block;
        padding: 10px;
        text-decoration: none;
        cursor: pointer;
    }

    .payment-border {
        border: 2px solid red;
    }

    #ulMenuCategory li {
        cursor: pointer;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-8">
        <div class="row" style="max-height: 205px;overflow: auto;" id="divTableList">
            @foreach ($tablesArray as $key => $data)
            <?php
            $bg = 'bg-nifty-primary';
            if ($data->selectedTableId != 0) {
                $bg = 'bg-info';
            }
            if ($data->SavedTableId != 0) {
                $bg = 'bg-dark';
            }
            ?>
            <div class="col-sm-2 divTable" style="padding: 0px;" data-id="{{$data->id}}" data-tableId="{{$data->selectedTableId}}">
                <div class="card text-white align-items-center {{$bg}}" id="divtbl_{{$data->id}}">
                    <div class="card-body" style="padding: 10px 1.437rem;">
                        <h4 style="margin-bottom: 0px;">{{$data->table_name}}</h4>
                        @if($data->SavedTableId != 0)
                        <i class="table-amount">Rs: {{$data->SavedTableId}}</i>
                        @else
                        <i class="table-amount">&nbsp;</i>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            <input type="hidden" id="hdnSelectedTable" value="0">
        </div>
        <div class="row" style="max-height: 205px;overflow: auto;display: none;" id="divPDOrderList">
            @foreach ($PD_KOTArray as $key => $pd_data)
            <?php
            $bg = 'bg-info';
            if ($pd_data->is_bill_saved != 0) {
                $bg = 'bg-dark';
            }
            ?>
            <div class="col-sm-2 divPDTable" style="padding: 0px;" data-id="{{$pd_data->id}}" data-tableId="{{$pd_data->kot}}">
                <div class="card text-white align-items-center {{$bg}}" id="divPDtbl_{{$pd_data->id}}">
                    <div class="card-body" style="padding: 10px 1.437rem;">
                        <h4 style="margin-bottom: 0px;">PD-KOT-{{$pd_data->kot}}</h4>
                        <i class="table-amount">Rs: {{$pd_data->total_bill_amount}}</i>
                    </div>
                </div>
            </div>
            @endforeach
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
            <input type="hidden" id="hdnOrderId" value="0">
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
                        <a type="button" class="btn btn-sm btn-outline-success" id="btnOrder_KOT">Order / KOT</a>
                        <a type="button" class="btn btn-sm btn-outline-dark" id="btnBilling">Billing</a>
                        <a type="button" class="btn btn-sm btn-dark" id="btnPickUpDelivery_NewBill" style="float: right;display: none;">New Bill</a>
                    </div>
                    <div class="col-sm-12 bg-success" style="margin-top: 5px;">
                        <label style="margin-top: 5px;font-weight: bold;" id="lblKOTtableNo"></label>
                        <label style="margin-top: 5px;font-weight: bold;float: right;">KOT - <span id="lblKOTNumber">0</span> </label>
                        <button type="button" class="btn btn-sm btn-outline-dark" style="float: right;display: none;">Remote KOT</button>
                    </div>
                </div>
                <div class="row" id="divOrder_KOT">
                    <div class="col-sm-12">
                        <div style="height: calc(100vh - 280px);overflow-y: auto;overflow-x:hidden;">
                            <table style="width: 100%;" class="table table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 60%;">Item Name</th>
                                        <th style="text-align: right;width: 20%;">Qty</th>
                                        <th style="text-align: right;width: 20%;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyKOTMenuBill"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-4" style="padding: 0;">
                                <input type="text" id="txtCustomerName" value="" placeholder="Customer Name" class="form-control">
                            </div>
                            <div class="col-sm-4" style="padding: 0;">
                                <input type="text" id="txtMobileNo" value="" placeholder="Mobile No" class="form-control">
                            </div>
                            <div class="col-sm-4" style="padding: 0;">
                                <input type="text" id="txtAddress" value="" placeholder="Address" class="form-control">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 3px;">
                            <div class="col-sm-4" style="padding: 0;">
                                <input type="text" id="txtKotNote" value="" placeholder="KOT Note" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 bg-success" style="color: #fff;padding: 5px;margin-top: 1px;">
                        Total: <span id="lblTotalKOTBillAmount" style="float: right;margin-right: 10px;">0</span>
                    </div>
                    <div class="col-sm-12" style="margin-top: 5px;text-align: center;">
                        <a class="btn btn-sm btn-dark" id="btnSavePrintKOT">Save & Print KOT</a>
                    </div>
                </div>
                <div class="row" id="divBilling" style="display: none;">
                    <div class="col-sm-12">
                        <div style="height: calc(100vh - 270px);overflow-y: auto;overflow-x:hidden;">
                            <table style="width: 100%;" class="table table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 60%;">Item Name</th>
                                        <th style="text-align: right;width: 10%;">Qty</th>
                                        <th style="text-align: right;width: 30%;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyBillingMenu"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12 bg-success" style="color: #fff;padding: 5px;">
                        Total: <span id="lblTotalBillAmount" style="float: right;margin-right: 10px;">0</span>
                    </div>
                    <div class="col-sm-12" style="margin-top: 5px;text-align: center;">
                        <a class="btn btn-sm btn-dark" id="btnSavePrintBill">Save & Print Bill</a>
                        <a class="btn btn-sm btn-dark" id="btnPayment">Payment</a>
                        <a class="btn btn-sm btn-dark" id="btnSettleBill">Settle Bill</a>
                    </div>
                </div>
                <div class="row" id="divQuickBill" style="display: none;">
                    <div class="col-sm-12" style="text-align: center;">
                        <div style="text-align: center;border-bottom: 1px solid #e2e2e2;margin: 5px 0px 5px 0px;"></div>
                        <!--<input type="checkbox"> KOT <input type="checkbox"> Bill No-->
                    </div>
                    <div class="col-sm-12">
                        <div style="height: calc(100vh - 240px);overflow-y: auto;overflow-x:hidden;">
                            <table style="width: 100%;" class="table table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 60%;">Item Name</th>
                                        <th style="text-align: right;width: 20%;">Qty</th>
                                        <th style="text-align: right;width: 20%;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyQuickBill"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-4" style="padding: 0;">
                                <input type="text" id="txtQuickCustomerName" value="" placeholder="Customer Name" class="form-control">
                            </div>
                            <div class="col-sm-4" style="padding: 0;">
                                <input type="text" id="txtQuickMobileNo" value="" placeholder="Mobile No" class="form-control">
                            </div>
                            <div class="col-sm-4" style="padding: 0;">
                                <input type="text" id="txtQuickAddress" value="" placeholder="Address" class="form-control">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 3px;">
                            <div class="col-sm-4" style="padding: 0;">
                                <input type="text" id="txtQuickKotNote" value="" placeholder="KOT Note" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 bg-success" style="color: #fff;padding: 5px;margin-top: 1px;">
                        Total: <span id="lblQuickTotalBillAmount" style="float: right;margin-right: 10px;">0</span>
                    </div>
                    <div class="col-sm-12" style="margin-top: 5px;text-align: center;">
                        <a class="btn btn-sm btn-dark" id="btnQuickBillPayment">Payment</a>
                        <a class="btn btn-sm btn-dark" id="btnQuickBillSettleBill">Settle Bill</a>
                        <input type="hidden" id="hdnQuickBillType" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal right animated fadeInRight" id="divChannelListToLabModel" role="dialog" aria-labelledby="Channel List">
    <div class="modal-dialog modal-lg" role="document" style="width:100%;max-width:1000px;">
        <div class="modal-content" style="background: #ecf0f5">
            <div class="modal-header" style="padding: 15px;">
                <h4 class="modal-title">Choose Payment Mode</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3" style="text-align: center;">
                        <a class="payment-mode" id="btnPaytm" data-value="Paytm">
                            <img src="{{ asset('img') }}/paytm.jpg" alt="" style="width: 80px;">
                            <br>
                            <b>Paytm</b>
                        </a>
                    </div>
                    <div class="col-sm-3" style="text-align: center;">
                        <a class="payment-mode" id="btnGooglePay" data-value="Google Pay">
                            <img src="{{ asset('img') }}/google-pay-logo.png" alt="" style="width: 150px;height: 60px;"><br>
                            <b>Google Pay</b>
                        </a>
                    </div>
                    <div class="col-sm-3" style="text-align: center;">
                        <a class="payment-mode" id="btnCard" data-value="Card">
                            <img src="{{ asset('img') }}/card-transparent.png" alt="" style="width: 120px;"><br>
                            <b>Card</b>
                        </a>
                    </div>
                    <div class="col-sm-3" style="text-align: center;">
                        <a class="payment-mode" id="btnCash" data-value="Cash">
                            <img src="{{ asset('img') }}/cash-logo.png" alt="" style="width: 100px;"><br>
                            <b>Cash</b>
                        </a>
                    </div>
                    <input type="hidden" id="hdnPaymentMode" value="">
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-sm-12" style="text-align: center;" id="divGrandTotal"></div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-sm-12" style="text-align: right;">
                        <a type="button" class="btn btn-sm btn-dark" id="btnSavePaymentAndSettleBill">Save Payment And Settle Bill</a>
                        <a type="button" class="btn btn-sm btn-dark" id="btnCloseModel">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal right animated fadeInRight" id="divQuickBillTypeModel" role="dialog" aria-labelledby="Choose Order Type">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background: #ecf0f5">
            <div class="modal-header" style="padding: 15px;">
                <h4 class="modal-title">Choose Order Type</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4" style="text-align: center;">
                        <a class="btn btn-md btn-primary btnQuickBillType" id="btnPaytm" data-value="Dine In">Dine In</a>
                    </div>
                    <div class="col-sm-4" style="text-align: center;">
                        <a class="btn btn-md btn-primary btnQuickBillType" id="btnGooglePay" data-value="Takeaway">Take Away</a>
                    </div>
                    <div class="col-sm-4" style="text-align: center;">
                        <a class="btn btn-md btn-primary btnQuickBillType" id="btnCard" data-value="Delivery">Delivery</a>
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
    var outlet_id = "{{$outlet_id}}";
</script>
<script src="{{ asset('validation/order_table.js') }}?version={{config('constant.script_version')}}"></script>
@endsection