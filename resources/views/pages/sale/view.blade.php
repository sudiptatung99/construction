@extends('pages.layout')
@section('title')
    Sale
@endsection
@section('content')
    <style>
        #exampleModal2 .form-label {
            margin-right: 5px;
            width: 75px;
        }
    </style>

    <div class="row g-gs">
        <div class="col-xl-12 px-0">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <div class="d-flex" style="justify-content: space-between;">
                            <h4 style="font-size: 20px;">sale List</h4>
                            <a href="{{ route('sale.create') }}" class="btn btn-primary">Create New
                                Sale Data </a>
                        </div>
                        <div class="col-xl-12 mt-4">
                            <table id="myexpense" width="100%" class="datatable-init table"
                                data-nk-container="table-responsive table-border">
                                <thead>
                                    <tr>
                                        <th><span class="overline-title">#</span></th>
                                        {{-- <th><span class="overline-title">Expenses No.</span></th> --}}
                                        <th><span class="overline-title">Client Name</span></th>
                                        <th><span class="overline-title">GST Amount</span></th>
                                        <th><span class="overline-title">GST</span></th>
                                        <th><span class="overline-title">Payment Mode</span></th>
                                        <th><span class="overline-title">Payment Status</span></th>
                                        <th><span class="overline-title">Total Amount</span></th>
                                        <th><span class="overline-title">Date</span></th>
                                        <th><span class="overline-title">Action</span></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($sale as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                             <td>{{ $item->client->name }}</td>
                                            <td>{{ env('CURRENCY') }}{{ number_format($item->gstamount, 2) }}</td>
                                            <td>{{ $item->gst }}%</td>
                                            <td>{{ $item->payment_mode }}</td>
                                            <td>{{ $item->payment_status }}</td>
                                            <td>{{ env('CURRENCY') }}{{ number_format($item->total, 2) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false"
                                                    class="">
                                                    <div class="d-none d-sm-block">
                                                        <div class="three_dot">
                                                            <ul>
                                                                <li></li>
                                                                <li></li>
                                                                <li></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="dropdown-menu drop_option">
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('sale.show', encrypt($item->id)) }}">View</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('sale.edit', encrypt($item->id)) }}">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a type="button" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal{{ $item->id }}">Delete</a>
                                                        </li>

                                                        <form action="{{ route('sale.destory', encrypt($item->id)) }}"
                                                            id="purchase{{ $item->id }}" method="POST">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                        </form>
                                                    </ul>
                                                </div>
                                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Warning!
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are You Sure You Want To Detele This Sale Data</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-sm btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-danger"
                                                                    onclick="event.preventDefault();
                                                                    document.getElementById('purchase{{ $item->id }}').submit();">
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
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
