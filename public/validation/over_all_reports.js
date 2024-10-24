jQuery(document).ready(function () {
    if ($('#tblOrder').length > 0) {
        var tblOrder = $('#tblOrder').DataTable({
            searching: false,
            paging: true,
            select: false,
            //info: false,         
            lengthChange: false
        });
        /*tblOrder.on('click', 'tbody tr', function () {
            var $row = table2.row(this).nodes().to$();
            var hasClass = $row.hasClass('selected');
            if (hasClass) {
                $row.removeClass('selected')
            } else {
                $row.addClass('selected')
            }
        });
        tblOrder.rows().every(function () {
            this.nodes().to$().removeClass('selected')
        });*/
    }
});

$(".trtable").click(function () {

    //$(".trtable").removeAttr("style");
    //$(this).css({ "background-color": "#000", "color": "#fff" });
    $(".trtable").removeClass('selected');
    $(this).addClass('selected');

    let OrderId = $(this).attr("data-id");
    $("#tbodyBillingMenu").html('');
    $("#lblTotalBillAmount").html('');
    $('html,body').animate({ scrollTop: $("#tbodyBillingMenu").offset().top }, 'slow');
    $.ajax({
        url: baseUrl + '/reports/GetOrderDetailsByOrderId/' + OrderId,
        type: 'GET',
        success: function (response) {


            let order_table = response.order_table;
            console.log(order_table);
            $("#lblOrderId").html("#" + order_table[0].id);
            $("#lblDate").html(order_table[0].created_at);
            $("#lblTableNo").html(order_table[0].table_name);

            let order_table_menu_items = response.order_table_menu_items;
            let TotalBillAmount = 0;
            for (let i = 0; i < order_table_menu_items.length; i++) {
                let Quantity = order_table_menu_items[i].quantity;
                let Amount = order_table_menu_items[i].amount;
                let TotalAmount = order_table_menu_items[i].total;
                TotalBillAmount += eval(TotalAmount);

                let statuscolor = 'info';
                if (order_table_menu_items[i].item_status == 'Processing') {
                    statuscolor = 'warning';
                }
                if (order_table_menu_items[i].item_status == 'Ready') {
                    statuscolor = 'success';
                }
                if (order_table_menu_items[i].item_status == 'Cancel') {
                    statuscolor = 'danger';
                }
                if (order_table_menu_items[i].item_status == 'Served') {
                    statuscolor = 'dark';
                }
                let MenuBillItems = `<tr>
                                        <td style="width: 60%;">${order_table_menu_items[i].menu_name}</td>
                                        <td style="text-align: right;">${Quantity}</td>
                                        <td style="text-align: right;">${Amount}</td>
                                        <td style="text-align: right;"><b>${TotalAmount}</b></td>
                                        <td><span class="badge light badge-${statuscolor}">${order_table_menu_items[i].item_status}</span></td>
                                    </tr>`;
                $("#tbodyBillingMenu").append(MenuBillItems);
            }
            $("#lblTotalBillAmount").html("Rs. " + TotalBillAmount);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
            console.log(errorMsg)
        }
    });
});