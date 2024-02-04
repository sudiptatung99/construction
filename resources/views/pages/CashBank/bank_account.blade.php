@extends('pages.layout')
@section('title')
    Bank Account
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
        }
    </style>

    <div class="row g-gs">
        <div class="col-xl-3 col-sm-12 ps-0 pe-2">
            <div class="card h-100">
                <div class="card-body bank_data">
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Add Party
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="text" class="form-control" id="formGroupExampleInput"
                                                placeholder="Party Name*" />
                                        </div>

                                        <div class="col-4">
                                            <input type="text" class="form-control" id="formGroupExampleInput"
                                                placeholder="GSTIN" />
                                        </div>

                                        <div class="col-4">
                                            <input type="text" class="form-control" id="formGroupExampleInput"
                                                placeholder="Phone Number" />
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary">
                                        Save changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table width="100%">
                        <button class='btn btn-sm btn-warning' style="float: right; margin-right: 10px;"
                            data-bs-toggle="modal"data-bs-target="#exampleModaladdbank">Add Bank</button>
                        <div class="modal fade" id="exampleModaladdbank" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <form action="{{ route('add-bank') }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Add Bank
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xl-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInputText1" class="form-label">Bank
                                                            Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" placeholder="Bank Name"
                                                                class="form-control" name="name"
                                                                id="exampleFormControlInputText122">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInputText1" class="form-label">Holder
                                                            Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" name="holdername" class="form-control"
                                                                id="exampleFormControlInputText1" placeholder="Holder Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInputText1" class="form-label">Account
                                                            Number</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" name="account_number" class="form-control"
                                                                id="exampleFormControlInputText1"
                                                                placeholder="Account Number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInputText1"
                                                            class="form-label">Amount</label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" name="amount" class="form-control"
                                                                id="exampleFormControlInputText1" placeholder="Amount">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary"
                                                data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-sm btn-warning">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th style="text-align: left; font-size: 14px; padding-left: 10px;">Account Name</th>
                                <th style="text-align: right; font-size: 14px; padding-right: 10px;">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($banks))
                            @foreach ($banks as $item)
                                <tr>
                                    <td style="text-align: left;"><a href="{{ route('bank', encrypt($item->id)) }}">
                                            <em class="icon ni ni-home-fill" style="color: green;"></em>
                                            {{ $item->holdername }}</a>
                                    </td>
                                    <td
                                        style="
                display: flex;
                justify-content: space-between;
                align-items: center;">
                                        {{ env('CURRENCY') }}{{ number_format($item->amount, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-sm-12 px-0">
            <div class="row">
                <div class="col-xl-12 col-sm-12">
                    <div class="card mb-3">
                        @if(isset($bank))
                        <div class="card-body">
                            <div class="bank_detail_div">
                                <div class="bank_detail_div_part">

                                    <div class="bank_detail_div">
                                        <h4>
                                            <span
                                                style="color: rgb(161, 161, 161); font-size: 14px; font-weight: 500;">Bank
                                                Name:</span>
                                            {{ ($bank->name) }}
                                        </h4>
                                    </div>

                                    <div class="bank_detail_div">
                                        <h4>
                                            <span
                                                style="color: rgb(161, 161, 161); font-size: 14px; font-weight: 500;">Bank
                                                Account Number:</span>
                                            {{ ($bank->account_number) }}
                                        </h4>
                                    </div>

                                    <div class="bank_detail_div">
                                        <h4>
                                            <span style="color: rgb(161, 161, 161); font-size: 14px; font-weight: 500;">
                                                Account Holder Name:</span>
                                            {{ ($bank->holdername) }}
                                        </h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="col-xl-12 col-sm-12">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="t_top">
                                <h4>BANK TRANSACTION</h4>

                                <div class="all_btn">
                                    <div class="btn-group btn-group-sm me-3" role="group"
                                        aria-label="Basic outlined example">
                                        <button type="button" class="btn btn-outline-success mx-2"
                                            data-bs-toggle="modal" data-bs-target="#exampleModalplus"> + </button>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalminus"> - </button>

                                    </div>
                                </div>

                            </div>

                            <table id="mytable" width="100%" class="datatable-init table"
                                data-nk-container="table-responsive table-border">
                                <thead>
                                    <tr>
                                        <th class="text-start">
                                            <span class="overline-title">Name</span>
                                        </th>
                                        <th>
                                            <span class="overline-title">Update Date</span>
                                        </th>
                                        <th>
                                            <span class="overline-title">Amount</span>

                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($bank))
                                    <tr>
                                        <td>{{ ($bank->holdername) }}</td>
                                        <td>{{ Carbon\Carbon::parse(($bank->updated_at))->format('d-m-Y ') }}</td>
                                        <td>{{ env('CURRENCY') }}{{ number_format(($bank->amount), 2) }}</td>


                                        <div class="modal fade" id="exampleModalplus" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <form action="{{ route('bank.post',encrypt(($bank->id))) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Transaction
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="row">
                                                                <div class="col-xl-4 col-sm-12">
                                                                    <div class="form-group">
                                                                        <div class="form-group">
                                                                            <label for="exampleFormControlInputText1"
                                                                                class="form-label">Bank Name</label>
                                                                            <div class="form-control-wrap">
                                                                                <input type="text"
                                                                                    value="{{ ($bank) ? $bank->name : '' }}"
                                                                                    class="form-control"
                                                                                    id="exampleFormControlInputText1"
                                                                                    placeholder="Item Number" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-4 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlInputText1"
                                                                            class="form-label">Account Number</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="text"
                                                                                value="{{ ($bank) ? $bank->account_number : '' }}"
                                                                                class="form-control" id="gfhh"
                                                                                placeholder="Item Number" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-4 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlInputText1"
                                                                            class="form-label">Amount</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="text" name="amount"
                                                                                value="{{ ($bank) ? $bank->amount : '' }}"
                                                                                readonly class="form-control"
                                                                                id="exampleFormControlInputText1"
                                                                                placeholder="Amount">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-4 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlInputText1"
                                                                            class="form-label">Add Amount</label>
                                                                        <div class="form-control-wrap">
                                                                            <input type="text" name="extra_amount"
                                                                                class="form-control"
                                                                                id="exampleFormControlInputText1"
                                                                                placeholder="Enter Add Amount">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <button type="submit" class="btn btn-sm btn-primary">
                                                                Save changes
                                                            </button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>

                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(isset($bank))
    <div class="modal fade" id="exampleModalminus" tabindex="-1" aria-labelledby="exampleModalLabelminus"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('bank.remove.post', encrypt($bank->id)) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelminus">
                            Transaction
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-xl-4 col-sm-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="exampleFormControlInputText1" class="form-label">Bank Name</label>
                                        <div class="form-control-wrap">
                                            <input type="text" value="{{  $bank->name  }}"
                                                class="form-control" id="exampleFormControlInputText1"
                                                placeholder="Item Number" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInputText1" class="form-label">Account Number</label>
                                    <div class="form-control-wrap">
                                        <input type="text" value="{{ $bank->account_number }}"
                                            class="form-control" id="gfhh" placeholder="Item Number" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInputText1" class="form-label">Amount</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="amount"
                                            value="{{ $bank->amount }}" readonly
                                            class="form-control" id="exampleFormControlInputText1" placeholder="Amount">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInputText1" class="form-label">Debited Amount</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="extra_amount" class="form-control"
                                            id="exampleFormControlInputText1" placeholder="Enter Debited  Amount">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary">
                            Save changes
                        </button>
                    </div>
            </form>
        </div>
    </div>
     @endif

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
