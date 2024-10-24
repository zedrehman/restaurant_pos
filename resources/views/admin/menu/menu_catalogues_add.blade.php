@extends('layouts.admin')

@section('dashboard_bar')
Items
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!--<form action="{{url('/admin/menu-management/add-menu-catalogues')}}" method="POST" enctype="multipart/form-data">-->
                <form id="data-form">
                    @csrf
                    <input type="hidden" name="tableId" value="@if(isset($dataArray)){{ $dataArray->id }}@endif">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Outlets <span style="color:red;">*</span> </label>
                                <select class="form-control" name="outlet_id" id="ddlOutlet" required>
                                    <option value="0">--Outlet--</option>
                                    @foreach ($outlets as $outlet)
                                    <option value="{{$outlet->id}}" @if(isset($dataArray) && $outlet->id == $dataArray->outlet_id) selected @endif> {{ $outlet->outlet_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Short code <span style="color:red;">*</span> </label>
                                <input type="text" name="short_code" class="form-control" placeholder="Short code" value="@if(isset($dataArray)){{ $dataArray->short_code }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>Menu name <span style="color:red;">*</span> </label>
                                <input type="text" name="menu_name" class="form-control" placeholder="Short code" value="@if(isset($dataArray)){{ $dataArray->menu_name }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Category name <span style="color:red;">*</span> </label>
                                <select class="form-control" name="menu_categories_id" required>
                                    <option value="">Select Category</option>
                                    @foreach ($menuCategory as $category)
                                    <option value="{{$category->id}}" @if(isset($dataArray) && $dataArray->menu_categories_id == $category->id) selected @endif> {{ $category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Kitchen Department <span style="color:red;">*</span> </label>
                                <select class="form-control" id="ddlKitchenDepartment" name="kitchen_department_id" required>
                                    <option value="">-- Select --</option>
                                    @foreach ($KitchenDepartment as $kd)
                                    <option value="{{$kd->id}}" @if(isset($dataArray) && $dataArray->kitchen_department_id == $kd->id) selected @endif> {{ $kd->kitchen_department_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Sale Price<span style="color:red;">*</span> </label>
                                <input type="number" name="sale_price" class="form-control" placeholder="Sale Price" value="@if(isset($dataArray)){{ $dataArray->sale_price }}@endif" required>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Current Stock</label>
                                <input type="text" name="current_stock" class="form-control" placeholder="Current Stock" value="@if(isset($dataArray)){{ $dataArray->current_stock }}@endif">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Ready In(Min)</label>
                                <input type="number" name="ready_in" class="form-control" placeholder="Ready In" value="@if(isset($dataArray)){{ $dataArray->ready_in }}@endif">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>food type <span style="color:red;">*</span> </label>
                                <select class="form-control" name="food_type" required>
                                    <option value="">Select food type</option>
                                    @foreach ($foodType as $food)
                                    <option value="{{$food->id}}" @if(isset($dataArray) && $dataArray->food_type == $food->id) selected @endif> {{ $food->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" placeholder="logo" accept="image/png, image/gif, image/jpeg, image/jpg">
                            </div>
                        </div>
                        @if (isset($dataArray->image) )
                        <div class="col-sm-1" style="padding-top: 20px;">
                            <img src="{{ asset('menu/menu_catalogues/'.$dataArray->image) }}" width="100%">
                        </div>
                        @endif
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>&nbsp;</label><br>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="active" class="form-check-input" @if(isset($dataArray) && $dataArray->active == 1) checked @endif> Active
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Description </label>
                                <input type="text" name="description" class="form-control" placeholder="Description" value="@if(isset($dataArray)){{ $dataArray->description }}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                                @if(isset($MenuIngredient))

                                @foreach ($MenuIngredient as $item)
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
                    <div class="row">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-sm btn-success" id="btnSubmit">Submit</button>
                            <a type="submit" class="btn btn-sm btn-dark" id="btnSaving" style="display: none;">Saving...</a>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <button type="button" class="btn btn-sm btn-info" id="btnAddItem">Add Item</button>
                        </div>
                    </div>
                </form>
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
    //console.log(IngrediantList);
</script>
<script src="{{ asset('validation/menu_catalogues_add.js') }}?version={{config('constant.script_version')}}"></script>
@endsection