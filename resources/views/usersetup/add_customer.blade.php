@extends('layouts.admin')
@section('dashboard_bar')
Customer Master
@endsection


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/usersetup/SaveCustomer')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="customer_id" value="@if(isset($Customer)){{ $Customer->id }}@endif">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Outlet <span style="color:red;">*</span> </label>
                                <select class="form-control" name="outlet_id" required>
                                    <option value="">Select Outlet</option>
                                    @foreach ($outlets as $outlet)
                                    <option value="{{$outlet->id}}" @if(isset($Customer) && $Customer->outlet_id == $outlet->id) selected @endif> {{ $outlet->outlet_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Name <span style="color:red;">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="@if(isset($Customer)){{ $Customer->name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Mobile No <span style="color:red;">*</span></label>
                                <input type="text" name="mobile_no" class="form-control" placeholder="Mobile No" value="@if(isset($Customer)){{ $Customer->mobile_no }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Address <span style="color:red;">*</span></label>
                                <textarea name="address" class="form-control" placeholder="Address">@if(isset($Customer)){{ $Customer->address }}@endif </textarea>
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