@extends('layouts.admin')
@section('dashboard_bar')
SMS Master
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/appsetting/addsms')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="smsId" value="@if(isset($SMSList)){{ $SMSList->id }}@endif">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Outlets <span style="color:red;">*</span> </label>
                                <select class="form-control" name="outlet_id" required>
                                    <option value="">Select Outlet</option>
                                    @foreach ($outlets as $outlet)
                                    <option value="{{$outlet->id}}" @if(isset($SMSList) && $outlet->id == $SMSList->outlet_id) selected @endif> {{ $outlet->outlet_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <label>API <span style="color:red;">*</span></label>
                                <input type="text" name="api" class="form-control" placeholder="API" value="@if(isset($SMSList)){{ $SMSList->api }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Username <span style="color:red;">*</span></label>
                                <input type="text" name="username" class="form-control" placeholder="Username" value="@if(isset($SMSList)){{ $SMSList->username }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Password <span style="color:red;">*</span></label>
                                <input type="text" name="password" class="form-control" placeholder="Password" value="@if(isset($SMSList)){{ $SMSList->password }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Sender Id <span style="color:red;">*</span></label>
                                <input type="text" name="sender_id" class="form-control" placeholder="Sender Id" value="@if(isset($SMSList)){{ $SMSList->sender_id }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Template Id <span style="color:red;">*</span></label>
                                <input type="text" name="template_id" class="form-control" placeholder="Template Id" value="@if(isset($SMSList)){{ $SMSList->template_id }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Template <span style="color:red;">*</span></label>
                                <input type="text" name="template" class="form-control" placeholder="Template" value="@if(isset($SMSList)){{ $SMSList->template }}@endif" required>
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