@extends('layouts.admin')

@section('dashboard_bar')
Expenses Reports
@endsection

@section('content')
<div class="row">
    <div class="col-sm-4">
        <div class="mail-list mt-4" id="ulDate">
            <?php
            $intRow = 0;
            ?>
            @foreach ($ExpensesTable as $Item)
            @if($intRow==0)
            <a href="javascript:void()" class="list-group-item active" data-id="{{$Item->expense_date}}">
                {{$Item->expense_date}} <span class="badge badge-primary badge-sm float-right">{{$Item->total_amount}}</span>
            </a>
            @else
            <a href="javascript:void()" class="list-group-item" data-id="{{$Item->expense_date}}">
                {{$Item->expense_date}} <span class="badge badge-primary badge-sm float-right">{{$Item->total_amount}}</span>
            </a>
            @endif
            <?php
            $intRow++;
            ?>
            @endforeach
        </div>
    </div>
    <div class="col-sm-8">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Outlet Name</th>
                    <th>Expense Type</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody id="tblBody">
                @foreach ($ExpensesDetailsTable as $Items)
                <tr>
                    <td> {{ $Items->outlet_name }} </td>
                    <td> {{ $Items->type_name }} </td>
                    <td> {{ $Items->description }} </td>
                    <td> {{ $Items->expense_amount }} </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('JsScript')
<script>
    var baseUrl = "{{url('/')}}";
    $("#ulDate .list-group-item").click(function() {
        $('#tblBody').html('');
        $("#ulDate .list-group-item").removeClass('active');
        $(this).addClass('active');
        
        let date = $(this).attr("data-id");
        $.ajax({
            url: baseUrl + '/reports/GetExpensesDetailsReportsByDate',
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                expense_date: date
            },
            success: function(response) {
                console.log(response);
                for (let i = 0; i < response.length; i++) {
                    let html = `<tr>
                                    <td> ${response[i].outlet_name} </td>
                                    <td> ${response[i].type_name}</td>
                                    <td> ${response[i].description}</td>
                                    <td> ${response[i].expense_amount}</td>
                                </tr>`;
                    $('#tblBody').append(html);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                var errorMsg = 'Ajax request get outlet department data failed: ' + xhr.responseText;
                console.log(errorMsg)
            }
        });
    })
</script>

@endsection