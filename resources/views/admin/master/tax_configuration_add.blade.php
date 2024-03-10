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
                                <select class="form-control" name="outlet_id">
                                    <option value="">Select Outlet</option>
                                    @foreach ($outlets as $oulet)
                                        <option value="{{$oulet->id}}" @if(isset($outlet) && $outlet->id == $taxConfiguration->outlet_id) selected @endif> {{ $oulet->outlet_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Tax Value <span style="color:red;">*</span> </label>
                                <input type="text" name="brand_name" class="form-control" placeholder="brand name" value="@if(isset($brand)){{ $brand->brand_name }}@endif" required>
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