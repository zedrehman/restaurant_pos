@extends('layouts.admin')
@section('dashboard_bar')
Email Setup
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/appsetting/addemail')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="emailId" value="@if(isset($EmailList)){{ $EmailList->id }}@endif">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Outlets <span style="color:red;">*</span> </label>
                                <select class="form-control" name="outlet_id" required>
                                    <option value="">Select Outlet</option>
                                    @foreach ($outlets as $outlet)
                                    <option value="{{$outlet->id}}" @if(isset($EmailList) && $outlet->id == $EmailList->outlet_id) selected @endif> {{ $outlet->outlet_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>From Email <span style="color:red;">*</span></label>
                                <input type="email" name="from_email" class="form-control" placeholder="From Email" value="@if(isset($EmailList)){{ $EmailList->from_email }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Username <span style="color:red;">*</span></label>
                                <input type="text" name="username" class="form-control" placeholder="Username" value="@if(isset($EmailList)){{ $EmailList->username }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Password <span style="color:red;">*</span></label>
                                <input type="text" name="password" class="form-control" placeholder="Password" value="@if(isset($EmailList)){{ $EmailList->password }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Host <span style="color:red;">*</span></label>
                                <input type="text" name="host" class="form-control" placeholder="Host" value="@if(isset($EmailList)){{ $EmailList->host }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Port <span style="color:red;">*</span></label>
                                <input type="text" name="port" class="form-control" placeholder="Port" value="@if(isset($EmailList)){{ $EmailList->port }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>SSL<span style="color:red;">*</span></label>
                                <input type="text" name="ssl" class="form-control" placeholder="SSL" value="@if(isset($EmailList)){{ $EmailList->ssl }}@endif" required>
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