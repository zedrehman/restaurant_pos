@extends('layouts.admin')
@section('dashboard_bar')
Unit Master
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/appsetting/addunitmaster')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="unitemasterId" value="@if(isset($UnitMaster)){{ $UnitMaster->id }}@endif">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="form-group">
                                <label>Unit Name <span style="color:red;">*</span></label>
                                <input type="text" name="unit_name" class="form-control" placeholder="Unit Name" value="@if(isset($UnitMaster)){{ $UnitMaster->unit_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>&nbsp;</label><br>
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection