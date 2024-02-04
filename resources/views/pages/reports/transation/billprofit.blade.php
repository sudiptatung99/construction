@extends('pages.layout')
@section('title')
    Report || Bill
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
            margin-bottom: 10px;
        }

        #mytable tbody tr td .btn {
            padding: 3px 4px;
            color: #fff;
            font-weight: 600;
        }
    </style>

    <div class="row g-gs mt-4">
        <div class="col-xl-12 col-sm-12 mt-2 px-0">
            <div class="card">
                <div class="card-body">
                    <div class="mt-1 mb-4 m-auto">
                        <form action="{{ route('report.bill-profit.between') }}" class="d-flex gap-3 m-auto" method="POST">
                            @csrf
                            <div class="date_select">
                                <p>Between</p>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input placeholder="dd/mm/yyyy" name="first_date"
                                            value="{{ isset($from) ? $from : '' }}" type="date" class="form-control-sm "
                                            data-today-btn="true" data-clear-btn="true" autocomplete="off" id="datePicker1">
                                    </div>
                                </div>

                                <p style="background-color: transparent; color: #000;">To</p>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input placeholder="dd/mm/yyyy" name="second_date" type="date"
                                            value="{{ isset($to) ? $to : '' }}" class="form-control-sm"
                                            data-today-btn="true" data-clear-btn="true" autocomplete="off" id="datePicker1">
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
                    <div class="table_top">
                        <h4 class="mb-0">PARTY LEDGER</h4>

                        <div class="btn_grp">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-outline-warning" id="bill-excel">Excel</button>
                                <button type="button" class="btn btn-outline-danger" id="bill-pdf">PDF</button>
                            </div>

                        </div>

                    </div>
                     @php
                        $totalsell = 0;
                        $totalrecive = 0;
                        $totalrest = 0;
                    @endphp

                    <table id="billtable" width="100%" class="datatable-init table"
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
                                    <span class="overline-title">Client Phone Number</span>
                                </th>
                                <th>
                                    <span class="overline-title">Sell Amount</span>
                                </th>
                                <th>
                                    <span class="overline-title">Recive Amount</span>
                                </th>
                                <th>
                                    <span class="overline-title">Due Amount</span>
                                </th>
                                <!--<th>-->
                                <!--    <span class="overline-title">Date</span>-->
                                <!--</th>-->
                            </tr>
                        </thead>
                         <tbody>
                            @if (count($client) > 0)
                                @php
                                    $i = 0;
                                @endphp

                                @foreach ($client as $Key => $billdata)
                                    @php
                                        $sellamount = 0;
                                        $reciveamount = 0;
                                        $restAmount = 0;
                                    @endphp
                                    @if (count($billdata->sale) > 0)
                                        @foreach ($billdata->sale as $sale)
                                            @php
                                                $sellamount = $sellamount + $sale->total;
                                                $totalsell = $totalsell + $sale->total;
                                            @endphp
                                        @endforeach
                                    @endif


                                    @if (count($billdata->reciver) > 0)
                                        @foreach ($billdata->reciver as $recive)
                                            @php
                                                $reciveamount = $reciveamount + $recive->amount;
                                                $totalrecive = $totalrecive + $recive->amount;
                                            @endphp
                                        @endforeach
                                    @endif
                                    @php
                                        $restAmount = $sellamount - $reciveamount;
                                    @endphp

                                    <tr>
                                        <td>{{ $i = $i + 1 }}</td>
                                        <td>{{ $billdata->name }}</td>
                                        <td>{{ $billdata->first_number }}</td>
                                        <td>{{ env('CURRENCY') }}{{ number_format($sellamount, 2) }}</td>
                                        <td>{{ env('CURRENCY') }}{{ number_format($reciveamount, 2) }}</td>
                                        <td>{{ env('CURRENCY') }}{{ number_format($restAmount, 2) }}</td>
                                        <!--<td>{{ $billdata->date }}</td>-->
                                    </tr>
                                @endforeach
                                @php
                                    $totalrest = $totalsell - $totalrecive;
                                @endphp
                            @endif
                        </tbody>
                    </table>


                </div>

                <div class="card-body px-0">
                    <div class="total_sale_amount">
                        <div class="col-xl-3 col-sm-12">
                            <p style="color: rgb(48, 47, 47); font-weight: 600; margin: 0;">Summary:</p>
                            <p style="margin: 0;">Total sale amount: <span
                                    style="font-weight: 600;">{{ env('CURRENCY') }}{{ number_format($totalsell, 2) }}</span>
                            </p>
                            <p style="margin: 0;">Total receive amount: <span
                                    style="font-weight: 600;">{{ env('CURRENCY') }}{{ number_format($totalrecive, 2) }}</span>
                            </p>

                            <p>Total due amount: <span
                                    style="font-weight: 600;margin: 0; color: #cf360f; ">{{ env('CURRENCY') }}{{ number_format($totalrest, 2) }}</span>
                            </p>

                        </div>



                    </div>
                </div>

            </div>
        </div>

    </div>

    <script></script>



    <script>
        document.getElementById("bill-pdf").addEventListener("click", function() {
            const table = document.getElementById("billtable");

            html2canvas(table).then(function(canvas) {
                const imgData = canvas.toDataURL("image/png");
                const pdf = new jsPDF();
                const imgWidth = 190;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                pdf.addImage(imgData, "PNG", 10, 10, imgWidth, imgHeight);
                pdf.save("BillDetails.pdf");
            });
        });

        document.getElementById("bill-excel").addEventListener("click", function() {
            var table = document.getElementById("billtable");
            var wb = XLSX.utils.table_to_book(table, {
                sheet: "Sheet1"
            });
            XLSX.writeFile(wb, "BillDetails.xlsx");
        });
    </script>
@endsection
