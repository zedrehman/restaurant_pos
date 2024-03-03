@extends('layouts.admin')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Configuration</li>
        <li class="breadcrumb-item">Designation List</li>
        <li class="breadcrumb-item active" aria-current="page">Add</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/add-designation')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="designationId" value="@if(isset($designation)){{ $designation->id }}@endif">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="form-group">
                                <label>Designation Name <span style="color:red;">*</span> </label>
                                <input type="text" name="designation_name" class="form-control" placeholder="Designation Name" value="@if(isset($designation)){{ $designation->designation_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Active </label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" name="active" class="form-check-input" value="1" @if(isset($designation) && $designation->active == 1) checked @else checked @endif> Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" name="active" class="form-check-input" value="0" @if(isset($designation) && $designation->active == 0) checked @endif> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2" style="padding-top: 20px;text-align: right;">
                            <button type="submit" class="btn btn-sm btn-success"> Submit</button>
                        </div>
                    </div>





                </form>
            </div>
        </div>
    </div>
</div>

@endsection