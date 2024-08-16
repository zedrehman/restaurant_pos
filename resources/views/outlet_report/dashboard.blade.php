@extends('layouts.app')
@section('content')
<div class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-4">
            
            </div>
            <div class="col-sm-8">
            
            </div>
        </div>
    </div>
</div>
@endsection
@section('JsScript')
<script>
    var baseUrl = "{{url('/')}}";
    var _token = "{{ csrf_token() }}";
    var outlet_id = "{{$outlet_id}}";
</script>
<script src="{{ asset('validation/order_table.js') }}?version={{config('constant.script_version')}}"></script>
@endsection