@extends('layouts.admin')

@section('dashboard_bar')
Table Management
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('/admin/add-table-management')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tableId" value="@if(isset($dataArray)){{ $dataArray->id }}@endif">
                    <input type="hidden" name="outlet_department_id" value="0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Outlets <span style="color:red;">*</span> </label>
                                <select class="form-control" id="outlet_id" name="outlet_id" required>
                                    <option value="">Select Outlet</option>
                                    @foreach ($outlets as $outlet)
                                    <option value="{{$outlet->id}}" @if(isset($dataArray) && $outlet->id == $dataArray->outlet_id) selected @endif> {{ $outlet->outlet_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Table Name <span style="color:red;">*</span> </label>
                                <input type="text" name="table_name" class="form-control" placeholder="" value="@if(isset($dataArray)){{ $dataArray->table_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Max Person <span style="color:red;">*</span> </label>
                                <input type="text" name="max_person" class="form-control" placeholder="" value="@if(isset($dataArray)){{ $dataArray->max_person }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>&nbsp;</label><br>
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

@endsection

@section('JsScript')
<script>
    var baseUrl = "{{url('/')}}";
    console.log(baseUrl);
    var outletDepartMentId = "<?php echo isset($dataArray) ? $dataArray->outlet_department_id : '' ?>";
    $(document).ready(function() {
        $('#outlet_id').change(function() {
            let outletId = this.value;
            getOutletDepartmentData(outletId);
        }).trigger('change');

        function getOutletDepartmentData(outletId) {
            $('#outlet_department_id').html('');
            if (outletId != '') {
                $.ajax({
                    url: baseUrl + '/admin/outlet-department-data/' + outletId,
                    type: 'GET',
                    success: function(resp) {
                        let appendData = '<option value="">Select Outlets Department</option>';
                        for (let index = 0; index < resp.length; index++) {
                            let selected = '';
                            if (resp[index].id == outletDepartMentId) {
                                selected = 'selected';
                            }
                            appendData += `<option value="${resp[index].id}" ${selected}>${resp[index].outlet_department_name}</option>`;
                        }
                        $('#outlet_department_id').html(appendData);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        let appendData = '<option value="">Select Outlets Department</option>';
                        $('#outlet_department_id').html(appendData);
                        var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
                        console.log(errorMsg)
                    }
                });
            } else {
                let appendData = '<option value="">Select Outlets Department</option>';
                $('#outlet_department_id').html(appendData);
            }
        }
    });
</script>
@endsection