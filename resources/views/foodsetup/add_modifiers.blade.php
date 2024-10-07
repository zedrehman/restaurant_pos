@extends('layouts.admin')
@section('dashboard_bar')
Modifiers
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <input type="hidden" id="hdnId" value="@if(isset($ModifierList)){{ $ModifierList->id }}@endif">
                <input type="hidden" id="hdnOutletId" value="@if(isset($ModifierList)){{ $ModifierList->outlet_id }}@endif">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Outlets <span style="color:red;">*</span> </label>
                            <select class="form-control" name="outlet_id" id="ddlOutlet" required>
                                <option value="0">--Outlet--</option>
                                @foreach ($outlets as $outlet)
                                <option value="{{$outlet->id}}" @if(isset($ModifierList) && $outlet->id == $ModifierList->outlet_id) selected @endif> {{ $outlet->outlet_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Name <span style="color:red;">*</span></label>
                            <input type="text" id="txtModifiername" class="form-control" placeholder="Name" value="@if(isset($ModifierList)){{ $ModifierList->modifier_name }}@endif" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Ingredient Name</th>
                                    <th>Consumption QTY</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tbodyIngredient">
                                <?php
                                $RowIndex = 1;
                                ?>
                                @if(isset($ModifiersIngredient))

                                @foreach ($ModifiersIngredient as $item)
                                <tr id="tr_{{ $RowIndex}}">
                                    <td>
                                        @if(isset($IngrediantList))
                                        <select class="form-control" id="ddlIngredient_{{ $RowIndex}}">
                                            @foreach ($IngrediantList as $Ing)
                                            <option value="{{$Ing->id}}" @if($item->ingrediant_id == $Ing->id) selected @endif> {{ $Ing->ingrediant_name }}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" id="txtQuantity_{{ $RowIndex}}" class="form-control" value="{{ $item->quantity}}">
                                    </td>
                                    <td>
                                        <a class="text-danger btnDelete" href="javascript:void(0)" id="btnDelete_{{ $RowIndex}}" data-id="{{ $item->id}}"><i class="fa fa-close color-danger"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $RowIndex++;
                                ?>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-sm btn-success" id="btnSave">Save</button>
                    </div>
                    <div class="col-sm-6" style="text-align: right;">
                        <button type="submit" class="btn btn-sm btn-info" id="btnAddItem">Add Item</button>
                    </div>
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
    let IngrediantList = <?php echo $Json_Ingrediant; ?>
</script>
<script src="{{ asset('validation/add_modifiers.js') }}?version={{config('constant.script_version')}}"></script>
@endsection