@extends('layouts.admin')
@section('dashboard_bar')
SMS Master
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/foodsetup/addingrediant')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="IngrediantId" value="@if(isset($IngrediantList)){{ $IngrediantList->id }}@endif">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Outlets <span style="color:red;">*</span> </label>
                                <select class="form-control" name="outlet_id" required>
                                    <option value="">--Outlet--</option>
                                    @foreach ($outlets as $outlet)
                                    <option value="{{$outlet->id}}" @if(isset($IngrediantList) && $outlet->id == $IngrediantList->outlet_id) selected @endif> {{ $outlet->outlet_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Name <span style="color:red;">*</span></label>
                                <input type="text" name="ingrediant_name" class="form-control" placeholder="Name" value="@if(isset($IngrediantList)){{ $IngrediantList->ingrediant_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Cost <span style="color:red;">*</span></label>
                                <input type="text" name="cost" class="form-control" placeholder="Cost" value="@if(isset($IngrediantList)){{ $IngrediantList->cost }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Unit <span style="color:red;">*</span></label>
                                <select class="form-control" name="unit_id" required>
                                    <option value="">--Unit--</option>
                                    @foreach ($UnitList as $uItem)
                                    <option value="{{$uItem->id}}" @if(isset($IngrediantList) && $uItem->id == $IngrediantList->unit_id) selected @endif> {{ $uItem->unit_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection