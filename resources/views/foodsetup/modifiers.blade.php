@extends('layouts.admin')
@section('dashboard_bar')
Modifiers
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body" style="padding: 5px;">
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-sm-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/foodsetup/addmodifiers')}}" style="margin-right: 10px;">
                            <i class="fa fa-plus"></i>Add
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Outlet Name</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ModifierList as $Items)
                            <tr>
                                <td> {{ $Items->outlet_name }} </td>
                                <td> {{ $Items->modifier_name }} </td>
                                <td>
                                    <span>
                                        <a class="text-warning mr-4" href="{{ url('/foodsetup/editmodifiers/'.$Items->id) }}"><i class="fa fa-pencil color-muted"></i></a>
                                        <a class="text-danger" href="{{ url('/foodsetup/deletemodifiers/'.$Items->id) }}"><i class="fa fa-close color-danger"></i></a>
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
</script>
@endsection