@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Menu Management</li>
        <li class="breadcrumb-item active"> <a href="{{url('/admin/menu-management/outlet-menu')}}">Outlet Menu List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/menu-management/add-outlet-menu')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tableId" value="@if(isset($dataArray)){{ $dataArray->id }}@endif">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Menu Name <span style="color:red;">*</span> </label>
                                <input type="text" name="menu_name" class="form-control" placeholder="menu name" value="@if(isset($dataArray)){{ $dataArray->menu_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Outlet Name <span style="color:red;">*</span> </label>
                                <select class="form-control" name="outlet_id" required>
                                    <option value="">Select outlet</option>
                                    @foreach ($outlets as $outlet)
                                        <option value="{{$outlet->id}}" @if(isset($dataArray) && $dataArray->outlet_id == $outlet->id) selected @endif> {{ $outlet->outlet_name}}</option>
                                    @endforeach
                                </select>
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