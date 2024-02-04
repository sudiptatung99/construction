@extends('pages.layout')
@section('title')
    Report || Sell
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
        <div class="col-xl-12 col-sm-12 px-0">
            <div class="card">
                <div class="card-body">
                    <div class="total_mnth_select">
                        <form action="{{ route('report.recive-amount.between') }}" class="d-flex gap-3" method="POST">
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

                    @php
                        $totalAmount = 0;
                        $cashAmount = 0;
                        $onlineAmount = 0;
                    @endphp
                    @if (count($recive) > 0)
                        @foreach ($recive as $reciveamount)
                            @php
                                $totalAmount = $totalAmount + $reciveamount->amount;
                            @endphp
                        @endforeach
                    @endif
                    @if (count($case) > 0)
                        @foreach ($case as $case)
                            @php
                                $cashAmount = $cashAmount + $case->amount;
                            @endphp
                        @endforeach
                    @endif
                    @if (count($online) > 0)
                        @foreach ($online as $online)
                            @php
                                $onlineAmount = $onlineAmount + $online->amount;
                            @endphp
                        @endforeach
                    @endif

                    <div class="total_amount">
                        <div class="amount_div">
                            <p style="color: rgb(97, 97, 97); font-weight: 600; font-size: 13px;line-height: 23px;">Total
                            </p>

                            <p style="color:rgb(5, 5, 43);font-weight: 600; font-size: 21px;line-height: 23px;">
                                {{ env('CURRENCY') }}{{ number_format($totalAmount, 2) }}
                            </p>
                        </div>

                        <div class="amount_div" style="background-color: #aed6f3;">
                            <p style="color: rgb(97, 97, 97); font-weight: 600; font-size: 13px;line-height: 23px;">
                                Cash</p>

                            <p style="color:rgb(5, 5, 43);font-weight: 600; font-size: 21px;line-height: 23px;">
                                {{ env('CURRENCY') }}{{ number_format($cashAmount, 2) }}
                            </p>
                        </div>
                        <div class="amount_div" style="background-color: #fbe88c;">
                            <p style="color: rgb(97, 97, 97); font-weight: 600; font-size: 13px;line-height: 23px;">
                                Online</p>
                            <p style="color:rgb(5, 5, 43);font-weight: 600; font-size: 21px;line-height: 23px;">
                                {{ env('CURRENCY') }}{{ number_format($onlineAmount, 2) }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-sm-12 px-0">
            <div class="card">
                <div class="card-body">
                    <div class="table_top">
                        <p style="color: #000; font-weight: 500; font-size: 18px;">Recive Amount</p>

                        <div class="btn_grp">
                            <div class="btn-group btn-group-sm me-3" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-outline-warning" id="sell-excel">Excel</button>
                                <button type="button" class="btn btn-outline-danger" id="sell-pdf">PDF</button>
                            </div>
                            <a href="{{ route('sale.create') }}" class="btn btn-sm btn-primary">
                                <em class="icon ni ni-plus-circle-fill me-1"></em>
                                Add Sale</a>
                        </div>

                    </div>

                    <table id="selltable" width="100%" class="datatable-init table"
                        data-nk-container="table-responsive table-border">
                        <thead>
                            <tr>
                                <th>
                                    <span class="overline-title">#</span>
                                </th>
                                <th>
                                    <span class="overline-title">Date</span>
                                </th>
                                <th>
                                    <span class="overline-title">Name</span>
                                </th>
                                <th>
                                    <span class="overline-title">Payment Mode</span>
                                </th>
                                <th>
                                    <span class="overline-title">Payment Status</span>

                                </th>
                                <th>
                                    <span class="overline-title">Amount</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($recive) > 0)
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($recive as $Key => $item)
                                    <tr>
                                        <td>{{ $i = $i + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                                        <td>{{ $item->client->name }}</td>
                                        <td>{{ $item->payment_mode }}</td>
                                        <td>{{ $item->payment_status }}</td>
                                        <td> {{ env('CURRENCY') }}{{ number_format($item->amount) }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
@endsection
