@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Configuration</li>
        <li class="breadcrumb-item">Outlet List</li>
        <li class="breadcrumb-item active" aria-current="page">Add</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('/admin/add-outlet')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="outletId" value="@if(isset($outlet)){{ $outlet->id }}@endif">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Brand <span style="color:red;">*</span> </label>
                                <select class="form-control" name="brand_id">
                                    <option value="">Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}"> {{ $brand->brand_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Outlet Name <span style="color:red;">*</span> </label>
                                <input type="text" name="outlet_name" class="form-control" placeholder="Outlet Name" value="@if(isset($outlet)){{ $outlet->outlet_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Start Day Time <span style="color:red;">*</span> </label>
                                <input type="text" name="start_day_time" id="start_day_time" class="form-control" placeholder="Start Day Time" value="@if(isset($outlet)){{ $outlet->start_day_time }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Close Day Time <span style="color:red;">*</span> </label>
                                <input type="text" name="close_day_time" id="close_day_time" class="form-control" placeholder="Close Day Time" value="@if(isset($outlet)){{ $outlet->close_day_time }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Next Reset Bill Date </label>
                                <input type="text" name="next_reset_bill_date" id="next_reset_bill_date" class="form-control" placeholder="Next Reset Bill Date" value="@if(isset($outlet)){{ $outlet->next_reset_bill_date }}@endif">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Next Reset Bill (In Days) </label>
                                <input type="number" name="next_reset_bill" class="form-control" placeholder="Next Reset Bill (In Days)" value="@if(isset($outlet)){{ $outlet->next_reset_bill }}@endif" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Next Reset KOT Date </label>
                                <input type="text" name="next_reset_kot_date" id="next_reset_kot_date" class="form-control" placeholder="Next Reset KOT Date" value="@if(isset($outlet)){{ $outlet->next_reset_kot_date }}@endif">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Next Reset KOT (In Days) </label>
                                <input type="text" name="next_reset_kot" class="form-control" placeholder="Next Reset KOT (In Days)" value="@if(isset($outlet)){{ $outlet->next_reset_kot }}@endif"  onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" maxlength="10">
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
                                    <option value="1"> Mumbai </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>zip code </label>
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
                                <label>outlet_code </label>
                                <input type="text" name="outlet_code" class="form-control" placeholder="" value="@if(isset($outlet)){{ $outlet->outlet_code }}@endif">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Address </label>
                                <textarea name="address" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>description </label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>logo </label>
                                <input type="file" name="logo" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Active </label>
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
                                <label>Do you want to logout POS, when application is closed ? </label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" name="is_logout_pos" class="form-check-input" value="1" @if(isset($outlet) && $outlet->is_logout_pos == 1) checked @else checked @endif> Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" name="is_logout_pos" class="form-check-input" value="0" @if(isset($outlet) && $outlet->is_logout_pos == 0) checked @endif> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Enabled Passcode Protection </label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" name="is_passcode_protection" class="form-check-input" value="1" @if(isset($outlet) && $outlet->is_passcode_protection == 1) checked @else checked @endif> Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" name="is_passcode_protection" class="form-check-input" value="0" @if(isset($outlet) && $outlet->is_passcode_protection == 0) checked @endif> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>outlet_code </label>
                                <input type="text" name="GST_no" class="form-control" placeholder="" value="@if(isset($outlet)){{ $outlet->GST_no }}@endif">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $('#start_day_time').datetimepicker({
        format: 'hh:mm:ss',
    });
    $('#close_day_time').datetimepicker({
        format: 'hh:mm:ss',
    });
    $('#next_reset_bill_date').datetimepicker({
        format: 'YYYY-MM-DD hh:mm:ss',
    });
    
    $('#next_reset_kot_date').datetimepicker({
        format: 'YYYY-MM-DD hh:mm:ss',
    });
</script>
@endsection