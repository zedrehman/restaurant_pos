@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Master Configuration</li>
        <li class="breadcrumb-item active"> <a href="{{url('/admin/product-group-list')}}">Product Group  List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/add-product-group')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="productGroupId" value="@if(isset($productGroup)){{ $productGroup->id }}@endif">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>product group name <span style="color:red;">*</span> </label>
                                <input type="text" name="product_group_name" class="form-control" placeholder="product group name" value="@if(isset($productGroup)){{ $productGroup->product_group_name }}@endif" required>
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