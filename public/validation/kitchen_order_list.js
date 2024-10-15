let item_status_options = `
    <option value="Waiting">Waiting</option>
    <option value="Processing">Processing</option>
    <option value="Ready">Ready</option>
    <option value="Cancel">Cancel</option>
`;
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
        type: 'post',
        data: { "_token": _token, OrderId: OrderId },
        success: function (response) {
            for (let i = 0; i < response.length; i++) {
                let MenuBillItems = `
                <tr>
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
        success: function (response) { },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
            console.log(errorMsg)
        }
    });
});