@extends('pages.layout')
@section('title')
Sale
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
                            <div class="col">Party Name</div>
                            <div class="col">{{$return->client->name}}</div>
                            <div class="w-100"></div>
                            <div class="col">Date</div>
                            <div class="col">{{$return->date}}</div>
                            <div class="w-100"></div>
                          </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">

                        <div class="col-xl-12 mt-4">
                            <table id="myexpense" width="100%" class="datatable-init table"
                                data-nk-container="table-responsive table-border">
                                <thead>
                                    <tr>
                                        <th><span class="overline-title">#</span></th>
                                        {{-- <th><span class="overline-title">Expenses No.</span></th> --}}
                                        <th><span class="overline-title">Item Name </span></th>
                                        <th><span class="overline-title">Quentity</span></th>
                                        <th><span class="overline-title">Price</span></th>
                                        <th><span class="overline-title">Total Amount</span></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($returnItem as  $key=>$item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->item->name }}</td>
                                            <td>{{ $item->qty }} {{ $item->item->unit->name }}</td>
                                            <td>{{env('CURRENCY')}}{{ number_format($item->price,2) }}</td>
                                            <td>{{env('CURRENCY')}}{{ number_format($item->amount,2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
