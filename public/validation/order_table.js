let MenuItem = [];
$(document).ready(function () {
    let CategoryId = $("#hdnSelectedCategory").val();
    if (CategoryId == 0) {
        CategoryId = $('ul#ulMenuCategory li:first').attr('data-id');
        $('ul#ulMenuCategory li:first').addClass('text-bold');
        $('ul#ulMenuCategory li:first').addClass('text-success');
        $("#hdnSelectedCategory").val(CategoryId);
        GetMenuList(CategoryId);
    }
});

$(".divTable").click(function () {
    let TableId = $(this).attr('data-id');

    $('.divTable').each(function () {
        if ($(this).children('.card').hasClass('bg-info')) {
            $(this).children('.card').removeClass('bg-info');
            $(this).children('.card').addClass('bg-nifty-primary');
        }
    });

    $(this).children('.card').removeClass('bg-nifty-primary');
    $(this).children('.card').addClass('bg-info');
    let TableName = $(this).find('h4').html();
    $("#lblKOTtableNo").html(TableName);

    $("#hdnSelectedTable").val(TableId);

    let MenuITableIdtem = JSON.parse(localStorage.getItem('KOT_Table_' + TableId));
    if (MenuITableIdtem != null) {
        BindMenuBillItems(MenuITableIdtem);
    } else {
        BindMenuBillItems(MenuItem);
    }
});

$("#btnRefresh").click(function () {
    window.location.reload(true);
});

$("#btnLoadMenu").click(function () {
    let CategoryId = $("#hdnSelectedCategory").val();
    if (CategoryId == 0) {
        CategoryId = $('ul#ulMenuCategory li:first').attr('data-id');
        $('ul#ulMenuCategory li:first').addClass('text-bold');
        $('ul#ulMenuCategory li:first').addClass('text-success');
        $("#hdnSelectedCategory").val(CategoryId);
    }
    GetMenuList(CategoryId);
});

$(".listMenuCategory").click(function () {

    let CategoryId = $(this).attr('data-id');

    $('.listMenuCategory').removeClass('text-bold');
    $('.listMenuCategory').removeClass('text-success');
    $(this).addClass('text-bold');
    $(this).addClass('text-success');

    $("#hdnSelectedCategory").val(CategoryId);
    GetMenuList(CategoryId);
});

function GetMenuList(CategoryId) {
    $("#divMenuList").html('');
    $.ajax({
        url: baseUrl + '/outlet/menu-list-by-category-id/' + CategoryId,
        type: 'GET',
        success: function (response) {
            for (let i = 0; i < response.length; i++) {
                let MenuItem = `<div class="col-sm-4" style="padding: 0px;">
                                    <div class="card">
                                        <div class="card-body div-menu-item" style="padding: 10px 1.437rem;" data-id="${response[i].id}" data-name="${response[i].menu_name}" data-price="${response[i].sale_price}">
                                            <h4 style="margin-bottom: 0px;">${response[i].menu_name}</h4>
                                            <span style="float: left;">${response[i].short_code}</span> <span style="float: right;">Rs ${response[i].sale_price}</span><br>
                                            <small class="badge badge-info">${response[i].ready_in}</small>
                                        </div>
                                    </div>
                                </div>`;
                $("#divMenuList").append(MenuItem);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
            console.log(errorMsg)
        }
    });
}

$("#btnDineIn").click(function () {
    $(this).removeClass('btn-outline-dark');
    $(this).addClass('btn-outline-success');


    $("#btnPickUpDelivery").removeClass('btn-outline-success');
    $("#btnPickUpDelivery").addClass('btn-outline-dark');

    $("#btnQuickBill").removeClass('btn-outline-success');
    $("#btnQuickBill").addClass('btn-outline-dark');

    $("#hdnSelectedOrderType").val('Dine In');
});


$("#btnOrder_KOT").click(function () {
    let TableId = $("#hdnSelectedTable").val();
    let MenuITableIdtem = JSON.parse(localStorage.getItem('KOT_Table_' + TableId));
    if (MenuITableIdtem != null) {
        BindMenuBillItems(MenuITableIdtem);
    } else {
        BindMenuBillItems(MenuItem);
    }
    $("#divOrder_KOT").show();
    $("#divBilling").hide();

    $("#btnOrder_KOT").removeClass('btn-outline-dark');
    $("#btnOrder_KOT").addClass('btn-outline-success');

    $("#btnBilling").removeClass('btn-outline-success');
    $("#btnBilling").addClass('btn-outline-dark');
});

$("#btnBilling").click(function () {
    let TableId = $("#hdnSelectedTable").val();
    let MenuITableIdtem = JSON.parse(localStorage.getItem('KOT_Table_' + TableId));
    if (MenuITableIdtem != null) {
        BindViewMenuBillItems(MenuITableIdtem);
    } else {
        BindViewMenuBillItems(MenuItem);
    }
    $("#divOrder_KOT").hide();
    $("#divBilling").show();

    $("#btnBilling").removeClass('btn-outline-dark');
    $("#btnBilling").addClass('btn-outline-success');

    $("#btnOrder_KOT").removeClass('btn-outline-success');
    $("#btnOrder_KOT").addClass('btn-outline-dark');
});


$("#btnPickUpDelivery").click(function () {
    $(this).removeClass('btn-outline-dark');
    $(this).addClass('btn-outline-success');

    $("#btnDineIn").removeClass('btn-outline-success');
    $("#btnDineIn").addClass('btn-outline-dark');

    $("#btnQuickBill").removeClass('btn-outline-success');
    $("#btnQuickBill").addClass('btn-outline-dark');

    $("#hdnSelectedOrderType").val('Pick Up / Delivery');
});

$("#btnQuickBill").click(function () {
    $(this).removeClass('btn-outline-dark');
    $(this).addClass('btn-outline-success');

    $("#btnDineIn").removeClass('btn-outline-success');
    $("#btnDineIn").addClass('btn-outline-dark');

    $("#btnPickUpDelivery").removeClass('btn-outline-success');
    $("#btnPickUpDelivery").addClass('btn-outline-dark');

    $("#hdnSelectedOrderType").val('Quick Bill');
});


$("#divMenuList").on("click", ".div-menu-item", function () {
    let TableId = $("#hdnSelectedTable").val();
    if (TableId != 0) {

        let id = $(this).attr("data-id");
        let price = $(this).attr("data-price");
        let name = $(this).attr("data-name");

        let IsExist = 0;
        if (MenuItem != null) {
            for (let [i, menu] of MenuItem.entries()) {
                if (menu.id === id) {
                    IsExist = 1;
                    MenuItem[i].qty = MenuItem[i].qty + 1;
                }
            }
        }

        //let ExistsItem = MenuItem.filter(items => items.id == id);
        //console.log(ExistsItem);

        if (IsExist == 0) {
            let Items = {
                id: id,
                price: price,
                name: name,
                qty: 1
            };
            MenuItem.push(Items);
        }
        BindMenuBillItems(MenuItem);
    } else {
        alert('Table not selected');
    }
});

$("#tbodyKOTMenuBill").on("click", ".btnMenuBillItem", function () {
    let Id = $(this).attr('data-id');
    for (let [i, menu] of MenuItem.entries()) {
        if (menu.id === Id) {
            MenuItem.splice(i, 1); // Tim is now removed from "users"
        }
    }
    BindMenuBillItems(MenuItem);
});
$("#tbodyKOTMenuBill").on("change", ".txtQuantity", function () {
    let Id = $(this).attr('data-id');
    let Quantity = $(this).val();

    for (let [i, menu] of MenuItem.entries()) {
        if (menu.id === Id) {
            MenuItem[i].qty = Quantity;
        }
    }
    BindMenuBillItems(MenuItem);
});

function BindMenuBillItems(MenuItem) {
    $("#tbodyKOTMenuBill").html('');
    let TotalBillAmount = 0;
    if (MenuItem != null) {
        for (let i = 0; i < MenuItem.length; i++) {
            let Quantity = MenuItem[i].qty;
            let Amount = MenuItem[i].price;
            let TotalAmount = Amount * Quantity;
            TotalBillAmount += TotalAmount;
            let MenuBillItems = `<tr id="trmenubill_${MenuItem[i].id}">
                                <td>
                                    <a class="badge badge-danger btnMenuBillItem" data-id="${MenuItem[i].id}">x</a>${MenuItem[i].name}
                                </td>
                                <td>
                                    <input type="number" class="txtQuantity" style="width: 100%;" value="${Quantity}" data-id="${MenuItem[i].id}">
                                </td>
                                <td>
                                    <b>${TotalAmount}</b>
                                    <span>(${Amount})</span>
                                </td>
                            </tr>`;
            $("#tbodyKOTMenuBill").append(MenuBillItems);
        }
    }
    $("#lblTotalKOTBillAmount").html(TotalBillAmount.toFixed(2));

    let TableId = $("#hdnSelectedTable").val();
    localStorage.setItem('KOT_Table_' + TableId, JSON.stringify(MenuItem));
}

function BindViewMenuBillItems(MenuItem) {
    $("#tbodyBillingMenu").html('');
    let TotalBillAmount = 0;
    if (MenuItem != null) {
        for (let i = 0; i < MenuItem.length; i++) {
            let Quantity = MenuItem[i].qty;
            let Amount = MenuItem[i].price;
            let TotalAmount = Amount * Quantity;
            TotalBillAmount += TotalAmount;
            let MenuBillItems = `<tr>
                                    <td>${MenuItem[i].name}</td>
                                    <td style="text-align: right;">${Quantity}</td>
                                    <td style="text-align: right;">${TotalAmount}</td>
                                </tr>`;
            $("#tbodyBillingMenu").append(MenuBillItems);
        }
    }
    $("#lblTotalBillAmount").html(TotalBillAmount.toFixed(2));

    let TableId = $("#hdnSelectedTable").val();
    localStorage.setItem('KOT_Table_' + TableId, JSON.stringify(MenuItem));
}

$("#btnSavePrintKOT").click(function () {
    let TableId = $("#hdnSelectedTable").val();
    if (TableId != 0) {
        if (MenuItem != null) {
            //localStorage.setItem('KOT_Table_bill_' + TableId, JSON.stringify(MenuItem));
        }
        //localStorage.removeItem('KOT_Table_' + TableId);
    }
});