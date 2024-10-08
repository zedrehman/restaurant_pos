@extends('layouts.admin')
@section('dashboard_bar')
Category
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/menu-management/add-menu-categories')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tableId" value="@if(isset($dataArray)){{ $dataArray->id }}@endif">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Category name <span style="color:red;">*</span> </label>
                                <input type="text" name="category_name" class="form-control" placeholder="Category name" value="@if(isset($dataArray)){{ $dataArray->category_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" placeholder="logo" accept="image/png, image/gif, image/jpeg, image/jpg">
                                @if (isset($dataArray->image) )
                                <img src="{{ asset('menu/menu_category/'.$dataArray->image) }}" width="100">
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>&nbsp;</label>
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