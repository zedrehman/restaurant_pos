@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Master Configuration</li>
        <li class="breadcrumb-item active">Tax Configuration  List</li>
        <li class="breadcrumb-item active" aria-current="page">Add</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/add-tax-configuration')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="taxConfigurationId" value="@if(isset($taxConfiguration)){{ $taxConfiguration->id }}@endif">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Outlets <span style="color:red;">*</span> </label>
                                <select class="form-control" name="outlet_id" required>
                                    <option value="">Select Outlet</option>
                                    @foreach ($outlets as $outlet)
                                        <option value="{{$outlet->id}}" @if(isset($taxConfiguration) && $outlet->id == $taxConfiguration->outlet_id) selected @endif> {{ $outlet->outlet_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Tax Value <span style="color:red;">*</span> </label>
                                <input type="text" name="tax_value" class="form-control" placeholder="Tax Value" value="@if(isset($taxConfiguration)){{ $taxConfiguration->tax_value }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Tax Name <span style="color:red;">*</span> </label>
                                <input type="text" name="tax_name" class="form-control" placeholder="Tax Name" value="@if(isset($taxConfiguration)){{ $taxConfiguration->tax_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Product Group <span style="color:red;">*</span> </label>
                                <select class="form-control" name="product_group_id" required>
                                    <option value="">Select Outlet</option>
                                    @foreach ($productGroup as $group)
                                        <option value="{{$group->id}}" @if(isset($taxConfiguration) && $group->id == $taxConfiguration->product_group_id) selected @endif> {{ $group->product_group_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Display Name:<span style="color:red;">*</span> </label>
                                <input type="text" name="tax_display_name" class="form-control" placeholder="Display Name" value="@if(isset($taxConfiguration)){{ $taxConfiguration->tax_display_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="is_dividable" class="form-check-input" @if(isset($taxConfiguration) && $taxConfiguration->is_dividable == 1) checked @endif> Tax Dividable (CGST / SGST)
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="include_in_rate" class="form-check-input" @if(isset($taxConfiguration) && $taxConfiguration->include_in_rate == 1) checked @endif> Include In Rate
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="active" class="form-check-input" @if(isset($taxConfiguration) && $taxConfiguration->active == 1) checked @endif> Active
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-sm btn-success"> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection