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
            margin-bottom: 10px;
        }

        #mytable tbody tr td .btn {
            padding: 3px 4px;
            color: #fff;
            font-weight: 600;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <div class="row g-gs mt-4">
        <div class="col-xl-12 col-sm-12 mt-2 px-0">
            <div class="card">
                <div class="card-body">
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
                    <div class="table_top">
                        <h4 class="mb-0">PROFIT ON SALE INVOICE</h4>

                        <div class="btn_grp">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-outline-warning" id="bill-excel">Excel</button>
                                <button type="button" class="btn btn-outline-danger" id="bill-pdf">PDF</button>
                            </div>

                        </div>

                    </div>

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
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($client) > 0)
                                @php
                                    $totalsell = 0;
                                    $totalrecive = 0;
                                    $totalrest = 0;
                                @endphp
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
                                        @foreach ($billdata->sale as $saleData)
                                            @php
                                                $sellamount = $sellamount + $saleData->total;
                                                $totalsell = $totalsell + $saleData->total;
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
                                        <td>{{ $billdata->date }}</td>
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

    <script>
          $("#selectdata").change(function() {
            var selectedValue = $(this).val();
            window.location = `/report/year/profit/${selectedValue}`;
        })
    </script>




@endsection
