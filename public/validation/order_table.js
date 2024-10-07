let MenuItem = [];
let PD_MenuItem = [];
let Q_MenuItem = [];
$(document).ready(function () {
    let CategoryId = $("#hdnSelectedCategory").val();
    if (CategoryId == 0) {
        if ($('ul#ulMenuCategory li').length > 0) {
            CategoryId = $('ul#ulMenuCategory li:first').attr('data-id');
            $('ul#ulMenuCategory li:first').addClass('text-bold');
            $('ul#ulMenuCategory li:first').addClass('text-success');
        }
        $("#hdnSelectedCategory").val(CategoryId);
        GetMenuList(CategoryId);
    }
    //$('#divChannelListToLabModel').modal('show');
});

$(".divTable").click(function () {
    let TableId = $(this).attr('data-id');

    $('.divTable').each(function () {
        let SelectedTableId = $(this).attr('data-tableId');
        if (SelectedTableId == 0) {
            if ($(this).children('.card').hasClass('bg-info')) {
                $(this).children('.card').removeClass('bg-info');
                $(this).children('.card').addClass('bg-nifty-primary');
            }
        }
    });

    $(this).children('.card').removeClass('bg-nifty-primary');
    $(this).children('.card').addClass('bg-info');
    let TableName = $(this).find('h4').html();
    $("#lblKOTtableNo").html(TableName);

    $("#hdnSelectedTable").val(TableId);

    GetTableBillDetails(TableId);

    let MenuITableIdtem = JSON.parse(localStorage.getItem('KOT_Table_' + TableId));
    if (MenuITableIdtem != null) {
        MenuItem = MenuITableIdtem;
    }
    $('#btnOrder_KOT').trigger('click');
    //BindMenuBillItems(MenuItem);
});
$(".divPDTable").click(function () {
    let Order_Id = $(this).attr('data-id');
    $.ajax({
        url: baseUrl + '/outlet/order-details-byid/' + Order_Id,
        type: 'GET',
        success: function (response) {
            let order_table = response.order_table
            let order_table_menu_items = response.order_table_menu_items
            //console.log(response.order_table);
            //console.log(response.order_table_menu_items);
            /*if (response != null) {
                
            }*/
            $("#lblKOTNumber").html(order_table.kot);
            $("#hdnOrderId").val(Order_Id);
            $('#btnBilling').trigger('click');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
            console.log(errorMsg);
        }
    });
});

function GetTableBillDetails(TableId) {
    $("#lblKOTNumber").html(0);
    $("#hdnOrderId").val(0);

    $.ajax({
        url: baseUrl + '/outlet/order-table-details/' + TableId,
        type: 'GET',
        success: function (response) {
            console.log(response);
            if (response != null) {
                $("#lblKOTNumber").html(response.kot);
                $("#hdnOrderId").val(response.id);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
            console.log(errorMsg)
        }
    });
}

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
        url: baseUrl + '/outlet/menu-list-by-category-id/' + CategoryId + '/' + outlet_id,
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

    $("#divQuickBill").hide();
    $("#divDineIn").show();
    $("#divOrder_KOT").show();
    $("#divBilling").hide();

    $("#btnPickUpDelivery_NewBill").hide();
    $("#tbodyKOTMenuBill").html('');

    $("#divTableList").show();
    $("#divPDOrderList").hide();

    $("#hdnOrderId").val('0');
    $("#lblKOTNumber").html(0);
});


$("#btnOrder_KOT").click(function () {
    let OrderType = $("#hdnSelectedOrderType").val();
    if (OrderType == 'Dine In') {
        let TableId = $("#hdnSelectedTable").val();
        let MenuITableIdtem = JSON.parse(localStorage.getItem('KOT_Table_' + TableId));
        if (MenuITableIdtem != null) {
            BindMenuBillItems(MenuITableIdtem);
        } else {
            BindMenuBillItems(MenuItem);
        }
    }

    if (OrderType == 'Pick Up / Delivery') {
        let PD_MenuITableIdtem = JSON.parse(localStorage.getItem('PD_KOT_Table'));
        if (PD_MenuITableIdtem != null) {
            PD_BindMenuBillItems(PD_MenuITableIdtem);
        }
    }

    $("#divOrder_KOT").show();
    $("#divBilling").hide();

    $("#btnOrder_KOT").removeClass('btn-outline-dark');
    $("#btnOrder_KOT").addClass('btn-outline-success');

    $("#btnBilling").removeClass('btn-outline-success');
    $("#btnBilling").addClass('btn-outline-dark');
});

$("#btnBilling").click(function () {
    let OrderType = $("#hdnSelectedOrderType").val();
    let OrderId = $("#hdnOrderId").val();

    if (OrderType == 'Dine In') {
        let TableId = $("#hdnSelectedTable").val();
        if (TableId != 0) {

            BindViewMenuBillItems(OrderId);

            $("#divOrder_KOT").hide();
            $("#divBilling").show();

            $("#btnBilling").removeClass('btn-outline-dark');
            $("#btnBilling").addClass('btn-outline-success');

            $("#btnOrder_KOT").removeClass('btn-outline-success');
            $("#btnOrder_KOT").addClass('btn-outline-dark');
        } else {
            alert('Select Table to view the bill')
        }
    }
    if (OrderType == 'Pick Up / Delivery') {
        //do nothing
        PD_BindViewMenuBillItems(OrderId);

        $("#divOrder_KOT").hide();
        $("#divBilling").show();

        $("#btnBilling").removeClass('btn-outline-dark');
        $("#btnBilling").addClass('btn-outline-success');

        $("#btnOrder_KOT").removeClass('btn-outline-success');
        $("#btnOrder_KOT").addClass('btn-outline-dark');
    }

});


$("#btnPickUpDelivery").click(function () {
    $(this).removeClass('btn-outline-dark');
    $(this).addClass('btn-outline-success');

    $("#btnDineIn").removeClass('btn-outline-success');
    $("#btnDineIn").addClass('btn-outline-dark');

    $("#btnQuickBill").removeClass('btn-outline-success');
    $("#btnQuickBill").addClass('btn-outline-dark');

    $("#hdnSelectedOrderType").val('Pick Up / Delivery');

    $("#btnPickUpDelivery_NewBill").show();
    $("#divQuickBill").hide();
    $("#divDineIn").show();
    $("#divOrder_KOT").show();
    $("#divBilling").hide();

    $("#divTableList").hide();
    $("#divPDOrderList").show();

    $("#hdnOrderId").val('0');
    $("#lblKOTNumber").html(0);

    let PD_MenuITableIdtem = JSON.parse(localStorage.getItem('PD_KOT_Table'));
    if (PD_MenuITableIdtem != null) {
        PD_MenuItem = PD_MenuITableIdtem;
    }
    PD_BindMenuBillItems(PD_MenuItem);
});

$("#btnQuickBill").click(function () {
    $(this).removeClass('btn-outline-dark');
    $(this).addClass('btn-outline-success');

    $("#btnDineIn").removeClass('btn-outline-success');
    $("#btnDineIn").addClass('btn-outline-dark');

    $("#btnPickUpDelivery").removeClass('btn-outline-success');
    $("#btnPickUpDelivery").addClass('btn-outline-dark');

    $("#hdnSelectedOrderType").val('Quick Bill');

    $("#divQuickBill").show();
    $("#divDineIn").hide();
    $("#divOrder_KOT").hide();
    $("#divBilling").hide();

    $("#btnPickUpDelivery_NewBill").hide();

    $("#hdnOrderId").val('0');
    $("#lblKOTNumber").html(0);

    let Q_MenuITableIdtem = JSON.parse(localStorage.getItem('Q_KOT_Table'));
    if (Q_MenuITableIdtem != null) {
        Q_MenuItem = Q_MenuITableIdtem;
        Q_BindMenuBillItems(Q_MenuItem);

        let QuickBillType = localStorage.getItem('QuickBillType');
        $("#hdnQuickBillType").val(QuickBillType);
    } else {
        $('#divQuickBillTypeModel').modal('show');
    }

});


$("#divMenuList").on("click", ".div-menu-item", function () {
    let OrderType = $("#hdnSelectedOrderType").val();
    if (OrderType == 'Dine In') {
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
    }

    if (OrderType == 'Pick Up / Delivery') {
        let id = $(this).attr("data-id");
        let price = $(this).attr("data-price");
        let name = $(this).attr("data-name");

        let IsExist = 0;
        if (PD_MenuItem != null) {
            for (let [i, menu] of PD_MenuItem.entries()) {
                if (menu.id === id) {
                    IsExist = 1;
                    PD_MenuItem[i].qty = PD_MenuItem[i].qty + 1;
                }
            }
        }
        if (IsExist == 0) {
            let Items = {
                id: id,
                price: price,
                name: name,
                qty: 1
            };
            PD_MenuItem.push(Items);
        }
        PD_BindMenuBillItems(PD_MenuItem);
    }

    if (OrderType == 'Quick Bill') {
        let id = $(this).attr("data-id");
        let price = $(this).attr("data-price");
        let name = $(this).attr("data-name");

        let IsExist = 0;
        if (Q_MenuItem != null) {
            for (let [i, menu] of Q_MenuItem.entries()) {
                if (menu.id === id) {
                    IsExist = 1;
                    Q_MenuItem[i].qty = Q_MenuItem[i].qty + 1;
                }
            }
        }
        if (IsExist == 0) {
            let Items = {
                id: id,
                price: price,
                name: name,
                qty: 1
            };
            Q_MenuItem.push(Items);
        }
        Q_BindMenuBillItems(Q_MenuItem);
    }
});

$("#tbodyKOTMenuBill").on("click", ".btnMenuBillItem", function () {
    let OrderType = $("#hdnSelectedOrderType").val();
    let Id = $(this).attr('data-id');

    if (OrderType == 'Dine In') {

        for (let [i, menu] of MenuItem.entries()) {
            if (menu.id === Id) {
                MenuItem.splice(i, 1); // Tim is now removed from "users"
            }
        }
        BindMenuBillItems(MenuItem);
    }
    if (OrderType == 'Pick Up / Delivery') {
        for (let [i, menu] of PD_MenuItem.entries()) {
            if (menu.id === Id) {
                PD_MenuItem.splice(i, 1); // Tim is now removed from "users"
            }
        }
        PD_BindMenuBillItems(PD_MenuItem);
    }
});
$("#tbodyKOTMenuBill").on("change", ".txtQuantity", function () {
    let OrderType = $("#hdnSelectedOrderType").val();
    let Id = $(this).attr('data-id');
    let Quantity = $(this).val();

    if (OrderType == 'Dine In') {
        for (let [i, menu] of MenuItem.entries()) {
            if (menu.id === Id) {
                MenuItem[i].qty = Quantity;
            }
        }
        BindMenuBillItems(MenuItem);
    }
    if (OrderType == 'Pick Up / Delivery') {
        for (let [i, menu] of PD_MenuItem.entries()) {
            if (menu.id === Id) {
                PD_MenuItem[i].qty = Quantity;
            }
        }
        PD_BindMenuBillItems(PD_MenuItem);
    }


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
function PD_BindMenuBillItems(MenuItem) {
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
    localStorage.setItem('PD_KOT_Table', JSON.stringify(MenuItem));
}

function Q_BindMenuBillItems(MenuItem) {
    $("#tbodyQuickBill").html('');
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
            $("#tbodyQuickBill").append(MenuBillItems);
        }
    }
    $("#lblQuickTotalBillAmount").html(TotalBillAmount.toFixed(2));
    localStorage.setItem('Q_KOT_Table', JSON.stringify(MenuItem));
}
$("#tbodyQuickBill").on("click", ".btnMenuBillItem", function () {
    let Id = $(this).attr('data-id');
    for (let [i, menu] of Q_MenuItem.entries()) {
        if (menu.id === Id) {
            Q_MenuItem.splice(i, 1); // Tim is now removed from "users"
        }
    }
    Q_BindMenuBillItems(Q_MenuItem);
});
$("#tbodyQuickBill").on("change", ".txtQuantity", function () {
    let Id = $(this).attr('data-id');
    let Quantity = $(this).val();

    for (let [i, menu] of Q_MenuItem.entries()) {
        if (menu.id === Id) {
            Q_MenuItem[i].qty = Quantity;
        }
    }
    Q_BindMenuBillItems(Q_MenuItem);
});

function BindViewMenuBillItems(OrderId) {
    $("#tbodyBillingMenu").html('');
    $("#lblTotalBillAmount").html('0');
    $.ajax({
        url: baseUrl + '/outlet/order-table-mneu-details/' + OrderId,
        type: 'GET',
        success: function (response) {
            console.log(response);
            let TotalBillAmount = 0;
            for (let i = 0; i < response.length; i++) {
                let Quantity = response[i].quantity;
                let Amount = response[i].amount;
                let TotalAmount = response[i].total;
                TotalBillAmount += eval(TotalAmount);
                let MenuBillItems = `<tr>
                                        <td style="width: 60%;">${response[i].menu_name}</td>
                                        <td style="text-align: right;width: 10%;">${Quantity}</td>
                                        <td style="text-align: right;width: 30%;"><b>${TotalAmount}</b></td>
                                    </tr>`;
                $("#tbodyBillingMenu").append(MenuBillItems);
            }
            $("#lblTotalBillAmount").html(TotalBillAmount);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
            console.log(errorMsg)
        }
    });
}

function PD_BindViewMenuBillItems(OrderId) {
    $("#tbodyBillingMenu").html('');
    $("#lblTotalBillAmount").html('0');
    $.ajax({
        url: baseUrl + '/outlet/order-table-mneu-details/' + OrderId,
        type: 'GET',
        success: function (response) {
            console.log(response);
            let TotalBillAmount = 0;
            for (let i = 0; i < response.length; i++) {
                let Quantity = response[i].quantity;
                let Amount = response[i].amount;
                let TotalAmount = response[i].total;
                TotalBillAmount += eval(TotalAmount);
                let MenuBillItems = `<tr>
                                        <td style="width: 60%;">${response[i].menu_name}</td>
                                        <td style="text-align: right;width: 10%;">${Quantity}</td>
                                        <td style="text-align: right;width: 30%;"><b>${TotalAmount}</b></td>
                                    </tr>`;
                $("#tbodyBillingMenu").append(MenuBillItems);
            }
            $("#lblTotalBillAmount").html(TotalBillAmount);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
            console.log(errorMsg)
        }
    });
}

$("#btnSavePrintKOT").click(function () {
    let CustomerName = $("#txtCustomerName").val();
    let MobileNo = $("#txtMobileNo").val();
    let Address = $("#txtAddress").val();
    let KotNote = $("#txtKotNote").val();

    let OrderType = $("#hdnSelectedOrderType").val();
    if (OrderType == 'Dine In') {
        let TableId = $("#hdnSelectedTable").val();
        if (TableId != 0) {
            if (MenuItem != null) {
                //console.log(MenuItem);
                $("#btnSavePrintKOT").html('Saving KOT.....');

                $.ajax({
                    url: baseUrl + '/outlet/save-print-kot',
                    type: 'post',
                    data: {
                        "_token": _token,
                        MenuItem: MenuItem,
                        TableId: TableId,
                        CustomerName: CustomerName,
                        MobileNo: MobileNo,
                        Address: Address,
                        KotNote: KotNote,
                        BillType: OrderType
                    },
                    success: function (response) {
                        console.log(response);
                        $("#btnSavePrintKOT").html('Save & Print KOT');
                        MenuItem = [];
                        localStorage.removeItem('KOT_Table_' + TableId);
                        $("#tbodyKOTMenuBill").html('');
                        $("#hdnOrderId").val(response.OrderId);
                        $("#lblKOTNumber").html(response.KOTId);
                        $("#btnBilling").trigger('click');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
                        console.log(errorMsg)
                    }
                });
            }
        }
    }

    if (OrderType == 'Pick Up / Delivery') {
        if (PD_MenuItem != null) {
            //console.log(MenuItem);
            $("#btnSavePrintKOT").html('Saving KOT.....');
            $.ajax({
                url: baseUrl + '/outlet/save-print-kot',
                type: 'post',
                data: {
                    "_token": _token,
                    MenuItem: PD_MenuItem,
                    TableId: 0,
                    CustomerName: CustomerName,
                    MobileNo: MobileNo,
                    Address: Address,
                    KotNote: KotNote,
                    BillType: OrderType,
                    Pd_kOT_ID: 0
                },
                success: function (response) {
                    console.log(response);
                    $("#btnSavePrintKOT").html('Save & Print KOT');
                    PD_MenuItem = [];
                    localStorage.removeItem('PD_KOT_Table');
                    $("#tbodyKOTMenuBill").html('');
                    $("#hdnOrderId").val(response.OrderId);
                    $("#lblKOTNumber").html(response.KOTId);
                    $("#btnBilling").trigger('click');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
                    console.log(errorMsg)
                }
            });
        }
    }

});

$("#btnSavePrintBill").click(function () {
    let OrderType = $("#hdnSelectedOrderType").val();

    let TableId = $("#hdnSelectedTable").val();
    let OrderId = $("#hdnOrderId").val();

    if (OrderId != 0) {
        $("#btnSavePrintBill").html('Saving Bill....');
        $.ajax({
            url: baseUrl + '/outlet/save-print-bill',
            type: 'post',
            data: {
                "_token": _token,
                OrderId: OrderId,
                TableId: TableId,
                OrderType: OrderType
            },
            success: function (response) {
                alert('Bill Saved');
                $("#btnSavePrintBill").html('Save & Print Bill');

                let TotalBillAmount = $("#lblTotalBillAmount").html();
                $("#divtbl_" + TableId).removeClass('bg-info');
                $("#divtbl_" + TableId).addClass('bg-dark');
                $("#divtbl_" + TableId).find('.table-amount').html('Rs: ' + eval(TotalBillAmount).toFixed(2));
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
                console.log(errorMsg)
            }
        });
    } else {
        alert('No Bill Found');
    }
});

$("#btnPayment").click(function () {
    let TableId = $("#hdnSelectedTable").val();
    let OrderId = $("#hdnOrderId").val();
    if (OrderId != 0) {
        let TotalAmount = $("#lblTotalBillAmount").html();
        $("#divGrandTotal").html('<b>Grand Total </b>: ' + TotalAmount);
        $('#divChannelListToLabModel').modal('show');
    } else {
        alert('Order not found for Payment')
    }
});

$("#btnCloseModel").click(function () {
    $("#divGrandTotal").html('');
    $('#divChannelListToLabModel').modal('hide');
});

$(".payment-mode").click(function () {
    let PaymentMode = $(this).attr('data-value');
    $("#hdnPaymentMode").val(PaymentMode);
    $(".payment-mode").removeClass("payment-border");
    $(this).addClass("payment-border");
});

$("#btnSavePaymentAndSettleBill").click(function () {
    let OrderType = $("#hdnSelectedOrderType").val();
    let PaymentMode = $("#hdnPaymentMode").val();

    if (OrderType == 'Quick Bill') {

        SaveQuickBill(PaymentMode);
        alert('Payment done');
        window.location.reload(true);
    } else {
        let TableId = $("#hdnSelectedTable").val();
        let OrderId = $("#hdnOrderId").val();
        if (OrderId != 0) {
            $.ajax({
                url: baseUrl + '/outlet/save-payment-bill',
                type: 'post',
                data: {
                    "_token": _token,
                    OrderId: OrderId,
                    TableId: TableId,
                    PaymentMode: PaymentMode
                },
                success: function (response) {
                    alert('Payment done and Bill Settled');
                    window.location.reload(true);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
                    console.log(errorMsg)
                }
            });
        }
    }

});

$("#btnSettleBill").click(function () {
    let TableId = $("#hdnSelectedTable").val();
    let OrderId = $("#hdnOrderId").val();
    if (OrderId != 0) {
        $("#btnSettleBill").html('Settlling Bill....');
        $.ajax({
            url: baseUrl + '/outlet/settle-bill',
            type: 'post',
            data: {
                "_token": _token,
                OrderId: OrderId,
                TableId: TableId
            },
            success: function (response) {
                alert('Bill Settled');
                window.location.reload(true);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
                console.log(errorMsg)
            }
        });
    } else {
        alert('Bill not found to settle');
    }
});

$(".btnQuickBillType").click(function () {
    let QuickBillType = $(this).attr("data-value");
    $("#hdnQuickBillType").val(QuickBillType);
    localStorage.setItem('QuickBillType', QuickBillType);

    $('#divQuickBillTypeModel').modal('hide');
});

$("#btnQuickBillPayment").click(function () {
    if (Q_MenuItem.length != 0) {
        let TotalAmount = $("#lblQuickTotalBillAmount").html();
        $("#divGrandTotal").html('<b>Grand Total </b>: ' + TotalAmount);
        $('#divChannelListToLabModel').modal('show');
    } else {
        alert('Please Add Item in Bill');
    }
});

$("#btnQuickBillSettleBill").click(function () {
    if (Q_MenuItem.length != 0) {
        SaveQuickBill('');
        alert('Quick Bill Settled');
        window.location.reload(true);
    } else {
        alert('Please Add Item in Bill');
    }
});

function SaveQuickBill(PaymentMode) {
    let CustomerName = $("#txtQuickCustomerName").val();
    let MobileNo = $("#txtQuickMobileNo").val();
    let Address = $("#txtQuickAddress").val();
    let KotNote = $("#txtQuickKotNote").val();
    let QuickBillType = $("#hdnQuickBillType").val();

    $.ajax({
        url: baseUrl + '/outlet/save-quick-bill',
        type: 'post',
        data: {
            "_token": _token,
            MenuItem: Q_MenuItem,
            CustomerName: CustomerName,
            MobileNo: MobileNo,
            Address: Address,
            KotNote: KotNote,
            BillType: 'Quick Bill',
            QuickBillType: QuickBillType,
            PaymentMode: PaymentMode
        },
        success: function (response) {
            console.log(response);

            Q_MenuItem = [];
            localStorage.removeItem('Q_KOT_Table');
            localStorage.removeItem('QuickBillType');

            $("#tbodyQuickBill").html('');
            $("#lblQuickTotalBillAmount").html('0');
            $("#hdnQuickBillType").val('');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
            console.log(errorMsg)
        }
    });
}