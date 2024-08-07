@extends('layouts.admin')

@section('content')
<style>
    #ulOutletMenu {
        list-style-type: none;
    }

    #ulOutletMenu li {
        display: inline;
        margin-right: 15px;
    }
</style>
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
                        <div class="col-sm-12">
                            <ul id="ulOutletMenu">
                                @foreach ($MenuCatalogueList as $Item)
                                <li>
                                    <label>
                                        @if(in_array($Item->id, $menuDetail))
                                            <input type="checkbox" name="chkMenuName[]" id="chk_{{ $Item->id}}" value="{{ $Item->id}}" checked> {{ $Item->menu_name}}
                                        @else
                                            <input type="checkbox" name="chkMenuName[]" id="chk_{{ $Item->id}}" value="{{ $Item->id}}"> {{ $Item->menu_name}}
                                        @endif                                        
                                    </label>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('JsScript')
<script>
    $(function() {
        
    });
</script>
@endsection