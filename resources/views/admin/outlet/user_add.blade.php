@extends('layouts.admin')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Configuration</li>
        <li class="breadcrumb-item"> <a href="{{url('/admin/outlet-user')}}"> user User List</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('/admin/add-user')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tableId" value="@if(isset($user)){{ $user->id }}@endif">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Outlet <span style="color:red;">*</span> </label>
                                <select class="form-control" name="outlet_id" required>
                                    <option value="">Select Outlet</option>
                                    @foreach ($outlets as $outlet)
                                        <option value="{{$outlet->id}}" @if(isset($user) && $user->outlet_id == $outlet->id) selected @endif> {{ $outlet->outlet_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Name <span style="color:red;">*</span> </label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="@if(isset($user)){{ $user->name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Email <span style="color:red;">*</span> </label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="email" value="@if(isset($user)){{ $user->email }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Password <span style="color:red;">*</span> </label>
                                <input type="password" name="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="password" @if(!isset($user->id)) required @endif>
                                @if (isset($user->id))
                                <span>Leave blank to keep current password</span>
                                @endif
                                
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Contact phone <span style="color:red;">*</span></label>
                                <input type="text" name="contact_phone" class="form-control" placeholder="contact phone" value="@if(isset($user)){{ $user->contact_phone }}@endif" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>User Type <span style="color:red;">*</span> </label>
                                <select class="form-control" name="user_type" required>
                                    <option value="">Select usertype</option>
                                    @foreach ($userType as $key => $uType)
                                        <option value="{{$uType}}" @if(isset($user) && $user->user_type == $uType) selected @endif> {{ $uType}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Address <span style="color:red;">*</span></label>
                                <textarea name="address" class="form-control" required>@if(isset($user)){{ $user->address }}@endif</textarea>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>City <span style="color:red;">*</span></label>
                                <select class="form-control" name="city_id" required>
                                    <option value="">Select City</option>
                                    
                                    @foreach ($cities as $city)
                                        <option value="{{$city->id}}" @if(isset($user) && $user->city_id == $city->id) selected @endif> {{ $city->city_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>zip code <span style="color:red;">*</span></label>
                                <input type="text" name="postal_code" class="form-control" placeholder="" value="@if(isset($user)){{ $user->postal_code }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="active" class="form-check-input" @if(isset($user) && $user->active == 1) checked @endif> Active
                                    </label>
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
<script>
</script>
@endsection