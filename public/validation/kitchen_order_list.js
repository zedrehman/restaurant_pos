let item_status_options = `
    <option value="Waiting">Waiting</option>
    <option value="Processing">Processing</option>
    <option value="Ready">Ready</option>
    <option value="Cancel">Cancel</option>
    <option value="Served">Served</option>
`;
jQuery(document).ready(function () {
    /*if ($('#tblOrder').length > 0) {
        var tblOrder = $('#tblOrder').DataTable({
            searching: false,
            paging: false,
            select: false,
            lengthChange: false
        });
    }*/
});

$("#ddlOutlet").change(function () {
    let outlet_id = $(this).val();

    if ($.fn.DataTable.isDataTable('#tblOrder')) {
        $('#tblOrder').DataTable().destroy();
    }
    $("#tbodyBillingMenu").html('');
    $("#divBillItems").hide();

    $("#tbodytblOrderList").html('');

    $.ajax({
        url: baseUrl + '/kitchen/GetOrderListByOutletId',
        type: 'post',
        data: { "_token": _token, outlet_id: outlet_id },
        success: function (response) {
            let order_list = response;

            for (let i = 0; i < order_list.length; i++) {

                let table_name = '-';
                if (order_list[i].table_id != 0) {
                    table_name = order_list[i].table_name;
                }

                let bill_type = order_list[i].bill_type;
                if (order_list[i].quick_bill_type != null) {
                    bill_type = order_list[i].quick_bill_type;
                }
                let strkd = `
                    <tr class="trtable" data-id="${order_list[i].id}" id="trtable_${order_list[i].id}">
                        <td>${order_list[i].id}</td>
                        <td>${order_list[i].kot}</td>
                        <td>${table_name}</td>
                        <td>${bill_type}</td>
                    </tr>`;
                $("#tbodytblOrderList").append(strkd);
            }

            $("#tblOrder").DataTable({
                searching: false,
                paging: false,
                select: false,
                lengthChange: false
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
            console.log(errorMsg)
        }
    });
});

$("#tbodytblOrderList").on('click', '.trtable', function () {
    $(".trtable").removeClass('selected');
    $(this).addClass('selected');

    let OrderId = $(this).attr("data-id");
    $("#tblBillingMenu").attr("data-id", OrderId);
    $("#tbodyBillingMenu").html('');
    $.ajax({
        url: baseUrl + '/kitchen/GetKitchenOrderDetails',
        type: 'post',
        data: { "_token": _token, OrderId: OrderId },
        success: function (response) {
            for (let i = 0; i < response.length; i++) {
                let MenuBillItems = `
                <tr id="tr_${response[i].id}">
                    <td>${response[i].menu_name}</td>
                    <td>${response[i].quantity}</td>
                    <td>${response[i].kitchen_department_name}</td>
                    <td>${response[i].ready_in}</td>
                    <td></td>
                    <td>
                        <select class="form-control ddlItemStatus" id="ddlItemStatus_${response[i].id}" data-status="${response[i].item_status}" data-id="${response[i].id}">
                            ${item_status_options}
                        </select>
                    </td>
                </tr>`;
                $("#tbodyBillingMenu").append(MenuBillItems);
                if (response[i].item_status != null) {
                    $("#ddlItemStatus_" + response[i].id).val(response[i].item_status);
                }
            }
            $("#divBillItems").show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
            console.log(errorMsg)
        }
    });
});

$("#tbodyBillingMenu").on('change', '.ddlItemStatus', function () {
    let id = $(this).attr('data-id');
    let item_status = $(this).val();
    let currentstatus = $(this).attr('data-status');

    if (currentstatus == 'Ready') {

    }

    $.ajax({
        url: baseUrl + '/kitchen/UpdateItemStatus',
        type: 'post',
        data: { "_token": _token, id: id, item_status: item_status },
        success: function (response) {
            let OrderId = $("#tblBillingMenu").attr("data-id");
            if (item_status == 'Ready' || item_status == 'Cancel') {
                //$("#tr_" + id).remove();
            }
            if ($("#tbodyBillingMenu tr").length == 0) {
                //$("#trtable_" + OrderId).remove();
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
            console.log(errorMsg)
        }
    });
});