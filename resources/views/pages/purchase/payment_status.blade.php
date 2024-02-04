@extends('pages.layout')
@section('title')
    Payment Status
@endsection
@section('content')

    <style>
        /* dynamically add row css */
        .add_row_div {
            /* max-width: 900px; */
            width: 100%;
            background-color: #fff;
            margin: auto;
            padding: 0;
            /* box-shadow: 0 2px 20px #0001, 0 1px 6px #0001; */
            /* border-radius: 5px; */
            overflow-x: auto;
        }

        ._table {
            width: 100%;
            border-collapse: collapse;
        }

        ._table :is(th, td) {
            border: 1px solid #0002;
            padding: 0px 10px;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
        }

        .action_container .btn {
            font-size: 15px;
        }
    </style>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-gs">
        <div class="col-xl-12 px-0">

            <div class="card mb-3">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">Vendor Name</div>
                            <div class="col">{{ $purchase->vendor->name }}</div>
                            <div class="w-100"></div>
                            <div class="col">Total Amount</div>
                            <div class="col">{{ $purchase->total }}</div>
                            <div class="w-100"></div>
                            <div class="col">Status</div>
                            <div class="col">{{ $purchase->payment_status }}</div>
                            <div class="w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="all_btn float-left">
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#examplepayment">
                            + Add More
                        </button>
                    </div>
                    <div class="row justify-content-between">

                        <div class="col-xl-12 mt-4">
                            <table id="myexpense" width="100%" class="datatable-init table"
                                data-nk-container="table-responsive table-border">
                                <thead>
                                    <tr>
                                        <th><span class="overline-title">#</span></th>
                                        {{-- <th><span class="overline-title">Expenses No.</span></th> --}}
                                        <th><span class="overline-title">Date </span></th>
                                        <th><span class="overline-title">Amount</span></th>
                                        <th><span class="overline-title">Paymrnt Mode </span></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($venPayment) > 0)
                                        @foreach ($venPayment as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                                                <td>{{ env('CURRENCY') }}{{ number_format($item->total, 2) }}</td>
                                                <td>{{ $item->payment_mode }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="modal fade" id="examplepayment" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ route('payment.create', encrypt($id)) }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    Add Payment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xl-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Payment Mode</label>
                                                            <div class="form-control-wrap">
                                                                <select class="js-select" data-search="true"
                                                                    name="payment_mode" required data-sort="false">
                                                                    <option value="">Choose</option>
                                                                    {{ getPaymentMode('') }}
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInputText1" class="form-label">Add
                                                                Amount</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" required name="total"
                                                                    class="form-control" id="exampleFormControlInputText1"
                                                                    placeholder="Add Amount">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInputText1"
                                                                class="form-label">Date</label>
                                                            <div class="form-control-wrap">
                                                                <input type="date" required name="date"
                                                                    class="form-control" id="exampleFormControlInputText1"
                                                                    placeholder="Add Amount">
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
                                                    Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
