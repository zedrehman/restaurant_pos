@extends('layouts.admin')
@section('dashboard_bar')
Unit Master
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row grid-margin">
                    <div class="col-12" style="text-align: right;">
                        <a class="btn-sm btn-primary" href="{{url('/appsetting/addunitmaster')}}">
                            <i class="fa fa-plus"></i>Add Unit
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="width: 80%;">Unit Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($UnitMaster as $Items)
                            <tr>
                                <td> {{ $Items->unit_name }} </td>
                                <td>
                                    <span>
                                        <a class="text-warning mr-4" href="{{ url('/appsetting/editunitmaster/'.$Items->id) }}"><i class="fa fa-pencil color-muted"></i></a>
                                        <a class="text-danger" href="{{ url('/appsetting/deleteunitmaster/'.$Items->id) }}"><i class="fa fa-close color-danger"></i></a>
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