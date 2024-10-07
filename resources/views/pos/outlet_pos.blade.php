@extends('layouts.admin')
@section('dashboard_bar')
POS
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th style="width: 80%;">Outlet Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($outlets as $Items)
                            <tr>
                                <td> {{ $Items->outlet_name }} </td>
                                <td>
                                    <a class="bt btn-sm btn-info" href="{{ url('/outlet/redirect-to-pos/'.$Items->id) }}" target="_blank">Redirect To POS <i class="fa fa-arrow-right"></i></a>
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