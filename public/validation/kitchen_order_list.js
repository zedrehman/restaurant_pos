jQuery(document).ready(function () {
    if ($('#tblOrder').length > 0) {
        var tblOrder = $('#tblOrder').DataTable({
            searching: false,
            paging: false,
            select: false,
            lengthChange: false
        });
    }
});

$(".trtable").click(function () {
    $(".trtable").removeClass('selected');
    $(this).addClass('selected');

    let OrderId = $(this).attr("data-id");
    $("#tbodyBillingMenu").html('');
    $.ajax({
        url: baseUrl + '/kitchen/GetKitchenOrderDetails',
        type: 'GET',
        data: { "_token": _token, OrderId: OrderId },
        success: function (response) {

            let order_table_menu_items = response;
            let TotalBillAmount = 0;
            for (let i = 0; i < order_table_menu_items.length; i++) {
                let Quantity = order_table_menu_items[i].quantity;
                let Amount = order_table_menu_items[i].amount;
                let TotalAmount = order_table_menu_items[i].total;
                TotalBillAmount += eval(TotalAmount);
                let MenuBillItems = `<tr>
                                        <td style="width: 60%;">${order_table_menu_items[i].menu_name}</td>
                                        <td style="text-align: right;">${Quantity}</td>
                                        <td style="text-align: right;">${Amount}</td>
                                        <td style="text-align: right;"><b>${TotalAmount}</b></td>
                                    </tr>`;
                $("#tbodyBillingMenu").append(MenuBillItems);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
            console.log(errorMsg)
        }
    });
});