@extends('layouts.admin')

@section('dashboard_bar')
Stock Alert
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive rounded card-table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Outlet Name</th>
                        <th>Ingrediant Name</th>
                        <th>Avl Stock</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($stockDetails as $Item)
                    <tr>
                        <td>{{$Item->outlet_name}}</td>
                        <td>{{$Item->ingrediant_name}}</td>
                        <td>{{$Item->avl_stock}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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