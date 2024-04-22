@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Menu Management</li>
        <li class="breadcrumb-item active"> <a href="{{url('/admin/menu-management/menu-catalogues')}}">Menu Catalogues  List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/menu-management/add-menu-catalogues')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tableId" value="@if(isset($dataArray)){{ $dataArray->id }}@endif">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Short code <span style="color:red;">*</span> </label>
                                <input type="text" name="short_code" class="form-control" placeholder="Short code" value="@if(isset($dataArray)){{ $dataArray->short_code }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Menu name <span style="color:red;">*</span> </label>
                                <input type="text" name="menu_name" class="form-control" placeholder="Short code" value="@if(isset($dataArray)){{ $dataArray->menu_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>sale price <span style="color:red;">*</span> </label>
                                <input type="number" name="sale_price" class="form-control" placeholder="Short code" value="@if(isset($dataArray)){{ $dataArray->sale_price }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>current stock</label>
                                <input type="text" name="current_stock" class="form-control" placeholder="current stock" value="@if(isset($dataArray)){{ $dataArray->current_stock }}@endif">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Category name <span style="color:red;">*</span> </label>
                                <select class="form-control" name="menu_categories_id" required>
                                    <option value="">Select Category</option>
                                    @foreach ($menuCategory as $category)
                                        <option value="{{$category->id}}" @if(isset($dataArray) && $dataArray->menu_categories_id == $category->id) selected @endif> {{ $category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>food type <span style="color:red;">*</span> </label>
                                <select class="form-control" name="food_type" required>
                                    <option value="">Select food type</option>
                                    @foreach ($foodType as $food)
                                        <option value="{{$food->id}}" @if(isset($dataArray) && $dataArray->food_type == $food->id) selected @endif> {{ $food->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" placeholder="logo" accept="image/png, image/gif, image/jpeg, image/jpg">
                                @if (isset($dataArray->image) )
                                <img src="{{ asset('menu/menu_category/'.$dataArray->image) }}" width="100">
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>description  </label>
                                <input type="text" name="description" class="form-control" placeholder="description" value="@if(isset($dataArray)){{ $dataArray->description }}@endif">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="active" class="form-check-input" @if(isset($dataArray) && $dataArray->active == 1) checked @endif> Active
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