@extends('layouts.admin')
@section('dashboard_bar')
Printer Setup
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/appsetting/addprinter')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="PrinterId" value="@if(isset($PrinterList)){{ $PrinterList->id }}@endif">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Outlets <span style="color:red;">*</span> </label>
                                <select class="form-control" name="outlet_id" required>
                                    <option value="">Select Outlet</option>
                                    @foreach ($outlets as $outlet)
                                    <option value="{{$outlet->id}}" @if(isset($PrinterList) && $outlet->id == $PrinterList->outlet_id) selected @endif> {{ $outlet->outlet_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Header Footer Font Size <span style="color:red;">*</span></label>
                                <input type="text" name="header_footer_size" class="form-control" placeholder="Header Footer Font Size" value="@if(isset($PrinterList)){{ $PrinterList->header_footer_size }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Item Font Size <span style="color:red;">*</span></label>
                                <input type="text" name="item_font_size" class="form-control" placeholder="Item Font Size" value="@if(isset($PrinterList)){{ $PrinterList->item_font_size }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Height <span style="color:red;">*</span></label>
                                <input type="text" name="height" class="form-control" placeholder="Height" value="@if(isset($PrinterList)){{ $PrinterList->height }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Width <span style="color:red;">*</span></label>
                                <input type="text" name="width" class="form-control" placeholder="Width" value="@if(isset($PrinterList)){{ $PrinterList->width }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Terms Conditions Font Size </label>
                                <input type="text" name="terms_conditions_font_size" class="form-control" placeholder="Port" value="@if(isset($PrinterList)){{ $PrinterList->terms_conditions_font_size }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Terms Conditions</label>
                                <input type="text" name="terms_conditions" class="form-control" placeholder="Terms Conditions" value="@if(isset($PrinterList)){{ $PrinterList->terms_conditions }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>&nbsp;</label><br>
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection