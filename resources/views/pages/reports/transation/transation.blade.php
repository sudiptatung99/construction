@extends('pages.layout')
@section('title')
Report || Transation 
@endsection
@section('content')
    <style>
        .dataTable-top,
        .dataTable-bottom {
            flex-wrap: wrap;
            justify-content: space-between;
            row-gap: 10px;
        }

        .dataTable-table th {
            border-right: 1px solid #e5e5e5;
            text-align: center;
        }

        #mytable tbody tr td {
            text-align: center;
        }

        .table_top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <div class="row g-gs">
        {{-- <div class="col-xl-12 col-sm-12 px-0">
            <div class="card">
                <div class="card-body">
                    <div class="total_mnth_select">
                        <div class="mnth_select">

                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <select class="form-select" id="selectdata" aria-label="Default select example">
                                        <option selected disabled>--select Months --</option>
                                        <option value="this_month" @if ($id == 'this_month') selected @endif>This
                                            Month</option>
                                        <option value="last_month" @if ($id == 'last_month') selected @endif>Last
                                            Month</option>
                                        <option value="last_three" @if ($id == 'last_three') selected @endif>Last 3
                                            month</option>
                                        <option value="pre_year" @if ($id == 'pre_year') selected @endif>Previous
                                            Year</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('report.sales.between') }}" class="d-flex gap-3" method="POST">
                            @csrf
                            <div class="date_select">
                                <p>Between</p>

                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input placeholder="dd/mm/yyyy" name="first_date" value="{{ old('first_date') }}"
                                            type="date" class="form-control-sm " data-today-btn="true"
                                            data-clear-btn="true" autocomplete="off" id="datePicker1">
                                    </div>
                                </div>

                                <p style="background-color: transparent; color: #000;">To</p>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input placeholder="dd/mm/yyyy" name="second_date" type="date"
                                            value="{{ old('second_date') }}" class="form-control-sm" data-today-btn="true"
                                            data-clear-btn="true" autocomplete="off" id="datePicker1">
                                    </div>
                                </div>
                            </div>
                            <div class="firm_selct">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="total_amount">
                        <div class="amount_div">
                            <p style="color: rgb(97, 97, 97); font-weight: 600; font-size: 13px;line-height: 23px;">Paid
                            </p>
                            @php
                                $paidamount = 0;
                            @endphp
                            @foreach ($paid as $paid)
                                @php
                                    $paidamount = $paidamount + $paid->total;
                                @endphp
                            @endforeach
                            <p style="color:rgb(5, 5, 43);font-weight: 600; font-size: 21px;line-height: 23px;">
                                {{ env('CURRENCY') }}{{ number_format($paidamount, 2) }}
                            </p>
                        </div>

                        <div class="icon_div">
                            <em class="icon ni ni-plus"></em>
                        </div>

                        <div class="amount_div" style="background-color: #aed6f3;">
                            <p style="color: rgb(97, 97, 97); font-weight: 600; font-size: 13px;line-height: 23px;">
                                Unpaid</p>
                            @php
                                $unpaidamount = 0;
                            @endphp
                            @foreach ($unpaid as $unpaid)
                                @php
                                    $unpaidamount = $unpaidamount + $unpaid->total;
                                @endphp
                            @endforeach
                            <p style="color:rgb(5, 5, 43);font-weight: 600; font-size: 21px;line-height: 23px;">
                                {{ env('CURRENCY') }}{{ number_format($unpaidamount, 2) }}
                            </p>
                        </div>
                        <div class="icon_div">
                            <em class="icon ni ni-equal"></em>
                        </div>
                        <div class="amount_div" style="background-color: #fbe88c;">
                            <p style="color: rgb(97, 97, 97); font-weight: 600; font-size: 13px;line-height: 23px;">
                                Total</p>
                            @php
                                $total = $paidamount + $unpaidamount;
                            @endphp
                            <p style="color:rgb(5, 5, 43);font-weight: 600; font-size: 21px;line-height: 23px;">
                                {{ env('CURRENCY') }}{{ number_format($total, 2) }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div> --}}

        <div class="col-xl-12 col-sm-12 px-0">
            <div class="card">
                <div class="card-body">
                    <div class="table_top">
                        <p style="color: #000; font-weight: 500; font-size: 18px;">Transactions</p>
                    </div>

                    <table id="mytable" width="100%" class="datatable-init table"
                        data-nk-container="table-responsive table-border">
                        <thead>
                            <tr>
                                <th>
                                    <span class="overline-title"># </span>
                                </th>
                                <th>
                                    <span class="overline-title">Invoice No</span>
                                </th>
                                <th>
                                    <span class="overline-title">Date</span>
                                </th>
                                <th>
                                    <span class="overline-title">Client Name</span>
                                </th>
                                <th>
                                    <span class="overline-title">Client Number</span>
                                </th>
                                <th>
                                    <span class="overline-title">Amount</span>

                                </th>
                                <th>
                                    <span class="overline-title">Payment type</span>
                                </th>

                                <th>
                                    <span class="overline-title">Payment Mode</span>
                                </th>


                                {{-- <th>
                                    <span class="overline-title">Balance Due(₹)</span>
                                </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=0;
                        @endphp
                            @foreach ($alldata as $Key=>$item)
                                <tr>
                                    <td>{{$i=$i+1}}</td>
                                    <td>{{ $item->sale_no }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                                    <td>{{ $item->client->name }}</td>
                                    <td>{{ $item->client->first_number }}</td>
                                    <td>{{ env('CURRENCY') }}{{ number_format($item->total, 2) }}</td>
                                    <td>{{ $item->payment_mode }}</td>
                                    <td>{{ $item->payment_status }}</td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>

    <script>
        document
            .getElementById("export-button")
            .addEventListener("click", function() {
                const table = document.getElementById("mytable");
                const rows = table.querySelectorAll("tbody tr");

                let csvContent = "data:text/csv;charset=utf-8,";

                csvContent += "Name,Age,Location\n";

                rows.forEach(function(row) {
                    const columns = row.querySelectorAll("td");
                    const rowData = Array.from(columns)
                        .map((column) => column.textContent)
                        .join(",");
                    csvContent += rowData + "\n";
                });

                const blob = new Blob([csvContent], {
                    type: "text/csv;charset=utf-8;",
                });

                const link = document.createElement("a");
                link.href = URL.createObjectURL(blob);
                link.download = "data.csv";
                link.style.display = "none";

                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });

        // 2nd income data table

        document
            .getElementById("export-xl-incm")
            .addEventListener("click", function() {
                const table = document.getElementById("mytable-income");
                const rows = table.querySelectorAll("tbody tr");

                let csvContent = "data:text/csv;charset=utf-8,";

                csvContent += "Name,Age,Location\n";

                rows.forEach(function(row) {
                    const columns = row.querySelectorAll("td");
                    const rowData = Array.from(columns)
                        .map((column) => column.textContent)
                        .join(",");
                    csvContent += rowData + "\n";
                });

                const blob = new Blob([csvContent], {
                    type: "text/csv;charset=utf-8;",
                });

                const link = document.createElement("a");
                link.href = URL.createObjectURL(blob);
                link.download = "data.csv";
                link.style.display = "none";

                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
    </script>
    <script>
        document.getElementById("export-button-pdf").addEventListener("click", function() {
            const table = document.getElementById('mytable');
            const rows = table.querySelectorAll('tbody tr');

            let csvContent = '\n,';

            csvContent += 'Name,Age,Location\n';

            rows.forEach(function(row) {
                const columns = row.querySelectorAll('td');
                const rowData = Array.from(columns).map(column => column.textContent).join(',');
                csvContent += rowData + '\n';
            });

            var lines = csvContent.split("\n");
            var pdfContent = lines.map(line => line.split(",").join("\t")).join("\n");

            var pdfWindow = window.open('', '', 'height=650,width=900');
            pdfWindow.document.write('<pre>' + pdfContent + '</pre>');
            pdfWindow.document.close();
            pdfWindow.print();

        })
    </script>
    <script>
        $("#selectdata").change(function() {
            var selectedValue = $(this).val();
            window.location = `/report/sales/${selectedValue}`;
        })
    </script>
@endsection
