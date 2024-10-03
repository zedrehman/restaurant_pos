@extends('layouts.admin')
@section('dashboard_bar')
Ingrediant
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body" style="padding: 5px;">
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-sm-4" style="text-align: right;">

                    </div>
                    <div class="col-sm-4" style="text-align: right;">
                        <select class="form-control" id="ddlOutlet">
                            <option value="">--Outlet--</option>
                            @foreach ($outlets as $outlet)
                            <option value="{{$outlet->id}}"> {{ $outlet->outlet_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4" style="text-align: right;">
                        <a class="btn-sm btn-secondary" id="btnAddStock" style="margin-right: 10px;">
                            <i class="fa fa-plus"></i>Add Stock
                        </a>
                        <a class="btn-sm btn-primary" href="{{url('/foodsetup/addingrediant')}}" style="margin-right: 10px;">
                            <i class="fa fa-plus"></i>Add Ingrediant
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Outlet Name</th>
                                <th>Name</th>
                                <th>Unit</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($IngrediantList as $Items)
                            <tr>
                                <td> {{ $Items->outlet_name }} </td>
                                <td> {{ $Items->ingrediant_name }} </td>
                                <td> {{ $Items->unit_name }} </td>
                                <td> {{ $Items->total_stock }} </td>
                                <td>
                                    <span>
                                        <a class="text-warning mr-4" href="{{ url('/foodsetup/editingrediant/'.$Items->id) }}"><i class="fa fa-pencil color-muted"></i></a>
                                        <a class="text-danger" href="{{ url('/foodsetup/deleteingrediant/'.$Items->id) }}"><i class="fa fa-close color-danger"></i></a>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('JsScript')
<script>
    var baseUrl = "{{url('/')}}";
    var _token = "{{ csrf_token() }}";
    $("#btnAddStock").click(function() {
        if ($("#ddlOutlet").val() != "") {
            window.location.href = baseUrl + '/foodsetup/ingrediantstock/' + $("#ddlOutlet").val();
        } else {
            alert('select outlet name');
        }
    });
</script>
@endsection