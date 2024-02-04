@extends('pages.layout')
@section('title')
Report || Profit Loss
@endsection
@section('content')
    <style>
        #profit-loss tbody tr td {
            padding: 5px 12px !important;
        }

        #profit-loss thead tr th {
            padding: 5px 12px !important;
        }

        #profit-loss tbody tr:nth-child(even) {
            background-color: #e1e1e1;
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

    <div class="row g-gs mt-5">
        {{-- <div class="col-xl-12 col-sm-12 px-0">
            <div class="card">
                <div class="card-body">
                    <div class="total_mnth_select">
                        <div class="mnth_select">
                        <div class="date_select">
                            <p>From</p>

                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input placeholder="dd/mm/yyyy" type="text" class="form-control-sm js-datepicker"
                                        data-today-btn="true" data-clear-btn="true" autocomplete="off" id="datePicker1">
                                </div>
                            </div>

                            <p style="background-color: transparent; color: #000;">To</p>
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input placeholder="dd/mm/yyyy" type="text" class="form-control-sm js-datepicker"
                                        data-today-btn="true" data-clear-btn="true" autocomplete="off" id="datePicker1">
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div> --}}

        <div class="col-xl-12 col-sm-12 mt-2 px-0">
            <div class="card">
                <div class="card-body p-0" id="profit-loss">
                    <table class="table-striped" width="100%" border="0">
                        <thead>
                            <tr style="background-color: #e1e1e1;">
                                <th style="text-align: left; font-size: 14px; color: rgb(66, 66, 66); font-weight: 600;">
                                    Particulars
                                </th>
                                <th style="text-align: right;font-size: 14px; color: rgb(66, 66, 66);font-weight: 600;">
                                    Amount
                                </th>

                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $sales = 0;
                                $purchases = 0;
                                $salegst = 0;
                                $purchasegst = 0;
                                $expense = 0;
                                $credit = 0;
                                $totalsale = 0;
                                $totalpurchase = 0;
                                $dueamount = 0;
                                
                            @endphp
                            <tr>
                                @foreach ($purchase as $purchase)
                                    @php
                                        $purchases = $purchases + $purchase->subtotal;
                                        $purchasegst = $purchasegst + $purchase->gstamount;
                                        $totalpurchase = $totalpurchase + $purchase->total;
                                    @endphp
                                @endforeach

                                <td  style="text-align: left; color: #000;">Purchase</td>
                                <td style="text-align: right; color: #e91a1a;">
                                    {{ env('CURRENCY') }}{{ number_format($purchases, 2) }}</td>
                            </tr>
                            <tr>
                                <td  style="text-align: left; color: #000;">Purchase GST</td>
                                <td style="text-align: right; color: #e91a1a;">
                                    {{ env('CURRENCY') }}{{ number_format($purchasegst, 2) }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: left; color: #000;">Total Purchase</td>
                                <td style="text-align: right; color: #e91a1a;">{{ env('CURRENCY') }}{{ number_format($totalpurchase, 2) }}</td>
                            </tr>
                            <tr>
                                @foreach ($sale as $sale)
                                    @php
                                        $sales = $sales + $sale->subtotal;
                                        $salegst = $salegst + $sale->gstamount;
                                        $totalsale = $totalsale + $sale->total;
                                    @endphp
                                @endforeach
                                <td style="text-align: left; color: #000;">Sale</td>
                                <td style="text-align: right; color: #229613;">
                                    {{ env('CURRENCY') }}{{ number_format($sales, 2) }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: left; color: #000;">Sale GST</td>
                                <td style="text-align: right; color: #229613;">
                                    {{ env('CURRENCY') }}{{ number_format($salegst, 2) }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: left; color: #000;">Total Sale</td>
                                <td style="text-align: right; color: #229613;">{{ env('CURRENCY') }}{{ number_format($totalsale, 2) }}</td>
                            </tr>

                            <tr>
                                @foreach ($recive as $recive)
                                    @php
                                        $credit = $credit + $recive->amount;
                                    @endphp
                                @endforeach
                                <td style="text-align: left; color: #000;">Credit</td>
                                <td style="text-align: right; color: #229613;">
                                    {{ env('CURRENCY') }}{{ number_format($credit, 2) }}</td>
                            </tr>
                            </tr>
                          
                           
                            @php
                              $dueamount =  $totalsale-$credit;
                            @endphp
                            <tr>
                              <td style="text-align: left; color: #000;">Due Amount</td>
                              <td style="text-align: right;color: #fd0c0c;">{{ env('CURRENCY') }}{{ number_format($dueamount, 2) }}</td>
                          </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
