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

    $("#hdnSelectedTable").val(TableId);
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
            console.log(response);
            for (let i = 0; i < response.length; i++) {
                let MenuItem = `<div class="col-sm-4" style="padding: 0px;">
                                    <div class="card">
                                        <div class="card-body" style="padding: 10px 1.437rem;">
                                            <h4 style="margin-bottom: 0px;">${response[i].menu_name}</h4>
                                            <span style="float: left;">${response[i].short_code}</span> <span style="float: right;">Rs ${response[i].sale_price}</span>
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