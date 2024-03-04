@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Configuration</li>
        <li class="breadcrumb-item active">Brand List</li>
        <li class="breadcrumb-item active" aria-current="page">Add</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/add-brand')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="brandId" value="@if(isset($brand)){{ $brand->id }}@endif">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Brand Name <span style="color:red;">*</span> </label>
                                <input type="text" name="brand_name" class="form-control" placeholder="brand name" value="@if(isset($brand)){{ $brand->brand_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Brand Short Name <span style="color:red;">*</span> </label>
                                <input type="text" name="brand_short_name" class="form-control" placeholder="brand short name" value="@if(isset($brand)){{ $brand->brand_short_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Phone Number<span style="color:red;">*</span> </label>
                                <input type="text" require name="phone_number" class="form-control" placeholder="phone number" value="@if(isset($brand)){{ $brand->phone_number }}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>FSSAI No<span style="color:red;">*</span> </label>
                                <input type="text" name="FSSAI_no" class="form-control" placeholder="FSSAI no" value="@if(isset($brand)){{ $brand->FSSAI_no }}@endif">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>GST No</label>
                                <input type="text" name="GST_no" class="form-control" placeholder="GST no" value="@if(isset($brand)){{ $brand->GST_no }}@endif">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>PAN No</label>
                                <input type="text" name="PAN No" class="form-control" placeholder="PAN no" value="@if(isset($brand)){{ $brand->PAN_no }}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Address<span style="color:red;">*</span> </label>
                                <textarea type="text" require name="address" class="form-control" placeholder="address" style="height: 100px;">@if(isset($brand)){{ $brand->address }}@endif</textarea>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" name="website" class="form-control" placeholder="website" value="@if(isset($brand)){{ $brand->website }}@endif">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Active</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="active" value="1" class="form-check-input" @if(isset($brand) && $brand->active == 1) checked @else checked @endif> Yes
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="active" value="0" class="form-check-input" @if(isset($brand) && $brand->active == 0) checked @endif> No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <input type="file" name="logoImage" class="form-control" placeholder="logo" value="@if(isset($brand)){{ $brand->id }}@endif" accept="image/png, image/gif, image/jpeg, image/jpg">
                                        @if (isset($brand->logo) )
                                        <img src="{{ asset('brand/'.$brand->logo) }}" width="100">
                                        @endif
                                    </div>
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