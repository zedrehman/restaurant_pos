@extends('layouts.admin')
@section('dashboard_bar')
Ingrediant
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <table class="table table-bordered table-responsive-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Available Stock</th>
                            <th>Unit</th>
                            <th>Price/Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($IngrediantList as $Items)
                        <tr>
                            <td> {{ $Items->ingrediant_name }} </td>
                            <td> {{ $Items->unit_name }} </td>
                            <td> {{ $Items->unit_name }} </td>
                            <td>
                                <input type="text" id="ingrediant_stock_{{ $Items->id }}" class="form-control ingrediant_stock" data-id="{{ $Items->id }}" data-outlet_id="{{ $Items->outlet_id }}" value="">
                            </td>
                            <td>
                                <input type="text" id="ingrediant_price_{{ $Items->id }}" class="form-control" value="">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-sm-12">
                    <button type="button" id="btnSave" class="btn btn-sm btn-success">Save Stock</button>
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

    $("#btnSave").click(function() {
        let IngrediantStock = [];
        $('.ingrediant_stock').each(function() {
            let Id = $(this).attr('id');
            let IngrediantPrice = Id.replace("ingrediant_stock", "ingrediant_price");
            let ingrediant_id = $(this).attr('data-id');
            let outlet_id = $(this).attr('data-outlet_id');
            
            if ($(this).val() != "") {
                let stock_value = $(this).val();
                let ingrediant_price = $("#" + IngrediantPrice).val();

                let Item = {
                    ingrediant_id: ingrediant_id,
                    outlet_id: outlet_id,
                    stock_value: stock_value,
                    ingrediant_price: ingrediant_price
                }
                IngrediantStock.push(Item);
            }
        });

        if (IngrediantStock.length > 0) {
            $.ajax({
                url: baseUrl + '/foodsetup/saveingrediantstock',
                type: 'post',
                data: {
                    "_token": _token,
                    IngrediantStock: IngrediantStock
                },
                success: function(response) {
                    window.location.href = baseUrl + '/foodsetup/ingrediant';
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
                    console.log(errorMsg)
                }
            });
        }
    });
</script>
@endsection