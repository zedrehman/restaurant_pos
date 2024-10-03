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
                        <a class="btn-sm btn-primary" href="{{url('/expenses/addexpensetype')}}">
                            <i class="fa fa-plus"></i>Add Type
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="width: 80%;">Unit Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ExpenseType as $Items)
                            <tr>
                                <td> {{ $Items->type_name }} </td>
                                <td>
                                    <span>
                                        <a class="text-warning mr-4" href="{{ url('/expenses/editexpensetype/'.$Items->id) }}"><i class="fa fa-pencil color-muted"></i></a>
                                        <a class="text-danger" href="{{ url('/expenses/deleteexpensetype/'.$Items->id) }}"><i class="fa fa-close color-danger"></i></a>
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