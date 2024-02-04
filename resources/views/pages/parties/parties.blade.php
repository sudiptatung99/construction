@extends('pages.layout')
@section('title')
    Parties
@endsection
@section('content')
    <style>
        .dataTable-top,
        .dataTable-bottom {
            flex-wrap: wrap;
            justify-content: space-between;
            row-gap: 10px;
        }

        #mytable thead tr th {
            border-right: 1px solid #e1dada !important;
            text-align: center;
        }

        #mytable tbody tr td {
            text-align: center;
        }

        #mytable-income thead tr th {
            border-right: 1px solid #e1dada !important;
            text-align: center;

        }

        #mytable-income tbody tr td {
            text-align: center;

        }
    </style>

    <div class="row g-gs">
        <div class="col-xl-4 ps-0 pe-2">
            <div class="col-xl-12 h-100 px-0">
                <div class="card h-100">
                    <div class="card-body client_data">
                        <div class="add_party">
                            <a href="{{ route('client.create') }}" type="button" class="btn btn-warning">
                                <em class="icon ni ni-plus"></em>
                                Add Party
                            </a>
                        </div>
                        <a href="{{ route('generate-pdf') }}" class="btn btn-primary btn-sm px-4 my-3">PDF</a>
                        <table id="client-data" class="datatable-init table"
                            data-nk-container="table-responsive table-border">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="overline-title">Parties</span>
                                    </th>
                                    <th style="border-right: none">
                                        <span class="overline-title">Due Amount</span>
                                    </th>
                                </tr>
                            </thead>
                            {{-- class="" --}}
                            <tbody>
                                @if (isset($client))
                                    @foreach ($client as $key => $client)
                                         @php
                                            $amount = 0;
                                            $reciveamountalldata = 0;
                                        @endphp
                                        <tr class="@if ($id == $client->id) active2 @endif">
                                            <td onclick="window.location='{{ url('parties/' . encrypt($client->id)) }}'">
                                                {{ $client->name }}</td>
                                            <td style="display: flex;justify-content: space-between;align-items: center;">
                                                @foreach ($client->sale as $item)
                                                    @php $amount=$amount+$item->total  @endphp
                                                @endforeach
                                                 @if (count($client->reciver) > 0)
                                                    @foreach ($client->reciver as $itemrecive)
                                                        @php $reciveamountalldata =$reciveamountalldata+$itemrecive->amount  @endphp
                                                    @endforeach
                                                @endif
                                               ₹{{ number_format($amount-$reciveamountalldata, 2) }}
                                                <a href="#" data-bs-toggle="dropdown">
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
                                                        <li><a
                                                                href="{{ route('client.edit', encrypt($client->id)) }}">Edit</a>
                                                        </li>
                                                        <li><a type="button" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal{{ $client->id }}">Delete</a>
                                                        </li>
                                                        <li><a
                                                                href="{{ route('client.show', encrypt($client->id)) }}">View</a>
                                                        </li>
                                                        <form action="{{ route('client.destroy', encrypt($client->id)) }}"
                                                            id="client{{ $client->id }}" method="POST">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                        </form>
                                                    </ul>
                                                </div>
                                                <div class="modal fade" id="exampleModal{{ $client->id }}" tabindex="-1"
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
                                                                <p>Are You Sure You Want To Detele This Client</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-sm btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-danger"
                                                                    onclick="event.preventDefault();
                                                                document.getElementById('client{{ $client->id }}').submit();">
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @php
            $totalreamount = 0;
            $reciveamount = 0;
            $dueamount = 0;
            $returnAmount=0;
        @endphp
        @if (isset($saledata))
            @foreach ($saledata as $sale)
                @php
                    $totalreamount = $totalreamount + $sale->total;
                @endphp
                @if (count($sale->return) > 0)
                    @foreach ($sale->return as $returnItem)
                     @php
                       $returnAmount = $returnAmount+$returnItem->total;
                    @endphp
                    @endforeach
                @endif
            @endforeach
        @endif
        @if (isset($recive))
            @foreach ($recive as $reciveData)
                @php
                    $reciveamount = $reciveamount + $reciveData->amount;
                @endphp
            @endforeach
        @endif
        @php
            $totalreamount = $totalreamount - $returnAmount;
            $dueamount = $totalreamount - $reciveamount;
        @endphp

        <div class="col-xl-8 px-0">
            <div class="row">
                <div class="col-xl-12 col-sm-12">
                    <div class="card mb-3">
                        @if (isset($oneClient))
                            <div class="card-body">
                                <div class="client_detail_div">
                                    <div class="client_detail_div_part">
                                        <h4 id="name">{{ $oneClient->name }}</h4>
                                        <p>Phone No.: <span id="phone"></span>{{ $oneClient->number }}</p>
                                        <p>Email: <span id="email">{{ $oneClient->email }}</span> </p>
                                        <p>Pin Code: <span id="email">{{ $oneClient->pin }}</span> </p>
                                        {{-- <p>No credit limit set</p> --}}
                                    </div>
                                    <div class="client_detail_div_part">
                                        <p>Payable Amount: <span id="phone"
                                                class="h6">{{ env('CURRENCY') }}{{ number_format($totalreamount, 2) }}</span>
                                        </p>
                                        <p>Receivable Amount: <span id="email"
                                                class="h6">{{ env('CURRENCY') }}{{ number_format($reciveamount, 2) }}</span>
                                        </p>
                                        <hr>
                                        <p>Due Amount: <span id="email"
                                                class="h6">{{ env('CURRENCY') }}{{ number_format($dueamount, 2) }}</span>
                                        </p>
                                        {{-- <p>No credit limit set</p> --}}
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
                                <h3>Sell Details:</h3>
                                <div class="all_btn">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                                        <button type="button" class="btn btn-outline-warning"
                                            id="download-button">Excel</button>
                                        <button type="button" class="btn btn-outline-danger" id="download-pdf">PDF</button>
                                    </div>
                                    @if (isset($client))
                                        <a href="{{ route('sale.creates', ['id' => encrypt($id)]) }}"
                                            class="btn btn-sm btn-danger">
                                            + Add More
                                        </a>
                                    @endif
                                </div>

                            </div>

                            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Add Sell </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xl-4 col-sm-12">

                                                    <div class="form-group">
                                                        <label for="datePicker1" class="form-label">Date</label>
                                                        <div class="form-control-wrap">
                                                            <input placeholder="dd/mm/yyyy" type="text"
                                                                class="form-control js-datepicker" data-title="Text"
                                                                data-today-btn="true" data-clear-btn="true"
                                                                autocomplete="off" id="datePicker1">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInputText1" class="form-label">Item
                                                            Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control"
                                                                id="exampleFormControlInputText1"
                                                                placeholder="Item Number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInputText1"
                                                            class="form-label">Quantity</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control"
                                                                id="exampleFormControlInputText1" placeholder="Quantity">
                                                        </div>
                                                    </div>
                                                </div>





                                                <div class="col-xl-4 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInputText1"
                                                            class="form-label">Price</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control"
                                                                id="exampleFormControlInputText1" placeholder="Price">
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
                                            <button type="button" class="btn btn-sm btn-primary">
                                                Save changes
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table id="my-table" width="100%" class="datatable-init table"
                                data-nk-container="table-responsive table-border">
                                <thead>
                                    <tr>
                                        <th>
                                            <span class="overline-title">Date</span>
                                        </th>
                                        <th>
                                            <span class="overline-title">Amount</span>
                                        </th>
                                        <th>
                                            <span class="overline-title">Pay Mode</span>
                                        </th>
                                        <th>
                                            <span class="overline-title">Pay Status</span>
                                        </th>
                                        <th>
                                            <span class="overline-title">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($saledata))
                                        @foreach ($saledata as $sale)
                                            <tr @if((Carbon\Carbon::parse($sale->date)->format('Y ')) < (\Carbon\Carbon::now()->format('Y'))) class='table-danger' @endif>
                                                <td>{{ Carbon\Carbon::parse($sale->date)->format('d-m-Y ') }}</td>
                                                <td>{{ env('CURRENCY') }}{{ number_format($sale->total, 2) }}</td>
                                                <td>
                                                    {{ $sale->payment_mode }}
                                                </td>
                                                <td>{{ $sale->payment_status }}</td>
                                                <td class="btn-group gap-1">
                                                    <a href="{{ route('sale.show', encrypt($sale->id)) }}"
                                                        class="btn btn-sm btn-warning"><em
                                                            class="icon ni ni-eye"></em></a>

                                                    <a href="{{ route('sale.edit', encrypt($sale->id)) }}"
                                                        class="btn btn-sm btn-primary"><em
                                                            class="icon ni ni-pen"></em></a>

                                                    <a data-bs-toggle="modal"data-bs-target="#exampleModaldelete{{ $sale->id }}"
                                                        class="btn btn-sm btn-danger"><em
                                                            class="icon ni ni-archive"></em></a>
                                                    <form action="{{ route('sale.destory', encrypt($sale->id)) }}"
                                                        id="purchase{{ $sale->id }}" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token"
                                                            value="{{ csrf_token() }}">
                                                    </form>

                                                    <a href="{{ route('return-items.create', encrypt($sale->id)) }}"
                                                        class="btn btn-sm btn-info" style="margin-left: -7px;"><em
                                                            class="icon ni ni-arrow-left-c"></em></a>
                                                </td>
                                            </tr>
                                            @if (count($sale->return) > 0)
                                                @foreach ($sale->return as $returnItem)
                                                    <tr>
                                                        <td>{{ Carbon\Carbon::parse($returnItem->date)->format('d-m-Y ') }}
                                                        </td>
                                                        <td>{{env('CURRENCY')}}{{ number_format($returnItem->total,2) }}</td>
                                                        <td></td>
                                                        <td>Return</td>
                                                        <td class="btn-group gap-1">
                                                            <a href="{{route('return-items',encrypt($returnItem->id))}}" class="btn btn-sm btn-warning"><em
                                                                    class="icon ni ni-eye"></em></a>
                                                            <a href="{{ route('return-items.edit', encrypt($returnItem->id)) }}"
                                                                class="btn btn-sm btn-primary"><em
                                                                    class="icon ni ni-pen"></em></em></a>
                                                            <a data-bs-toggle="modal"data-bs-target="#exampleModalreturn{{ $returnItem->id }}"
                                                                class="btn btn-sm btn-danger"><em
                                                                    class="icon ni ni-archive"></em></a>
                                                        </td>
                                                       
                                                    </tr>
                                                    <div class="modal fade" id="exampleModalreturn{{ $returnItem->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Warning!
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are You Sure You Want To Detele This Return Item</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        Close
                                                                    </button>
                                                                    <form action="{{ route('return-items.delete', encrypt($returnItem->id)) }}"
                                                                        id="returndata{{ $returnItem->id }}" method="POST">
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                        <input type="hidden" name="_token"
                                                                            value="{{ csrf_token() }}">
                                                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <div class="modal fade" id="exampleModaldelete{{ $sale->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                            <p>Are You Sure You Want To Detele This sell Data</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger"
                                                                onclick="event.preventDefault();
                                                                    document.getElementById('purchase{{ $sale->id }}').submit();">
                                                                Delete
                                                            </button>
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

                <div class="col-xl-12 col-sm-12">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="t_top">
                                <h3>Receivable Amount:</h3>

                                <div class="all_btn">
                                    @if (isset($client))
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal444">
                                            + Add More
                                        </button>
                                    @endif
                                </div>

                            </div>

                            <div class="modal fade" id="exampleModal444" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form
                                            action="{{ isset($oneClient->id) ? route('parties', encrypt($oneClient->id)) : '' }}"
                                            method="POST">
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
                                                            <label for="exampleFormControlInputText1"
                                                                class="form-label">Due Amount</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" readonly class="form-control"
                                                                    value="{{ number_format($dueamount, 2) }}"
                                                                    id="exampleFormControlInputText1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Payment Mode</label>
                                                            <div class="form-control-wrap">
                                                                <select class="js-select" required data-search="true" id="paymentmode"
                                                                    name="payment_mode" data-sort="false">
                                                                    <option value="">Choose</option>
                                                                    {{ getPaymentMode('') }}
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Payment Status</label>
                                                            <div class="form-control-wrap">
                                                                <select class="js-select" required data-search="true"
                                                                    name="payment_status" data-sort="false">
                                                                    <option value="">Choose</option>
                                                                    {{ getSellPayment('') }}
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-sm-12" id="bank_amount" style='display:none'>
                                                        <div class="form-group">
                                                            <label class="form-label">Bank Name</label>
                                                            <div class="form-control-wrap">
                                                                <select class="js-select" data-search="true"
                                                                    name="bank" data-sort="false">
                                                                    <option value="">Choose</option>
                                                                    {{ onGetBank('') }}
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlInputText1"
                                                                class="form-label">Add Amount</label>
                                                            <div class="form-control-wrap">
                                                                <input type="text" required name="ini_amount"
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
                                                                <input type="date" required name="date" class="form-control"
                                                                    id="exampleFormControlInputText1"
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



                            <table width="100%" id="mytable-income" class="datatable-init table"
                                data-nk-container="table-responsive table-border">
                                <thead>
                                    <tr>
                                        <th>
                                            <span class="overline-title">Date</span>
                                        </th>
                                        <th>
                                            <span class="overline-title">Pay Mode</span>
                                        </th>
                                        <th>
                                            <span class="overline-title">Payment Status</span>
                                        </th>
                                        <th>
                                            <span class="overline-title">Pay Amount</span>
                                        </th>
                                        <th>
                                            <span class="overline-title">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($recive))
                                        @foreach ($recive as $recive)
                                            <tr>
                                                <td>{{ isset($recive->date) ? Carbon\Carbon::parse($recive->date)->format('d-m-Y ') : '' }}
                                                </td>
                                                <td>{{ $recive->payment_mode }}</td>
                                                <td>{{ $recive->payment_status }}</td>
                                                <td>{{ env('CURRENCY') }}{{ number_format($recive->amount, 2) }}</td>
                                                <td>
                                                    <a href="{{ route('parties.edit-amount', encrypt($recive->id)) }}"
                                                        class="btn btn-sm btn-primary">Edit</a>

                                                    <a data-bs-toggle="modal"data-bs-target="#exampleModaldeleteamount{{ $recive->id }}"
                                                        class="btn btn-sm btn-danger">Delete</a>

                                                </td>
                                            </tr>
                                            <div class="modal fade" id="exampleModaldeleteamount{{ $recive->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                            <p>Are You Sure You Want To Detele This Recive Amount Data</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <form
                                                                action="{{ route('parties.delete-amount', encrypt($recive->id)) }}"
                                                                id="amount{{ $recive->id }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type='submit'
                                                                    class="btn btn-sm btn-danger">Delete</button>
                                                            </form>
                                                            <!--<button type="button" class="btn btn-sm btn-danger"-->
                                                            <!--    onclick="event.preventDefault();-->
                                                            <!--        document.getElementById('amount{{ $recive->id }}').submit();">-->
                                                            <!--    Delete-->
                                                            <!--</button>-->
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).on('click', '.client_data tbody tr', function(e) {
            $('tr.active2').removeClass('active2');
            $(this).addClass('active2');
        });
    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script> --}}


    <script>
        document.getElementById("download-pdf").addEventListener("click", function() {
            const table = document.getElementById("my-table");

            html2canvas(table).then(function(canvas) {
                const imgData = canvas.toDataURL("image/png");
                const pdf = new jsPDF();
                const imgWidth = 190;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                pdf.addImage(imgData, "PNG", 10, 10, imgWidth, imgHeight);
                pdf.save("SellDetails.pdf");
            });
        });
        document.getElementById("download-button").addEventListener("click", function() {
            var table = document.getElementById("my-table");
            var wb = XLSX.utils.table_to_book(table, {
                sheet: "Sheet1"
            });
            XLSX.writeFile(wb, "SellDetails.xlsx");
        });
    </script>

    <script>
        document
            .getElementById("export-xl-pdf")
            .addEventListener("click", function() {
                var pdf = new jsPDF();
                pdf.text(20, 20, "Income Details");
                pdf.autoTable({
                    html: "#mytable-income",
                    startY: 25,
                    theme: "grid",
                    columnStyles: {
                        0: {
                            cellWidth: 20
                        },
                        1: {
                            cellWidth: 60
                        },
                        2: {
                            cellWidth: 40
                        },
                        3: {
                            cellWidth: 60
                        },
                    },
                    bodyStyles: {
                        lineColor: [1, 1, 1]
                    },
                    styles: {
                        minCellHeight: 10
                    },
                });
                window.open(URL.createObjectURL(pdf.output("blob")));
            });
    </script>

    <script>
        document
            .getElementById("export-button-pdf")
            .addEventListener("click", function() {
                var pdf = new jsPDF();
                pdf.text(20, 20, "Income Details");
                pdf.autoTable({
                    html: "#mytable",
                    startY: 25,
                    theme: "grid",
                    columnStyles: {
                        0: {
                            cellWidth: 20
                        },
                        1: {
                            cellWidth: 60
                        },
                        2: {
                            cellWidth: 40
                        },
                        3: {
                            cellWidth: 60
                        },
                    },
                    bodyStyles: {
                        lineColor: [1, 1, 1]
                    },
                    styles: {
                        minCellHeight: 10
                    },
                });
                window.open(URL.createObjectURL(pdf.output("blob")));
            });
    </script>

    <script>
        $('body').bind('copy paste cut', function(e) {
            e.preventDefault();
        });
    </script>

    <script>
        var i = 1;
        $(document).on('click', `#client${i}`, function() {
            $.ajax({
                url: `/parties/${i}`,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    document.getElementById('name').innerHTML = response.client.name;
                    document.getElementById('phone').innerHTML = response.client.number;
                    document.getElementById('name').innerHTML = response.client.name;
                    document.getElementById('name').innerHTML = response.client.name;
                    console.log(response.client);
                }
            })
        })
    </script>
     <script>
        $(document).on('change', `#paymentmode`, function(e) {
            document.getElementById('bank_amount').style.display = 'none';
            var percent = e.target.value;
            if (percent == "Online") {
                document.getElementById('bank_amount').style.display = 'block';
            }
        })
    </script>
@endsection
