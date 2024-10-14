@extends('layouts.admin')

@section('dashboard_bar')
Customer Master
@endsection

@section('Css')
<link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}?version={{config('constant.script_version')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">
        <table class="table border-no order-table mb-4 table-responsive-lg dataTablesCard" id="tblCustomer">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Outlet</th>
                    <th>Name</th>
                    <th>Mobile No</th>
                    <th>Address</th>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $intRow = 1;
                ?>
                @foreach ($CustomerList as $Item)
                <tr>
                    <td>{{$intRow}}</td>
                    <td>{{$Item->getOutlet->outlet_name}}</td>
                    <td>{{$Item->name}}</td>
                    <td>{{$Item->mobile_no}}</td>
                    <td>{{$Item->address}}</td>
                    <td style="text-align: right;">
                        <a href="{{ url('/usersetup/addcustomer/'.$Item->id) }}" class="btn btn-warning shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                        <a href="{{ url('/usersetup/DeleteCustomer/'.$Item->id) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php
                $intRow++;
                ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
@section('JsScript')
<script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}?version={{config('constant.script_version')}}" type="text/javascript"></script>
<script>
    var baseUrl = "{{url('/')}}";
    var _token = "{{ csrf_token() }}";
    $('#tblCustomer').DataTable({
        "scrollY": "42vh",
        "scrollCollapse": true,
        "paging": false
    });

    $(document).ready(function() {
        setTimeout(function() {
            $("#tblCustomer_filter").append(`<a class="btn-sm btn-primary" href="http://localhost/restaurant_pos/usersetup/addcustomer/0" style="margin-left: 10px;"><i class="fa fa-plus"></i>Add</a>`);
        }, 1000);
    })
</script>
@endsection