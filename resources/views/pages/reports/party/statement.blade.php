@extends('pages.layout')
@section('title')
    Report || Party Satelment
@endsection
@section('content')
    <style>
        #mytable .overline-title {
            letter-spacing: 0 !important;
        }

        thead tr th span {
            padding-left: 0px;
        }

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

        .table_top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>

    <div class="row g-gs mt-4">
        <div class="col-xl-12 col-sm-12 mt-2 px-0">
            <div class="card">
                <div class="card-body">
                    <div class="table_top mb-4">
                        <h2 style="color: #000; font-weight: 800; font-size: 18px;">All Party Statement</h2>
                    </div>

                    <table id="mytable" width="100%" class="datatable-init table"
                        data-nk-container="table-responsive table-border">
                        <thead>
                            <tr>
                                <th>
                                    <span class="overline-title"># </span>
                                </th>
                                <th>
                                    <span class="overline-title">Client Name</span>
                                </th>

                                <th>
                                    <span class="overline-title">Phone Number</span>
                                </th>
                                <th>
                                    <span class="overline-title">Total GST Amount</span>
                                </th>
                                <th>
                                    <span class="overline-title">Total Sub Amount</span>
                                </th>
                                <th>
                                    <span class="overline-title">Total Amount</span>
                                </th>
                                <th>
                                    <span class="overline-title">Receivable Balance</span>
                                </th>
                                <th>
                                    <span class="overline-title">Due Balance</span>
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($client as $Key => $client)
                                @php
                                    $sellamount = 0;
                                    $reciveamount = 0;
                                    $restAmount = 0;
                                    $gst = 0;
                                    $subamount = 0;
                                @endphp
                                @foreach ($client->sale as $item)
                                    @php
                                        $sellamount = $sellamount + $item->total;
                                    @endphp
                                @endforeach
                                @foreach ($client->sale as $recive)
                                    @php
                                        $gst = $gst + $recive->gstamount;
                                    @endphp
                                @endforeach
                                @foreach ($client->sale as $recive)
                                    @php
                                        $subamount = $subamount + $recive->subtotal;
                                    @endphp
                                @endforeach
                                @foreach ($client->reciver as $recive)
                                    @php
                                        $reciveamount = $reciveamount + $recive->amount;
                                    @endphp
                                @endforeach

                                @php
                                    $restAmount = $sellamount - $reciveamount;
                                @endphp
                                <tr>
                                    <td>{{ $Key + 1 }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->first_number }}</td>
                                    <td>{{ env('CURRENCY') }}{{ number_format($gst, 2) }}</td>
                                    <td>{{ env('CURRENCY') }}{{ number_format($subamount, 2) }}</td>
                                    <td>{{ env('CURRENCY') }}{{ number_format($sellamount, 2) }}</td>
                                    <td>{{ env('CURRENCY') }}{{ number_format($reciveamount, 2) }}</td>
                                    <td>{{ env('CURRENCY') }}{{ number_format($restAmount, 2) }}</td>

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
@endsection
