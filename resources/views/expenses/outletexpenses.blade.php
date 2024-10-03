@extends('layouts.admin')
@section('dashboard_bar')
Expense Type
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row grid-margin">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/expenses/addoutletexpenses')}}">
                            <i class="fa fa-plus"></i>Add Type
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Outlet Name</th>
                                <th>Expense Type</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Expenses as $Items)
                            <tr>
                                <td> {{ $Items->outlet_name }} </td>
                                <td> {{ $Items->type_name }} </td>
                                <td> {{ $Items->expense_date }} </td>
                                <td> {{ $Items->expense_amount }} </td>
                                <td>
                                    <span>
                                        <a class="text-warning mr-4" href="{{ url('/expenses/editoutletexpenses/'.$Items->id) }}"><i class="fa fa-pencil color-muted"></i></a>
                                        <a class="text-danger" href="{{ url('/expenses/deleteoutletexpenses/'.$Items->id) }}"><i class="fa fa-close color-danger"></i></a>
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