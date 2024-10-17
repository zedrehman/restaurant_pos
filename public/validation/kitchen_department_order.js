jQuery(document).ready(function () {
    $(".hamburger").trigger('click');
    //$("#tblOrderList").DataTable();
});

$("#ddlOutlet").change(function () {
    let outlet_id = $(this).val();
    $("#ulKitchenDepartment").html('');
    if ($.fn.DataTable.isDataTable('#tblOrderList')) {
        $('#tblOrderList').DataTable().destroy();
    }
    $("#tbodytblOrderList").html('');
    $.ajax({
        url: baseUrl + '/kitchen/GetDepartmentDetailsByOutlet',
        type: 'post',
        data: { "_token": _token, outlet_id: outlet_id },
        success: function (response) {
            let kitchen_department = response.kitchen_department;
            let order_table_menu_items = response.order_table_menu_items;


            for (let i = 0; i < kitchen_department.length; i++) {
                if (i == 0) {
                    let strkd = `<li class="nav-item"><a href="javascript:void(0)" class="nav-link active" data-toggle="tab" aria-expanded="false" data-id="${kitchen_department[i].id}">${kitchen_department[i].kitchen_department_name}</a></li>`;
                    $("#ulKitchenDepartment").append(strkd);
                } else {
                    let strkd = `<li class="nav-item"><a href="javascript:void(0)" class="nav-link" data-toggle="tab" aria-expanded="false" data-id="${kitchen_department[i].id}">${kitchen_department[i].kitchen_department_name}</a></li>`;
                    $("#ulKitchenDepartment").append(strkd);
                }
            }
            loadTableMenu(order_table_menu_items);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
            console.log(errorMsg)
        }
    });
});

$("#ulKitchenDepartment").on('click', '.nav-link', function () {
    let id = $(this).attr('data-id');
    let outlet_id = $("#ddlOutlet").val();
    if ($.fn.DataTable.isDataTable('#tblOrderList')) {
        $('#tblOrderList').DataTable().destroy();
    }
    $("#tbodytblOrderList").html('');
    $.ajax({
        url: baseUrl + '/kitchen/GetDepartmentOrderDetailsId',
        type: 'post',
        data: { "_token": _token, outlet_id: outlet_id, id: id },
        success: function (response) {
            loadTableMenu(response);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
            console.log(errorMsg)
        }
    });
});

function loadTableMenu(ItemList) {

    for (let i = 0; i < ItemList.length; i++) {
        console.log(ItemList[i].quick_bill_type);
        let bill_type = ItemList[i].bill_type;
        if (ItemList[i].quick_bill_type != null) {
            bill_type = ItemList[i].quick_bill_type;
        }

        let statuscolor = 'info';
        let item_status = 'Waiting';
        if (ItemList[i].item_status == 'Processing') {
            statuscolor = 'warning';
            item_status = ItemList[i].item_status;
        }
        if (ItemList[i].item_status == 'Ready') {
            statuscolor = 'success';
            item_status = ItemList[i].item_status;
        }
        if (ItemList[i].item_status == 'Cancel') {
            statuscolor = 'danger';
            item_status = ItemList[i].item_status;
        }


        let strhtml = `<tr>
                        <td>${ItemList[i].order_id}</td>
                        <td>${ItemList[i].created_at}</td>
                        <td>${ItemList[i].kot}</td>
                        <td>${ItemList[i].table_id}</td>
                        <td>${ItemList[i].bill_type}</td>
                        <td>${ItemList[i].menu_name}</td>
                        <td>${ItemList[i].quantity}
                            
                        </td>
                        <td>${ItemList[i].ready_in}</td>
                        <td></td>
                        <td>
                            <div class="dropdown ml-auto text-right">
                                <div class="btn-link" data-toggle="dropdown" id="btnLink_${ItemList[i].id}">
                                    <span class="badge light badge-${statuscolor}">
                                        <i class="fa fa-circle text-${statuscolor} mr-1"></i>${item_status}
                                    </span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item lnkStatus" href="javascript:void(0)" data-status="${ItemList[i].item_status}" data-id="${ItemList[i].id}">Waiting</a>
                                    <a class="dropdown-item lnkStatus" href="javascript:void(0)" data-status="${ItemList[i].item_status}" data-id="${ItemList[i].id}">Processing</a>
                                    <a class="dropdown-item lnkStatus" href="javascript:void(0)" data-status="${ItemList[i].item_status}" data-id="${ItemList[i].id}">Ready</a>
                                    <a class="dropdown-item lnkStatus" href="javascript:void(0)" data-status="${ItemList[i].item_status}" data-id="${ItemList[i].id}">Cancel</a>
                                </div>
                            </div>
                        </td>
                    </tr>`;
        $("#tbodytblOrderList").append(strhtml);
    }
    $("#tblOrderList").DataTable({});
}
$("#tbodytblOrderList").on('click', '.lnkStatus', function () {
    let id = $(this).attr('data-id');
    let item_status = $(this).html();
    let currentstatus = $(this).attr('data-status');

    if (currentstatus == 'Ready') {

    }

    $.ajax({
        url: baseUrl + '/kitchen/UpdateItemStatus',
        type: 'post',
        data: { "_token": _token, id: id, item_status: item_status },
        success: function (response) {
            if (item_status == '') {
                $("#btnLink_" + id).html(`<span class="badge light badge-warning"><i class="fa fa-circle text-warning mr-1"></i>Processing</span>`);
            }
            else if (item_status == 'Ready') {
                $("#btnLink_" + id).html(`<span class="badge light badge-success"><i class="fa fa-circle text-success mr-1"></i>Ready</span>`);
            }
            else if (item_status == 'Cancel') {
                $("#btnLink_" + id).html(`<span class="badge light badge-danger"><i class="fa fa-circle text-danger mr-1"></i>Cancel</span>`);
            } else {
                $("#btnLink_" + id).html(`<span class="badge light badge-info"><i class="fa fa-circle text-info mr-1"></i>Waiting</span>`);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
            console.log(errorMsg)
        }
    });
});