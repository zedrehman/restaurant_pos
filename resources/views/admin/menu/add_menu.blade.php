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
                <form action="{{url('/admin/menu-management/add-item')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tableId" value="@if(isset($dataArray)){{ $dataArray->id }}@endif">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Add Item Menu <span style="color:red;">*</span> </label>
                                <select class="form-control" multiple name="menu_catalogue_id[]" required>
                                    <option value="">Select Item</option>
                                    @foreach ($menuCatalogue as $catalogue)
                                        <option value="{{$catalogue->id}}"> {{ $catalogue->menu_name}}</option>
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

@section('JsScript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.2/select2.css" rel="stylesheet"/>
<script>
    $(function () {
        let sellerDetails = JSON.parse('{!! $menuDetail !!}');
        $('select').select2().val(sellerDetails).trigger('change.select2');
        $("select").select2();
    });
</script>
@endsection