@extends('layouts.admin')

@section('content')
<a href="{{url('/admin/add-designation')}}">Add Designation</a>
<table border="1">
    <thead>
        <tr>
            <th>Action</th>
            <th>Designation</th>
            <th>Active</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($designation as $ds)
        <tr>
            <td> 
                <a class="btn-sm btn-warning" href="{{ url('/admin/edit-designation/'.$ds->id) }}">Edit</a>
            </td>
            <td> {{ $ds->designation_name }} </td>
            <td> @if($ds->active==1)
                <div class="badge badge-success badge-pill">Active</div>
                @else
                <div class="badge badge-warning badge-pill">Inactive</div>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
<table>
@endsection