@extends('layouts.admin')

@section('content')
<form action="{{url('/admin/add-brand')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="brandId" value="@if(isset($brand)){{ $brand->id }}@endif">
    <input type="text" name="brand_name" class="form-control" placeholder="brand name" value="@if(isset($brand)){{ $brand->brand_name }}@endif" required>
    <input type="text" name="brand_short_name" class="form-control" placeholder="brand short name" value="@if(isset($brand)){{ $brand->brand_short_name }}@endif" required>
    <input type="text" name="phone_number" class="form-control" placeholder="phone number" value="@if(isset($brand)){{ $brand->phone_number }}@endif">
    <input type="text" name="FSSAI_no" class="form-control" placeholder="FSSAI no" value="@if(isset($brand)){{ $brand->FSSAI_no }}@endif">
    <input type="text" name="GST_no" class="form-control" placeholder="GST no" value="@if(isset($brand)){{ $brand->GST_no }}@endif">
    <input type="text" name="PAN_no" class="form-control" placeholder="PAN no" value="@if(isset($brand)){{ $brand->PAN_no }}@endif">
    <input type="file" name="logoImage" class="form-control" placeholder="logo" value="@if(isset($brand)){{ $brand->id }}@endif">
    @if (isset($brand->logo) )
        <img src="{{ asset('brand/'.$brand->id.'/'.$brand->logo) }}" width="100">
    @endif
    <input type="text" name="website" class="form-control" placeholder="website" value="@if(isset($brand)){{ $brand->website }}@endif">
    <textarea type="text" name="address" class="form-control" placeholder="address">@if(isset($brand)){{ $brand->address }}@endif</textarea>
    <label>Active </label>
    <input type="radio" name="active" class="form-control" value="1" @if(isset($brand) && $brand->active == 1) checked @else checked @endif>
    <input type="radio" name="active" class="form-control" value="0" @if(isset($brand) && $brand->active == 0) checked @endif>
    <button type="submit"> Submit</button>
</form>
@endsection