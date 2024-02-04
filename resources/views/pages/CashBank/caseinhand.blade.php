@extends('pages.layout')
@section('title')
    Case In Hand
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

        .all_btn .btn-sm {
            font-size: 15px;
        }
    </style>

    <div class="row g-gs">

        <div class="col-xl-12 col-sm-12 px-0">
            <div class="row">


                <div class="col-xl-12 col-sm-12">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="t_top">
                                <h4>CASH IN HAND TRANSACTION</h4>

                                <div class="all_btn">
                                    <div class="btn-group btn-group-sm me-3" role="group"
                                        aria-label="Basic outlined example">
                                        <button type="button" class="btn btn-outline-success mx-2" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalplus2"> +Add </button>
                                    </div>




                                </div>

                            </div>



                            <table id="mytable" width="100%" class="datatable-init table"
                                data-nk-container="table-responsive table-border">
                                <thead>
                                    <tr>
                                        <th>
                                            <span class="overline-title">Name</span>
                                        </th>
                                        <th>
                                            <span class="overline-title">Date</span>
                                        </th>
                                        <th>
                                            <span class="overline-title">Amount</span>

                                        </th>
                                        <th>
                                            <span class="overline-title">Action</span>

                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($case) > 0)
                                        @foreach ($case as $caseAmount)
                                            <tr>
                                                <td>{{ $caseAmount->name }}</td>
                                                <td>{{ Carbon\Carbon::parse($caseAmount->date)->format('d-m-Y ') }}</td>
                                                <td>{{ env('CURRENCY') }}{{ number_format($caseAmount->amount, 2) }}</td>
                                                <td><button data-bs-toggle="modal"data-bs-target="#exampleModalminus2"
                                                        class="btn btn-primary btn-sm px-3">Edit</button>
                                                    <button data-bs-toggle="modal"data-bs-target="#exampleModalminus21"
                                                        class="btn btn-danger btn-sm px-3">Delete</button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="exampleModalminus2" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{ route('case.remove.post', encrypt($caseAmount->id)) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Transaction </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-xl-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="exampleFormControlInputText1"
                                                                                class="form-label">
                                                                                Name</label>
                                                                            <div class="form-control-wrap">
                                                                                <input type="text" name="name"
                                                                                    value="{{ $caseAmount->name }}" required
                                                                                    class="form-control"
                                                                                    id="exampleFormControlInputText1"
                                                                                    placeholder="Name">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="exampleFormControlInputText1"
                                                                                class="form-label">Date</label>
                                                                            <div class="form-control-wrap">
                                                                                <input type="date" name="date"
                                                                                    required value="{{ $caseAmount->date }}"
                                                                                    class="form-control"
                                                                                    id="exampleFormControlInputText1"
                                                                                    placeholder="Date">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-4 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label for="exampleFormControlInputText1"
                                                                                class="form-label">Amount</label>
                                                                            <div class="form-control-wrap">
                                                                                <input type="text" name="amount"
                                                                                    class="form-control" required
                                                                                    value="{{ $caseAmount->amount }}"
                                                                                    id="exampleFormControlInputText1"
                                                                                    placeholder="Enter Amount">
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
                                            </div>
                                            <div class="modal" id="exampleModalminus21" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">
                                                                Delete </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are You Sure Delete This </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <a href="{{ route('case.delete', encrypt($caseAmount->id)) }}"
                                                                type="submit" class="btn btn-sm btn-danger">
                                                                Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalplus2" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('case.post') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Transaction </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-4 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInputText1" class="form-label">
                                        Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" required name="name" class="form-control"
                                            id="exampleFormControlInputText1" placeholder="Name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInputText1" class="form-label">Date</label>
                                    <div class="form-control-wrap">
                                        <input type="date" required name="date" class="form-control"
                                            id="exampleFormControlInputText1" placeholder="date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-12">
                                <div class="form-group">
                                    <label for="exampleFormControlInputText1" class="form-label">Add Amount</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="amount" class="form-control"
                                            id="exampleFormControlInputText1" placeholder="Amount">
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
