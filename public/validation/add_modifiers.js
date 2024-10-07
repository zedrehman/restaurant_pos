
$(document).ready(function () {

});

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
                            <a class="text-danger btnDelete" href="javascript:void(0)" id="btnDelete_${RowIndex}" data-id=""><i class="fa fa-close color-danger"></i></a>
                        </td>
                    </tr>`;
    $("#tbodyIngredient").append(strHtml);
});

$("#tbodyIngredient").on('click', '.btnDelete', function () {
    let MainId = $(this).attr("id");
    console.log(MainId);
    
    let Id = $(this).attr("data-id");
    let tr = MainId.replace("btnDelete", "tr");
    $("#" + tr).remove();

    if (Id != 0) {
        $.ajax({
            url: baseUrl + '/foodsetup/DeleteModifiersIngredient',
            type: 'post',
            data: { "_token": _token, Id: Id },
            success: function (response) { },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
                console.log(errorMsg)
            }
        });
    }
});

$("#btnSave").click(function () {
    let IngrediantItem = [];
    let Id = $("#hdnId").val();
    if (Id == '') {
        Id = 0;
    }
    let OutletId = $("#ddlOutlet").val();
    let Modifiername = $("#txtModifiername").val();
    if (OutletId != 0 && Modifiername != "") {
        $("#tbodyIngredient tr").each(function () {
            let Ingredient = $(this).find('select').val();
            let Quantity = $(this).find('input').val();
            let Item = {
                IngredientId: Ingredient,
                Quantity: Quantity
            };
            IngrediantItem.push(Item);
        });

        if (IngrediantItem.length > 0) {
            $.ajax({
                url: baseUrl + '/foodsetup/SaveModifiers',
                type: 'post',
                data: {
                    "_token": _token,
                    Id: Id,
                    OutletId: OutletId,
                    Modifiername: Modifiername,
                    IngrediantItem: IngrediantItem
                },
                success: function (response) {
                    alert('Record Saved Successfully');
                    window.location.href = baseUrl + '/foodsetup/modifiers';
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
                    console.log(errorMsg)
                }
            });
        }
    }

});