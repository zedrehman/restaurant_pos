@extends('layouts.admin')

@section('content')
<form action="{{url('/admin/add-designation')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="designationId" value="@if(isset($designation)){{ $designation->id }}@endif">
    <input type="text" name="designation_name" class="form-control" placeholder="Designation Name" value="@if(isset($designation)){{ $designation->designation_name }}@endif" required>
    <label>Active </label>
    <input type="radio" name="active" class="form-control" value="1" @if(isset($designation) && $designation->active == 1) checked @else checked @endif>
    <input type="radio" name="active" class="form-control" value="0" @if(isset($designation) && $designation->active == 0) checked @endif>
    <button type="submit"> Submit</button>
</form>
@endsection