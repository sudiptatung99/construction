@extends('pages.layout')
@section('title')
    Dashboard
@endsection
@section('content')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <div class="row g-gs">
        <div class="col-xl-9 col-sm-12">
            <div class="row">

                <div class="col-xl-12 col-sm-12 ps-0 pe-1">
                    <div class="card h-100">
                        <div class="card-body p-2">
                            <div class="row justify-content-between">
                                <div class="col-3">
                                    <p style="font-weight: 600; color: #000;">
                                        <em class="icon ni ni-row-view1" style="color: #f3c725; font-size: 18px;"></em>
                                        Sales
                                    </p>
                                </div>

                                <div class="col-4">


                                </div>
                            </div>

                            <div class="sale_detail mt-3">
                                <div class="amount_detail">

                                    <h2 class="mb-0" style="color: #000; font-weight: 600;">
                                        {{ env('CURRENCY') }}<span>{{ number_format($totalamount, 2) }}</span>
                                    </h2>
                                    <p class="mb-0" style="color: rgb(94 91 91); font-size: 18px;">
                                        Total Sale</p>

                                    <div class="prcnt_down">
                                        @php
                                            // const growthRate = ((finalValue - initialValue) / initialValue) * 100;
                                            if ($presentdatatotal != 0) {
                                                $grow = (($onedatatotal - $presentdatatotal) / $presentdatatotal) * 100;
                                            } else {
                                                $grow = 0;
                                            }
                                        @endphp
                                        @if ($grow > 0)
                                            <p class="mb-0" style="color: rgb(6, 226, 116); font-size: 18px;">
                                                <em class="icon ni ni-arrow-long-up"></em>
                                                {{ abs($grow) }}%
                                            </p>
                                            <p class="mb-0" style="color: rgb(173, 173, 173); font-size: 14px;">
                                                This Month Growth
                                            </p>
                                        @else
                                            <p class="mb-0" style="color: rgb(218, 39, 39); font-size: 18px;">
                                                <em class="icon ni ni-arrow-long-down"></em>
                                                {{ abs($grow) }}%
                                            </p>
                                            <p class="mb-0" style="color: rgb(173, 173, 173); font-size: 14px;">
                                                This Month Growth
                                            </p>
                                        @endif

                                    </div>
                                </div>

                                <div class="graph_detail">
                                    <div class="col-lg-12">
                                        <div class="card" style="border: transparent;">
                                            <div class="card-body px-0">
                                                <div class="nk-chart-overview">
                                                    <canvas data-nk-chart="line" id="lineChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-xl-4 col-sm-12 px-0">
                                        <div class="card">
                                            <div class="card-body p-2">
                                                <div class="row justify-content-between">
                                                    <div class="col-6">
                                                        <p class="mb-0"
                                                            style="font-size: 17px;  color: gray;  display: flex; align-items: baseline; column-gap: 5px;">
                                                            <em class="icon ni ni-wallet"
                                                                style="color: #a31de0; font-size: 17px; font-weight: 600;"></em>
                                                            Sale Amount
                                                        </p>

                                                        <p class="mb-0" style="color: #000; font-weight: 600;font-size: 17px;">
                                                            {{ env('CURRENCY') }}<span
                                                                id="salevalue">{{ number_format($totalamount, 2) }}</span>
                                                        </p>
                                                    </div>

                                                    <div class="col-6 ps-0 pe-2">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <select class="form-select form-select-sm" name="monthsale" id="monthsale"
                                                                    aria-label="Default select example">
                                                                    <option value=""selected disabled>--select--</option>
                                                                    <option value="this_month">This month</option>
                                                                    <option value="last_month">Last Month</option>
                                                                    <option value="three_month">Last 3 Month</option>
                                                                    <option value="pre_year">Previous Year</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>

                                                <div class="nk-chart-overview">
                                                    <canvas data-nk-chart="pie" id="pieChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->


            </div>

        </div>


        <div class="col-xl-3 col-sm-12 pe-0">
            <h4 style="font-size: 15px;">Cash & Bank</h4>
            <div class="row w-100 m-0">
                <div class="col-xl-6 col-sm-12 w-100 p-0">
                    <div class="card">
                        <div class="card-body p-2">
                            @php
                                $cadeamount = 0;
                            @endphp
                            @if (count($case) > 0)
                                @foreach ($case as $caseData)
                                    @php
                                        $cadeamount = $cadeamount + $caseData->amount;
                                    @endphp
                                @endforeach
                            @endif
                            <p class="mb-0" style="color: #444343; font-size: 14px; font-weight: 600;">
                                Cash in Hand</p>
                            <h4 style="color: #31bb20; font-weight: 500;">
                                {{ env('CURRENCY') }}{{ number_format($cadeamount, 2) }}</h4>

                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-sm-12 w-100 p-0 mt-3">
                    <div class="card">
                        <div class="card-body p-2">
                            @php
                                $bankData = 0;
                            @endphp
                            @if (count($bank) > 0)
                                @foreach ($bank as $bankAmount)
                                    @php
                                        $bankData = $bankData + $bankAmount->amount;
                                    @endphp
                                @endforeach
                            @endif

                            <p class="mb-0" style="color: #444343; font-size: 14px; font-weight: 600;">
                                Bank Account</p>
                            <h4 style="color: #31bb20; font-weight: 500;">
                                {{ env('CURRENCY') }}{{  number_format($bankData, 2) }}</h4>

                        </div>
                    </div>


                </div>
            </div>

            <h4 class="mt-4" style="font-size: 15px;">Sales</h4>
            <div class="row w-100 m-0">

                <div class="col-xl-6 col-sm-12 w-100 p-0 mb-3">
                    <div class="card">
                        <div class="card-body p-2">
                            <h5 style="color: gray; font-size: 14px;">Sale Orders</h5>
                            <div class="list_detail">
                                <p>No. of sales</p>
                                <p>{{ count($items) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">

            <div class="col-xl-3 col-sm-12 col_pur">
                <div class="card h-100">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-6">
                                <p>
                                    <em class="icon ni ni-wallet"></em>
                                    Sales
                                </p>

                            </div>

                            <div class="col-6 ps-0 pe-2">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select class="form-select form-select-sm" name="monthsale" id="monthsale"
                                            aria-label="Default select example">
                                            <option value=""selected disabled>--select--</option>
                                            <option value="this_month">This month</option>
                                            <option value="last_month">Last Month</option>
                                            <option value="three_month">Last 3 Month</option>
                                            <option value="pre_year">Previous Year</option>
                                        </select>
                                    </div>
                                </div>


                            </div>

                            <p class="mb-0" style="color: #000; font-weight: 600;font-size: 15px;">
                                {{ env('CURRENCY') }}<span id="salevalue">{{ number_format($totalamount, 2) }}</span>
                            </p>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-12 col_pur">
                <div class="card h-100">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-6">
                                <p>
                                    <em class="icon ni ni-wallet"></em>
                                    Receive
                                </p>

                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select class="form-select form-select-sm" name="monthrecive" id="monthrecive"
                                            aria-label="Default select example">
                                            <option value=""selected disabled>--select--</option>
                                            <option value="this_month">This month</option>
                                            <option value="last_month">Last Month</option>
                                            <option value="three_month">Last 3 Month</option>
                                            <option value="pre_year">Previous Year</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0" style="color: #000; font-weight: 600;font-size: 15px;">
                                {{ env('CURRENCY') }}<span id="recivevalue">{{ number_format($totalrecive, 2) }}</span>
                            </p>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-12 col_pur">
                <div class="card h-100">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-6">
                                <p>
                                    <em class="icon ni ni-wallet"></em>
                                    Expense
                                </p>

                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <select class="form-select form-select-sm" name="monthexpense"
                                                id="monthexpense" aria-label="Default select example">
                                                <option value=""selected disabled>--select--</option>
                                                <option value="this_month">This month</option>
                                                <option value="last_month">Last Month</option>
                                                <option value="three_month">Last 3 Month</option>
                                                <option value="pre_year">Previous Year</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0" style="color: #000; font-weight: 600;font-size: 15px;">
                                {{ env('CURRENCY') }}<span id="expensevalue">{{ number_format($totalexpense, 2) }}</span>
                            </p>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-12 col_pur">
                <div class="card h-100">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-6">
                                <p>
                                    <em class="icon ni ni-wallet"></em>
                                    Purchase
                                </p>

                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <select class="form-select form-select-sm" name="monthpurchase"
                                            id="monthpurchase" aria-label="Default select example">
                                            <option value=""selected disabled>--select--</option>
                                            <option value="this_month">This month</option>
                                            <option value="last_month">Last Month</option>
                                            <option value="three_month">Last 3 Month</option>
                                            <option value="pre_year">Previous Year</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0" style="color: #000; font-weight: 600;font-size: 15px;">
                                {{ env('CURRENCY') }}<span
                                    id="purchasevalue">{{ number_format($totalpurchase, 2) }}</span></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-sm-12">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="t_top">
                        <h3>Stock Management:</h3>
                    </div>
                    <table id="mytable_sell" width="100%" class="datatable-init table"
                        data-nk-container="table-responsive table-border">
                        <thead>
                            <tr>
                                <th>
                                    <span class="overline-title">#</span>
                                </th>
                                <th>
                                    <span class="overline-title">Item Name</span>
                                </th>
                                <th>
                                    <span class="overline-title">Purchase Quantity</span>
                                </th>
                                <th>
                                    <span class="overline-title">Sell Quantity</span>
                                </th>
                                <th>
                                    <span class="overline-title">Rest Quantity</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stock as $key => $stock)
                                @php
                                    $purchaseqty = 0;
                                    $saleqty = 0;
                                    $restqty = 0;
                                    $returnQty = 0;
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $stock->name }}</td>
                                    @if (count($stock->return) > 0)
                                        @foreach ($stock->return as $returnItem)
                                            @php
                                                $returnQty = $returnQty + $returnItem->qty;
                                            @endphp
                                        @endforeach
                                    @endif
                                    @if (count($stock->purchaseitem) > 0)
                                        @foreach ($stock->purchaseitem as $purqty)
                                            @php
                                                $purchaseqty = $purchaseqty + $purqty->qty;
                                            @endphp
                                        @endforeach
                                    @endif

                                    <td>{{ $purchaseqty + $returnQty }}</td>
                                    @if (count($stock->saleitem) > 0)
                                        @foreach ($stock->saleitem as $sellqty)
                                            @php
                                                $saleqty = $saleqty + $sellqty->qty;
                                            @endphp
                                        @endforeach
                                    @endif
                                    <td>
                                        {{ $saleqty - $returnQty }}
                                    </td>
                                    @php
                                        $restqty = $purchaseqty - $saleqty;
                                    @endphp

                                    <td>{{ $restqty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            var recive = "{{ $totalrecive }}";
            var send = "{{ $totalamount }}";
            !(function(NioApp) {
                "use strict";
                let lineChart = {
                    labels: ["{{ $sevenmonth }}", "{{ $sixmonth }}", "{{ $fivemonth }}",
                        "{{ $fourmonth }}", "{{ $threemonth }}", "{{ $twomonth }}",
                        "{{ $onemonth }}", "{{ $presentmonth }}"
                    ],

                    lineTension: .4,
                    datasets: [{
                        color: NioApp.Colors.primary,
                        data: ["{{ $sevendatatotal }}", "{{ $sixdatatotal }}", "{{ $fivedatatotal }}",
                            "{{ $fourdatatotal }}", "{{ $threedatatotal }}", "{{ $twodatatotal }}",
                            "{{ $onedatatotal }}", "{{ $presentdatatotal }}"
                        ]
                    }]
                }

                let pieChart = {
                    labels: ["Send", "Receive"],
                    datasets: [{
                        background: [NioApp.Colors.orange, NioApp.Colors.blue, NioApp.Colors.green],
                        data: [send, recive]
                    }],
                }

                //chart
                NioApp.Chart = {
                    tooltip: {
                        rtl: NioApp.State.isRTL,
                        textDirection: NioApp.State.isRTL ? 'rtl' : 'ltr',
                        padding: 12,
                        boxWidth: 10,
                        boxHeight: 10,
                        boxPadding: 6,
                        backgroundColor: NioApp.Colors.gray100,
                        titleColor: NioApp.Colors.gray900,
                        bodyColor: NioApp.Colors.bodyColor,
                    },
                    legend: {
                        rtl: NioApp.State.isRTL,
                        position: 'top',
                        labels: {
                            boxWidth: 12,
                            boxHeight: 12,
                            fontColor: NioApp.Colors.bodyColor,
                            padding: 10,
                        }
                    },
                    line: function(selector, data) {
                        let elm = document.querySelectorAll(selector);
                        elm.forEach(item => {
                            let chartId = item.id;
                            let setData = (typeof data === 'undefined') ? eval(chartId) : data;
                            let chartLegend = (typeof setData.legend === 'undefined') ? false : setData
                                .legend;
                            let chartData = [];
                            for (let i = 0; i < setData.datasets.length; i++) {
                                chartData.push({
                                    label: setData.datasets[i].label,
                                    tension: setData.lineTension,
                                    backgroundColor: (typeof setData.datasets[i].background ===
                                            'undefined') ? 'transparent' : setData.datasets[i]
                                        .background,
                                    borderWidth: 2,
                                    borderColor: setData.datasets[i].color,
                                    pointBorderColor: setData.datasets[i].color,
                                    pointBackgroundColor: NioApp.Colors.white,
                                    pointHoverBackgroundColor: NioApp.Colors.white,
                                    pointHoverBorderColor: setData.datasets[i].color,
                                    pointBorderWidth: 2,
                                    pointHoverRadius: 4,
                                    pointHoverBorderWidth: 2,
                                    pointRadius: 4,
                                    pointHitRadius: 4,
                                    fill: true,
                                    data: setData.datasets[i].data
                                });
                            }

                            let canvas = document.getElementById(chartId).getContext("2d");
                            let chart = new Chart(canvas, {
                                type: 'line',
                                data: {
                                    labels: setData.labels,
                                    datasets: chartData
                                },
                                options: {
                                    plugins: {
                                        legend: {
                                            display: chartLegend,
                                            ...NioApp.Chart.legend,
                                        },
                                        tooltip: {
                                            enabled: true,
                                            ...NioApp.Chart.tooltip,
                                        },
                                    },
                                    interaction: {
                                        mode: 'nearest',
                                    },
                                    responsive: true,
                                    maintainAspectRatio: false,
                                }
                            });
                        });
                    },

                    pie: function(selector, data) {
                        let elm = document.querySelectorAll(selector);
                        elm.forEach(item => {
                            let chartId = item.id;
                            let setData = (typeof data === 'undefined') ? eval(chartId) : data;
                            let chartLegend = (typeof setData.legend === 'undefined') ? false : setData
                                .legend;
                            let chartData = [];

                            for (let i = 0; i < setData.datasets.length; i++) {
                                chartData.push({
                                    label: setData.datasets[i].label,
                                    backgroundColor: (typeof setData.datasets[i].background ===
                                            'undefined') ? 'transparent' : setData.datasets[i]
                                        .background,
                                    borderColor: setData.datasets[i].color,
                                    data: setData.datasets[i].data,
                                });
                            }

                            let canvas = document.getElementById(chartId).getContext("2d");
                            let chart = new Chart(canvas, {
                                type: 'pie',
                                data: {
                                    labels: setData.labels,
                                    datasets: chartData
                                },
                                options: {
                                    plugins: {
                                        legend: {
                                            display: chartLegend,
                                            ...NioApp.Chart.legend,
                                        },
                                        tooltip: {
                                            enabled: true,
                                            ...NioApp.Chart.tooltip,
                                        },
                                    },
                                    responsive: true,
                                    maintainAspectRatio: false,
                                }
                            });
                        });
                    },

                }


                NioApp.Chart.init = function() {
                    NioApp.Chart.line('[data-nk-chart="line"]');
                    NioApp.Chart.pie('[data-nk-chart="pie"]');

                }

                NioApp.winLoad(NioApp.Chart.init);


            })(NioApp);
        </script>
    @endpush


    <script>
        // $(document).on('change','#monthsale',function(){
        //     var data = $(this).val();
        //     console.log(data)
        // })
        $(document).on('change', '#monthsale', function(e) {
            var selectedValue = e.target.value;
            $.ajax({
                url: `/salesadboard/${selectedValue}`,
                type: "GET",
                success: function(data) {
                    var alldata = JSON.parse(data);
                    recive = alldata.recive;
                    send = alldata.sale;
                    console.log(recive);
                    document.getElementById('salevalue').innerHTML = parseFloat(alldata.sale).toFixed(
                        2);
                }
            })
        })

        $(document).on('change', '#monthexpense', function(e) {
            var selecteddatas = e.target.value;
            console.log();
            $.ajax({
                url: `/expenseboard/${selecteddatas}`,
                type: "GET",
                success: function(data) {
                    document.getElementById('expensevalue').innerHTML = parseFloat(data).toFixed(2);
                }
            })
        })

        $(document).on('change', '#monthpurchase', function(e) {
            var selecteddata = e.target.value;
            $.ajax({
                url: `/purchaseboard/${selecteddata}`,
                type: "GET",
                success: function(data) {
                    document.getElementById('purchasevalue').innerHTML = parseFloat(data).toFixed(2);
                }
            })
        })

        $(document).on('change', '#monthrecive', function(e) {
            var selecteddata = e.target.value;
            $.ajax({
                url: `/reciveabord/${selecteddata}`,
                type: "GET",
                success: function(data) {
                    console.log(data);
                    document.getElementById('recivevalue').innerHTML = parseFloat(data).toFixed(2);
                }
            })
        })
    </script>
@endsection
