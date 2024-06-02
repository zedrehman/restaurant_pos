@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-8">
        <div class="row" style="max-height: 205px;overflow: auto;">
            @foreach ($tablesArray as $key => $data)
            <div class="col-sm-2" style="padding: 0px;">
                <div class="card text-white align-items-center
                    @if ($key%2==0)
                        bg-nifty-primary
                    @else
                        bg-success
                    @endif 
                ">
                    <div class="card-body" style="padding: 10px 1.437rem;">
                        <h4 style="margin-bottom: 0px;">{{$data->table_name}}</h4>
                    </div>
                </div>
            </div>
            @endforeach
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
                <a class="btn btn-sm btn-dark" style="width: 120px;">Refresh</a>
                <a class="btn btn-sm btn-dark" style="width: 120px;">Load Menu</a>
                <a class="btn btn-sm btn-success" style="width: 140px;"><i class="ti-info-alt"></i> Serving Table</a>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;">
            <div class="col-sm-12" style="padding: 0px;">
                <div class="row">
                    <div class="col-sm-4" style="padding: 0px;">
                        <div style="max-height: calc(100vh - 225px);overflow-y: auto;overflow-x:hidden;">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    A list item
                                    <span class="badge bg-nifty-primary rounded-pill">14</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    A second list item
                                    <span class="badge bg-nifty-primary rounded-pill">2</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    A third list item
                                    <span class="badge bg-nifty-primary rounded-pill">1</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    A fourth item
                                    <span class="badge bg-nifty-primary rounded-pill">4</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    And a fifth one
                                    <span class="badge bg-nifty-primary rounded-pill">7</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    And a fifth one
                                    <span class="badge bg-nifty-primary rounded-pill">7</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    And a fifth one
                                    <span class="badge bg-nifty-primary rounded-pill">7</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    And a fifth one
                                    <span class="badge bg-nifty-primary rounded-pill">7</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    And a fifth one
                                    <span class="badge bg-nifty-primary rounded-pill">7</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-8" style="padding-left: 0px;">
                        <div style="max-height: calc(100vh - 225px);overflow-y: auto;overflow-x:hidden;">
                            <div class="row">
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="padding: 0px;">
                                    <div class="card align-items-center">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">Menu Item 1</h4>
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
    <div class="col-sm-4" style="padding-right: 0px;padding-left: 5px;">
        <div class="card">
            <div class="card-body" style="padding:0px 15px 0px 15px;">
                <div class="row">
                    <div class="col-sm-12" style="text-align: center;">
                        <a type="button" class="btn btn-sm btn-outline-success">Dine In</a>
                        <a type="button" class="btn btn-sm btn-outline-dark">Pick Up / Delivery</a>
                        <a type="button" class="btn btn-sm btn-outline-dark">Quick Bill</a>

                    </div>
                </div>
                <div class="row" id="divDineIn">
                    <div class="col-sm-12" style="text-align: center;">
                        <div style="text-align: center;border-bottom: 1px solid #e2e2e2;margin: 5px 0px 5px 0px;"></div>
                        <a type="button" class="btn btn-sm btn-outline-success">Order / KOT</a>
                        <a type="button" class="btn btn-sm btn-outline-success">Billing</a>
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