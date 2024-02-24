@extends('layouts.admin')

@section('content')
<a href="{{url('/admin/add-brand')}}">Add Brand</a>
<table border="1">
    <thead>
        <tr>
            <th>Action</th>
            <th>Logo</th>
            <th>Brand Name</th>
            <th>Short Name</th>
            <th>Active</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($brands as $br)
        <tr>
            <td> 
                <a class="btn-sm btn-warning" href="{{ url('/admin/edit-brand/'.$br->id) }}">Edit</a>
            </td>
            <td> <img src="{{ asset('brand/'.$br->id.'/'.$br->logo) }}" width="100"> </td>
            <td> {{ $br->brand_name }} </td>
            <td> {{ $br->brand_short_name }} </td>
            <td> @if($br->active==1)
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