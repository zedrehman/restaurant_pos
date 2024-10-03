@extends('layouts.admin')
@section('dashboard_bar')
Outlet List
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('/usersetup/addoutlet')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="outletId" value="@if(isset($outlet)){{ $outlet->id }}@endif">
                    <input type="hidden" name="brand_id" value="0">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Outlet Name <span style="color:red;">*</span> </label>
                                <input type="text" name="outlet_name" class="form-control" placeholder="Outlet Name" value="@if(isset($outlet)){{ $outlet->outlet_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Start Day Time <span style="color:red;">*</span> </label>
                                <input type="time" name="start_day_time" id="start_day_time" class="form-control" placeholder="Start Day Time" value="@if(isset($outlet)){{ $outlet->start_day_time }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Close Day Time <span style="color:red;">*</span> </label>
                                <input type="time" name="close_day_time" id="close_day_time" class="form-control" placeholder="Close Day Time" value="@if(isset($outlet)){{ $outlet->close_day_time }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Contact phone </label>
                                <input type="text" name="contact_phone" class="form-control" placeholder="contact phone" value="@if(isset($outlet)){{ $outlet->contact_phone }}@endif" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Notification email </label>
                                <input type="email" name="notification_email" class="form-control" placeholder="" value="@if(isset($outlet)){{ $outlet->notification_email }}@endif">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>City </label>
                                <select class="form-control" name="city_id">
                                    <option value="">Select City</option>
                                    @foreach ($cities as $city)
                                    <option value="{{$city->id}}" @if(isset($outlet) && $outlet->city_id == $city->id) selected @endif> {{ $city->city_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>zip code</label>
                                <input type="text" name="zip_code" class="form-control" placeholder="" value="@if(isset($outlet)){{ $outlet->zip_code }}@endif">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>locality </label>
                                <input type="text" name="locality" class="form-control" placeholder="" value="@if(isset($outlet)){{ $outlet->locality }}@endif">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>outlet_code</label>
                                <input type="text" name="outlet_code" class="form-control" placeholder="" value="@if(isset($outlet)){{ $outlet->outlet_code }}@endif">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Address </label>
                                <textarea name="address" class="form-control">@if(isset($outlet)){{ $outlet->address }}@endif</textarea>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>logo </label>
                                <input type="file" name="logo" class="form-control" placeholder="" accept="image/png, image/gif, image/jpeg, image/jpg">
                                @if (isset($outlet->logo) )
                                <img src="{{ asset('outlet/'.$outlet->logo) }}" width="100">
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Status</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" name="active" class="form-check-input" value="1" @if(isset($outlet) && $outlet->active == 1) checked @else checked @endif> Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" name="active" class="form-check-input" value="0" @if(isset($outlet) && $outlet->active == 0) checked @endif> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>GST no. </label>
                                <input type="text" name="GST_no" class="form-control" placeholder="" value="@if(isset($outlet)){{ $outlet->GST_no }}@endif">
                            </div>
                        </div>
                        <div class="col-sm-12" style="padding-top: 20px;">
                            <button type="submit" class="btn btn-sm btn-success"> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
</script>
@endsection