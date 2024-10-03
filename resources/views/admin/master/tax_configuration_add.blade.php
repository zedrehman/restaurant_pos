@extends('layouts.admin')
@section('dashboard_bar')
TAX
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/add-tax-configuration')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="taxConfigurationId" value="@if(isset($taxConfiguration)){{ $taxConfiguration->id }}@endif">
                    <input type="hidden" name="product_group_id" value="0">
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
                                <label>Display Name:<span style="color:red;">*</span> </label>
                                <input type="text" name="tax_display_name" class="form-control" placeholder="Display Name" value="@if(isset($taxConfiguration)){{ $taxConfiguration->tax_display_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
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