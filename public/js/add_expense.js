let ExpensesOption = '';
let ProjectOption = '';
let GradeOption = '';
$(function () {
    $("#liPurchase").addClass("active");

    ExpensesOption = `<option value="0">-- select --</option>`;
    ProjectOption = `<option value="0">-- select --</option>`;
    for (let Item of ExpensesType_json) {
        ExpensesOption += `<option value="${Item.id}">${Item.name}</option>`;
    }
    for (let Item of ProjectList_json) {
        ProjectOption += `<option value="${Item.id}">${Item.project_name}</option>`;
    }
    
});

$("#btnAddMore").click(function () {
    CreateRows();
});

function CreateRows() {
    let Count = $("#tbodyExpenselist tr").length;

    Count = Count + 1;
    let html = `<tr id="tr_${Count}" data-value="0">
                    <td>
                        <select class="form-control" id="ddlExpenseType_${Count}">${ExpensesOption}</select>
                    </td>
                    <td>
                        <select class="form-control" id="ddlProject_${Count}">${ProjectOption}</select>
                    </td>
                    <td>
                        <input type="text" id="txtDescription_${Count}" class="form-control" value="">
                    </td>
                    <td style="text-align: right;">
                        <input type="text" id="txtAmount_${Count}" class="form-control txtAmount" style="text-align: right;">
                    </td>
                    <td style="text-align: right;">
                        <a href="javascript:void(0)" class="text-danger btnRemove" id="btnRemove_${Count}"><i class="fa fa-remove"></i></a>
                    </td>
                </tr>`;
    $("#tbodyExpenselist").append(html);
}

$("#tbodyExpenselist").on("click", ".btnRemove", function () {
    var Id = $(this).attr("id");
    var trId = Id.replace("btnRemove", "tr");
    
    $("#" + trId).remove();

    setTimeout(function () {
        let RowIndex = 1;
        $("#tbodyExpenselist tr").each(function () {
            let MainId = $(this).attr("id");

            let ddlExpenseType = MainId.replace("tr", "ddlExpenseType");
            let ddlProject = MainId.replace("tr", "ddlProject");
            let txtDescription = MainId.replace("tr", "txtDescription");
            let txtAmount = MainId.replace("tr", "txtAmount");
            let btnRemove = MainId.replace("tr", "btnRemove");

            $("#" + ddlExpenseType).attr("id", "txtKhata_" + RowIndex);
            $("#" + ddlProject).attr("id", "ddlProduct_" + RowIndex);
            $("#" + txtRate).attr("id", "txtRate_" + RowIndex);
            $("#" + txtAmount).attr("id", "txtAmount_" + RowIndex);
            $("#" + btnRemove).attr("id", "btnRemove_" + RowIndex);

            $("#" + MainId).attr("id", "tr_" + RowIndex);

            RowIndex++;
        });
    }, 10);
});

$("#btnSave").click(function () {
    let IsError = 0;
    let BillId = $("#hdnBillId").val();

    let BillDate = $("#txtBillDate").val();
    if (BillDate.trim() == "") {
        IsError = 1;
    }
    var BillItem = [];
    $("#tbodyBillItem tr").each(function () {

        let MainId = $(this).attr("id");
        let ItemId = $(this).attr("data-value");

        let txtKhata = MainId.replace("tr", "txtKhata");
        let ddlProduct = MainId.replace("tr", "ddlProduct");
        let ddlUnit = MainId.replace("tr", "ddlUnit");
        let ddlGrade = MainId.replace("tr", "ddlGrade");
        let txtLYR = MainId.replace("tr", "txtLYR");
        let txtQuantity = MainId.replace("tr", "txtQuantity");
        let txtRate = MainId.replace("tr", "txtRate");
        let txtAmount = MainId.replace("tr", "txtAmount");

        let Khata = $("#" + txtKhata).val();
        let ProductId = $("#" + ddlProduct).val();
        let Unit = $("#" + ddlUnit).val();
        let Grade = $("#" + ddlGrade).val();
        let LYR = $("#" + txtLYR).val();
        let Quantity = $("#" + txtQuantity).val();
        let Price = $("#" + txtRate).val();
        let Amount = $("#" + txtAmount).val();

        if (ProductId != 0 && eval(Amount) != 0) {
            var Item = {
                ItemId: ItemId,
                Khata: Khata,
                ProductId: ProductId,
                Unit: Unit,
                Grade: Grade,
                LYR: LYR,
                Quantity: Quantity,
                Price: Price,
                Amount: Amount
            };
            BillItem.push(Item);
        }

    });
    if (BillItem.length == 0) {
        IsError = 1;
    }
    if (IsError == 0) {
        $.ajax({
            url: baseUrl + '/admin/purchase/add',
            type: 'post',
            data: {
                "_token": _token,
                BillId: BillId,
                PartyId: PartyId,
                BillNo: BillNo,
                BillDate: BillDate,
                BillItem: BillItem
            },
            success: function (resp) {
                console.log(resp);
                if (resp) {
                    window.location.href = baseUrl + '/admin/purchase';
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                var errorMsg = 'Ajax request failed: ' + xhr.responseText;
                console.log("xhr " + xhr);
                console.log("thrownError " + thrownError);
                console.log("ajaxOptions " + ajaxOptions);
            }
        });
    }

});