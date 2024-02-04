@extends('pages.layout')
@section('title')
    Report || BalanceSheet
@endsection
@section('content')
    <style>
        .mnth_select .form-control-wrap .form-select {
            padding-left: 0;
        }

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


        <div class="col-xl-12 col-sm-12 px-0 balance_sheet">

            <div class="card px-0">
                <div class="mnth_select">

                    <div class="form-group mt-2 " style="margin-left: 20px">
                        <div class="form-control-wrap pr-4 " style="width: 20rem">
                            <select class="form-select" style="border: 1px solid;padding: 10px;" id="selectdata"
                                aria-label="Default select example">
                                <option selected disabled>-- Select --</option>
                                <option value="{{ \Carbon\Carbon::now()->format('Y') }}"
                                    @if (\Carbon\Carbon::now()->format('Y') == $id) selected @endif>
                                    {{ \Carbon\Carbon::now()->format('Y') }} -
                                    {{ \Carbon\Carbon::now()->modify('+1 Year')->format('y') }}</option>
                                <option value="{{ \Carbon\Carbon::now()->modify('-1 Year')->format('Y') }}"
                                    @if (\Carbon\Carbon::now()->modify('-1 Year')->format('Y') == $id) selected @endif>
                                    {{ \Carbon\Carbon::now()->modify('-1 Year')->format('Y') }} -
                                    {{ \Carbon\Carbon::now()->format('y') }}</option>
                                <option value="{{ \Carbon\Carbon::now()->modify('-2 Year')->format('Y') }}"
                                    @if (\Carbon\Carbon::now()->modify('-2 Year')->format('Y') == $id) selected @endif>
                                    {{ \Carbon\Carbon::now()->modify('-2 Year')->format('Y') }} -
                                    {{ \Carbon\Carbon::now()->modify('-1 Year')->format('y') }}</option>
                                <option value="{{ \Carbon\Carbon::now()->modify('-3 Year')->format('Y') }}"
                                    @if (\Carbon\Carbon::now()->modify('-3 Year')->format('Y') == $id) selected @endif>
                                    {{ \Carbon\Carbon::now()->modify('-3 Year')->format('Y') }} -
                                    {{ \Carbon\Carbon::now()->modify('-2 Year')->format('y') }}</option>
                                <option value="{{ \Carbon\Carbon::now()->modify('-4 Year')->format('Y') }}"
                                    @if (\Carbon\Carbon::now()->modify('-4 Year')->format('Y') == $id) selected @endif>
                                    {{ \Carbon\Carbon::now()->modify('-4 Year')->format('Y') }} -
                                    {{ \Carbon\Carbon::now()->modify('-3 Year')->format('y') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body p-2">

                    <div class="row" id="mybalancetable">

                        <div class="col-12">
                            <h5 style="text-align: center; padding: 7px 0; color: #000;">Balance Sheet
                            </h5>
                        </div>


                        <div class="col-xl-6 col-sm-12 col-md-6 pe-0">
                            <table width="100%" border="0" cellspacing="0">
                                <tbody>


                                    <tr>
                                        <td style="padding: 0 !important;">
                                            <table width="100%" border="1" cellspacing="0">
                                                <thead>
                                                    <tr
                                                        style=" font-weight: 600; color: #000; background-color: rgb(163, 195, 245);">
                                                        <td>Assets</td>
                                                        <td style="font-weight: 600; color: #000; text-align: right;">
                                                            Amount
                                                        </td>
                                                    </tr>
                                                </thead>
                                                @php
                                                    $cashAmount = 0;
                                                @endphp
                                                @if (count($case) > 0)
                                                    @foreach ($case as $casedata)
                                                        @php
                                                            $cashAmount = $cashAmount + $casedata->amount;
                                                        @endphp
                                                    @endforeach
                                                @endif

                                                <tbody>
                                                    <tr>
                                                        <td
                                                            style="background-color: #fdf2f2; font-weight: 600; padding: 7px !important;">
                                                            Current Assets
                                                        </td>
                                                        <td style="background-color: #fdf2f2;padding: 7px !important;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 7px !important;">
                                                            Cash In hand
                                                        </td>
                                                        <td align="right" style="padding: 7px !important;">
                                                            {{ env('CURRENCY') }}{{ number_format($cashAmount, 2) }}
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $bankamount = 0;
                                                    @endphp
                                                    @foreach ($bank as $bank)
                                                        @php
                                                            $bankamount = $bankamount + $bank->amount;
                                                        @endphp
                                                    @endforeach
                                                    <tr>
                                                        <td
                                                            style=" font-weight: 600;background-color: #fdf2f2; padding: 7px !important;">
                                                            Bank Amount
                                                        </td>
                                                        <td align="right"
                                                            style="background-color: #fdf2f2; padding: 7px !important;">
                                                            {{ env('CURRENCY') }}{{ isset($bank->amount) ? number_format($bankamount, 2) : 0 }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td style="padding: 7px !important;">
                                                            Sale Amount
                                                        </td>
                                                        @php
                                                            $saleamount = 0;
                                                            $gst = 0;
                                                            $reciveamount = 0;
                                                            $total = 0;
                                                        @endphp
                                                        @if (count($saledata) > 0)
                                                            @foreach ($saledata as $saledata)
                                                                @php
                                                                    $saleamount = $saleamount + $saledata->subtotal;
                                                                    $gst = $gst + $saledata->gstamount;
                                                                @endphp
                                                            @endforeach
                                                        @endif

                                                        <td align="right" style="padding: 7px !important;">
                                                            {{ env('CURRENCY') }}{{ number_format($saleamount, 2) }}</td>
                                                    </tr>

                                                    <tr>
                                                        <td style="font-weight: 600; padding: 7px !important;">
                                                            Sale Total GST Amount
                                                        </td>
                                                        <td align="right" style=" padding: 7px !important;">
                                                            {{ env('CURRENCY') }}{{ number_format($gst, 2) }}</td>
                                                    </tr>


                                                    <tr>
                                                        @foreach ($recive as $recive)
                                                            @php
                                                                $reciveamount = $reciveamount + $recive->amount;
                                                            @endphp
                                                        @endforeach
                                                        <td
                                                            style="background-color: #fdf2f2; font-weight: 600; padding: 7px !important;">
                                                            Recive Amount
                                                        </td>
                                                        <td align="right"
                                                            style="background-color: #fdf2f2; padding: 7px !important;">
                                                            {{ env('CURRENCY') }}{{ number_format($reciveamount, 2) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>

                                                    @if ($reciveamount != 0)
                                                        @php
                                                            $total = $reciveamount + $saleamount + $gst + $bankamount + $cashAmount;
                                                        @endphp
                                                    @endif

                                                    <tr style="background-color: rgb(209, 255, 237);">
                                                        <td style="font-weight: 600; padding: 7px !important;">
                                                            Assets total
                                                        </td>

                                                        <td
                                                            style="text-align: right; font-weight: 600; padding: 7px !important;">
                                                            {{ env('CURRENCY') }}{{ number_format($total, 2) }}
                                                        </td>

                                                    </tr>


                                                </tbody>
                                            </table>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-xl-6 col-sm-12 col-md-6 ps-0">
                            <table width="100%" border="0" cellspacing="0">
                                <tbody>


                                    <tr>

                                        <td style="padding: 0 !important;">
                                            <table width="100%" border="1" cellspacing="0">
                                                <thead>
                                                    <tr
                                                        style=" font-weight: 600; color: #000; background-color: rgb(163, 195, 245);">
                                                        <td>Liabilities</td>
                                                        <td style="font-weight: 600; color: #000; text-align: right;">
                                                            Amount
                                                        </td>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td
                                                            style="background-color: #fdf2f2; font-weight: 600; padding: 7px !important;">
                                                            Current Liabilities
                                                        </td>
                                                        <td style="background-color: #fdf2f2;padding: 7px !important;"></td>
                                                    </tr>

                                                    <tr>
                                                        @php
                                                            $expenseamount = 0;
                                                            $purgst = 0;
                                                            $purchaseamount = 0;
                                                        @endphp
                                                        @foreach ($purchase as $purchase)
                                                            @php
                                                                $purchaseamount = $purchaseamount + $purchase->subtotal;
                                                                $purgst = $purgst + $purchase->gstamount;
                                                            @endphp
                                                        @endforeach
                                                        @foreach ($expense as $expense)
                                                            @php
                                                                $expenseamount = $expenseamount + $expense->amount;
                                                            @endphp
                                                        @endforeach
                                                        <td style=" font-weight: 600; padding: 7px !important;">
                                                            Expense Amount
                                                        </td>
                                                        <td align="right" style=" padding: 7px !important;">
                                                            {{ env('CURRENCY') }}{{ number_format($expenseamount, 2) }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td style=" background-color: #fdf2f2;padding: 6px !important;">
                                                            Purchase Amount
                                                        </td>
                                                        <td align="right"
                                                            style="background-color: #fdf2f2;padding: 6px !important;">
                                                            {{ env('CURRENCY') }}{{ number_format($purchaseamount, 2) }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td style="font-weight: 600; padding: 6px !important;">
                                                            Purchase GST Amount
                                                        </td>
                                                        <td align="right" class="mt-1" style=" padding: 6px !important;">
                                                            {{ env('CURRENCY') }}{{ number_format($purgst, 2) }}
                                                        </td>
                                                    </tr>


                                                    <tr>

                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                    @php
                                                        $totlaamount = $expenseamount + $purchaseamount + $purgst;
                                                    @endphp

                                                    <tr style="background-color: rgb(209, 255, 237);">
                                                        <td style="font-weight: 600; padding: 7px !important;">
                                                            Liabilities total
                                                        </td>

                                                        <td
                                                            style="text-align: right; font-weight: 600; padding: 7px !important;">
                                                            {{ env('CURRENCY') }}{{ number_format($totlaamount, 2) }}
                                                        </td>

                                                    </tr>


                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>







                </div>
            </div>
        </div>

    </div>

    <script>
        document
            .getElementById("export-button")
            .addEventListener("click", function() {
                const table = document.getElementById("mybalancetable");
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
            const table = document.getElementById('mybalancetable');
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
            window.location = `/report/balance-sheet/${selectedValue}`;
        })
    </script>
@endsection
