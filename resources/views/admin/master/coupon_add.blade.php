@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-dark">
        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i class="ti-home menu-icon"></i></a></li>
        <li class="breadcrumb-item">Master Configuration</li>
        <li class="breadcrumb-item active">Coupon  List</li>
        <li class="breadcrumb-item active" aria-current="page">Add</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/add-coupon')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tableId" value="@if(isset($dataArray)){{ $dataArray->id }}@endif">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>coupon_name <span style="color:red;">*</span> </label>
                                <input type="text" name="coupon_name" class="form-control" placeholder="" value="@if(isset($dataArray)){{ $dataArray->coupon_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>coupon_code <span style="color:red;">*</span> </label>
                                <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="" value="@if(isset($dataArray)){{ $dataArray->coupon_code }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>coupon_type <span style="color:red;">*</span> </label>
                                <select class="form-control" name="coupon_type" required>
                                    <option value="">Select Coupon Type</option>
                                    <option value="1" @if(isset($dataArray) && 1 == $dataArray->coupon_type) selected @endif>Fixed</option>
                                    <option value="2" @if(isset($dataArray) && 2 == $dataArray->coupon_type) selected @endif>Percentage</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>amount:<span style="color:red;">*</span> </label>
                                <input type="number" name="amount" class="form-control" placeholder="" value="@if(isset($dataArray)){{ $dataArray->amount }}@endif" required>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>max_off:</label>
                                <input type="number" name="max_off" class="form-control" placeholder="" value="@if(isset($dataArray)){{ $dataArray->max_off }}@endif">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>end_date:<span style="color:red;">*</span> </label>
                                <input type="text" name="end_date" id="end_date" class="form-control" placeholder="" value="@if(isset($dataArray)){{ $dataArray->end_date }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>description </label>
                                <textarea name="description" class="form-control">@if(isset($dataArray)){{ $dataArray->description }}@endif</textarea
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="active" class="form-check-input" @if(isset($dataArray) && $dataArray->active == 1) checked @endif> Active
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
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
    $('#end_date').datetimepicker({
        format: 'YYYY-MM-DD',
    });
    $("#coupon_code").keyup(function() {
        var val = $(this).val()
        $(this).val(val.toUpperCase());
    });
</script>
@endsection


