@extends('layouts.admin')
@section('dashboard_bar')
Unit Master
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/expenses/addoutletexpenses')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ExpensesId" value="@if(isset($Expenses)){{ $Expenses->id }}@endif">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Outlets <span style="color:red;">*</span> </label>
                                <select class="form-control" name="outlet_id" required>
                                    <option value="">--Outlet--</option>
                                    @foreach ($outlets as $outlet)
                                    <option value="{{$outlet->id}}" @if(isset($Expenses) && $outlet->id == $Expenses->outlet_id) selected @endif> {{ $outlet->outlet_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Date <span style="color:red;">*</span></label>
                                <input type="date" name="expense_date" class="form-control" value="@if(isset($Expenses)){{ $Expenses->expense_date }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Amount <span style="color:red;">*</span></label>
                                <input type="text" name="expense_amount" class="form-control" placeholder="Amount" value="@if(isset($Expenses)){{ $Expenses->expense_amount }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Expense Type <span style="color:red;">*</span></label>
                                <select class="form-control" name="expense_type_id" required>
                                    <option value="">--Unit--</option>
                                    @foreach ($ExpenseType as $uItem)
                                    <option value="{{$uItem->id}}" @if(isset($Expenses) && $uItem->id == $Expenses->expense_type_id) selected @endif> {{ $uItem->type_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control" placeholder="Description" value="@if(isset($Expenses)){{ $Expenses->description }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection