$("#ddlOutlet").change(function () {
    let outlet_id = $(this).val();
    if (outlet_id != 0) {
        $.ajax({
            url: baseUrl + '/foodsetup/GetIngrediantByOutletId',
            type: 'post',
            data: { "_token": _token, outlet_id: outlet_id },
            success: function (response) {
                IngrediantList = response;
                $("#tbodyIngredient").html('');
                $("#btnAddItem").trigger('click');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
                console.log(errorMsg)
            }
        });
    }
})
$("#btnAddItem").click(function () {
    let ItemCount = $("#tbodyIngredient tr").length;
    let RowIndex = ItemCount + 1;
    let ddlIngredientOP = '';
    for (let i = 0; i < IngrediantList.length; i++) {
        ddlIngredientOP += '<option value="' + IngrediantList[i].id + '">' + IngrediantList[i].ingrediant_name + '</option>';
    }
    let strHtml = `<tr id="tr_${RowIndex}">
                        <td>
                            <select class="form-control" id="ddlIngredient_${RowIndex}">${ddlIngredientOP}</select>
                        </td>
                        <td>
                            <input type="text" id="txtQuantity_${RowIndex}" class="form-control">
                        </td>
                        <td>
                            <a class="text-danger btnDelete" href="javascript:void(0)" id="btnDelete_${RowIndex}" data-id="0"><i class="fa fa-close color-danger"></i></a>
                        </td>
                    </tr>`;
    $("#tbodyIngredient").append(strHtml);
});

$("#tbodyIngredient").on('click', '.btnDelete', function () {
    let MainId = $(this).attr("id");
    
    let Id = $(this).attr("data-id");
    let tr = MainId.replace("btnDelete", "tr");
    $("#" + tr).remove();

    if (Id != 0) {
        $.ajax({
            url: baseUrl + '/admin/menu-management/delete-menu-ingredient',
            type: 'post',
            data: { "_token": _token, Id: Id },
            success: function (response) {

            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
                console.log(errorMsg)
            }
        });
    }
});

$("#btnSubmit").on('click', function (e) {
    e.preventDefault();

    let IngrediantItem = [];
    $("#tbodyIngredient tr").each(function () {
        let Ingredient = $(this).find('select').val();
        let Quantity = $(this).find('input').val();
        let Item = {
            IngredientId: Ingredient,
            Quantity: Quantity
        };
        IngrediantItem.push(Item);
    });

    let tableId = $("input[name=tableId]").val();
    let outlet_id = $("select[name=outlet_id]").val();
    let short_code = $("input[name=short_code]").val();
    let menu_name = $("input[name=menu_name]").val();
    let menu_categories_id = $("select[name=menu_categories_id]").val();
    let sale_price = $("input[name=sale_price]").val();
    let current_stock = $("input[name=current_stock]").val();
    let ready_in = $("input[name=ready_in]").val();
    let food_type = $("select[name=food_type]").val();
    let image = $("input[name=image]")[0];
    let active = $("input[name=active]").val();

    let description = $("input[name=description]").val();


    let formData = new FormData();
    formData.append('_token', _token);
    formData.append('tableId', tableId);
    formData.append('outlet_id', outlet_id);
    formData.append('short_code', short_code);
    formData.append('menu_name', menu_name);
    formData.append('menu_categories_id', menu_categories_id);
    formData.append('sale_price', sale_price);
    formData.append('current_stock', current_stock);
    formData.append('ready_in', ready_in);
    formData.append('food_type', food_type);
    if (image.files.length > 0) {
        formData.append('image', image.files[0]);
    }
    formData.append('active', active);
    //formData.append('active1', active1);
    formData.append('description', description);
    formData.append('IngrediantItem', JSON.stringify(IngrediantItem));

    $.ajax({
        url: baseUrl + '/admin/menu-management/add-menu-catalogues',
        type: 'POST',
        contentType: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: (response) => {
            console.log(response);
            alert('Record Saved Successfully');
            window.location.href = baseUrl + '/admin/menu-management/menu-catalogues';
        },
        error: (response) => {
            console.log(response);
        }
    });

});