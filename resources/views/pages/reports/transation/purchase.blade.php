@extends('pages.layout')
@section('title')
Report || Purchase
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
                        <div class="mnth_select">

                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <select class="form-select" id="pudata" aria-label="Default select example">
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
                        <form action="{{ route('report.purchase.between') }}" class="d-flex gap-3" method="POST">
                            @csrf
                            <div class="date_select">
                                <p>Between</p>

                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input placeholder="dd/mm/yyyy" name="first_date" value="{{ isset($from)?$from:"" }}"
                                            type="date" class="form-control-sm " data-today-btn="true"
                                            data-clear-btn="true" autocomplete="off" id="datePicker1">
                                    </div>
                                </div>

                                <p style="background-color: transparent; color: #000;">To</p>
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <input placeholder="dd/mm/yyyy" name="second_date" type="date"
                                            value="{{ isset($to)?$to:"" }}" class="form-control-sm" data-today-btn="true"
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
                        <!--<div class="amount_div">-->
                        <!--    <p style="color: rgb(97, 97, 97); font-weight: 600; font-size: 13px;line-height: 23px;">Paid-->
                        <!--    </p>-->
                            @php
                                $paidamount = 0;
                            @endphp
                            @foreach ($paid as $paid)
                                @php
                                    $paidamount = $paidamount + $paid->total;
                                @endphp
                            @endforeach
                        <!--    <p style="color:rgb(5, 5, 43);font-weight: 600; font-size: 21px;line-height: 23px;">-->
                        <!--        {{ env('CURRENCY') }}{{ number_format($paidamount, 2) }}-->
                        <!--    </p>-->
                        <!--</div>-->

                        <!--<div class="icon_div">-->
                        <!--    <em class="icon ni ni-plus"></em>-->
                        <!--</div>-->

                        <!--<div class="amount_div" style="background-color: #aed6f3;">-->
                        <!--    <p style="color: rgb(97, 97, 97); font-weight: 600; font-size: 13px;line-height: 23px;">-->
                        <!--        Unpaid</p>-->
                            @php
                                $unpaidamount = 0;
                            @endphp
                            @foreach ($unpaid as $unpaid)
                                @php
                                    $unpaidamount = $unpaidamount + $unpaid->total;
                                @endphp
                            @endforeach
                        <!--    <p style="color:rgb(5, 5, 43);font-weight: 600; font-size: 21px;line-height: 23px;">-->
                        <!--        {{ env('CURRENCY') }}{{ number_format($unpaidamount, 2) }}-->
                        <!--    </p>-->
                        <!--</div>-->
                        <!--<div class="icon_div">-->
                        <!--    <em class="icon ni ni-equal"></em>-->
                        <!--</div>-->
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
        </div>

        <div class="col-xl-12 col-sm-12 px-0">
            <div class="card">
                <div class="card-body">
                    <div class="table_top">
                        <p style="color: #000; font-weight: 500; font-size: 18px;">Transactions</p>

                        <div class="btn_grp">
                            <div class="btn-group btn-group-sm me-3" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-outline-warning" id="purchase-excel">Excel</button>
                                <button type="button" class="btn btn-outline-danger" id="purchase-pdf">PDF</button>
                            </div>
                            <a href="{{ route('purchase.create') }}" class="btn btn-sm btn-primary">
                                <em class="icon ni ni-plus-circle-fill me-1"></em>
                                Add Sale</a>
                        </div>

                    </div>

                    <table id="purchasetable" width="100%" class="datatable-init table"
                        data-nk-container="table-responsive table-border">
                        <thead>
                            <tr>
                                <th>
                                    <span class="overline-title">#</span>
                                </th>
                                <th>
                                    <span class="overline-title">Purchase ID</span>
                                </th>
                                <th>
                                    <span class="overline-title">Date</span>
                                </th>
                                 <th>
                                    <span class="overline-title">Vendor Name</span>

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
                                    <td>{{ $item->expeseno }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                                    <td>{{$item->vendor->name}}</td>
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
        document.getElementById("purchase-pdf").addEventListener("click", function() {
            const table = document.getElementById("purchasetable");

            html2canvas(table).then(function(canvas) {
                const imgData = canvas.toDataURL("image/png");
                const pdf = new jsPDF();
                const imgWidth = 190;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                pdf.addImage(imgData, "PNG", 10, 10, imgWidth, imgHeight);
                pdf.save("Purchase-report.pdf");
            });
        });

        document.getElementById("purchase-excel").addEventListener("click", function() {
            var table = document.getElementById("purchasetable");
            var wb = XLSX.utils.table_to_book(table, {
                sheet: "Sheet1"
            });
            XLSX.writeFile(wb, "Purchase-report.xlsx");
        });
    </script>
    <script>
        $("#pudata").change(function() {
            var selectedValue = $(this).val();
            window.location = `/report/purchases/${selectedValue}`;
        })
    </script>
@endsection
