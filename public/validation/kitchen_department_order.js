jQuery(document).ready(function () {
    $(".hamburger").trigger('click');
    //$("#tblOrderList").DataTable();
});

$("#ddlOutlet").change(function () {
    let outlet_id = $(this).val();
    $("#ulKitchenDepartment").html('');
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
    if ($.fn.DataTable.isDataTable('#tblOrderList')) {
        $('#tblOrderList').DataTable().destroy();
    }
    for (let i = 0; i < ItemList.length; i++) {
        console.log(ItemList[i].quick_bill_type);
        let bill_type = ItemList[i].bill_type;
        if (ItemList[i].quick_bill_type != null) {
            bill_type = ItemList[i].quick_bill_type;
        }

        let statuscolor = 'info';
        if (ItemList[i].item_status == 'Processing') {
            statuscolor = 'warning';
        }
        if (ItemList[i].item_status == 'Ready') {
            statuscolor = 'success';
        }
        if (ItemList[i].item_status == 'Cancel') {
            statuscolor = 'danger';
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
                                <div class="btn-link" data-toggle="dropdown">
                                    <span class="badge light badge-${statuscolor}">
                                        <i class="fa fa-circle text-${statuscolor} mr-1"></i>${ItemList[i].item_status}
                                    </span>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0)" data-status="${ItemList[i].item_status}" data-id="${ItemList[i].id}">Waiting</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-status="${ItemList[i].item_status}" data-id="${ItemList[i].id}">Processing</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-status="${ItemList[i].item_status}" data-id="${ItemList[i].id}">Ready</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-status="${ItemList[i].item_status}" data-id="${ItemList[i].id}">Cancel</a>
                                </div>
                            </div>
                        </td>
                    </tr>`;
        $("#tbodytblOrderList").append(strhtml);
    }
    $("#tblOrderList").DataTable({});
}