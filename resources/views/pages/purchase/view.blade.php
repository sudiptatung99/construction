@extends('pages.layout')
@section('title')
Purchase
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
                        <h4 style="font-size: 20px;">Purchase List</h4>
                        <a href="{{route('purchase.create')}}" class="btn btn-primary">New Purchase Data </a>
                    </div>
                    <div class="col-xl-12 mt-4">
                        <table id="myexpense" width="100%" class="datatable-init table"
                            data-nk-container="table-responsive table-border">
                            <thead>
                                <tr>
                                    <th><span class="overline-title">#</span></th>
                                    <th><span class="overline-title">Purchase No.</span></th>
                                    <th><span class="overline-title">Vendor Name</span></th>
									 <th><span class="overline-title">Date</span></th>
                                    <th><span class="overline-title">GST Amount</span></th>
                                    <th><span class="overline-title">GST</span></th>
                                     <th><span class="overline-title">Total Amount</span></th>
									 <th><span class="overline-title">Payment Amount</span></th>
									 <th><span class="overline-title">Due Amount</span></th>
                                    <th><span class="overline-title">Payment Mode</span></th>
                                    <th><span class="overline-title">Payment Status</span></th>
                                  
                                   
                                    <th><span class="overline-title">Image</span></th>
                                    <th><span class="overline-title">Action</span></th>
                                </tr>
                            </thead>

                              <tbody>
                                    @foreach ($purchase as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->expeseno }}</td>
                                            <td>{{ $item->vendor->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>
                                            <td>{{ env('CURRENCY') }}{{ number_format($item->gstamount, 2) }}</td>
                                            <td>{{ $item->gst }}%</td>
                                            <td>{{ env('CURRENCY') }}{{ number_format($item->total, 2) }}</td>
                                            @php
                                                $payment = 0;
                                            @endphp
                                            @if (count($item->recive) > 0)
                                                @foreach ($item->recive as $amountData)
                                                    @php
                                                        $payment = $payment + $amountData->total;
                                                    @endphp
                                                @endforeach
                                            @endif
                                            <td>{{ $item->payment_status == 'Paid' ?"": env('CURRENCY') }}{{ $item->payment_status == 'Paid' ? 'Paid' : number_format($payment,2) }}</td>
                                            <td>{{ $item->payment_status == 'Paid' ?"": env('CURRENCY') }}{{ $item->payment_status == 'Paid' ? 'Paid' : number_format(($item->total - $payment),2) }}
                                            </td>
                                            <td>{{ $item->payment_mode }}</td>
                                            <td @if($item->payment_status != 'Paid' ) data-bs-toggle="modal" data-bs-target="#examplepayment123{{ $item->id }}" @endif >
                                                {{ $item->payment_status }}</td>
                                            <td>
                                                @if ($item->image)
                                                    <img src="{{ asset('images/' . $item->image) }}" alt=""
                                                        width="30px" height="30px" alt="">
                                                @else
                                                    Null
                                                @endif
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
                                                            <a href="{{ route('payment', encrypt($item->id)) }}">Payment
                                                                Status</a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                href="{{ route('purchase.item.view', encrypt($item->id)) }}">View</a>
                                                        </li>
                                                        <li>
                                                            <a
                                                                href="{{ route('purchase.edit', encrypt($item->id)) }}">Edit</a>
                                                        </li>
                                                        <li>
                                                            <a type="button" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal{{ $item->id }}">Delete</a>
                                                        </li>

                                                        <form action="{{ route('purchase.destroy', encrypt($item->id)) }}"
                                                            id="purchase{{ $item->id }}" method="POST">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                        </form>
                                                    </ul>
                                                </div>
                                                <div class="modal fade" id="examplepayment123{{ $item->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <form
                                                                action="{{ route('payment.create', encrypt($item->id)) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Add Payment</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-xl-4 col-sm-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label">Payment
                                                                                    Mode</label>
                                                                                <div class="form-control-wrap">
                                                                                    <select class="form-control"
                                                                                        data-search="true"
                                                                                        name="payment_mode" required
                                                                                        data-sort="false">
                                                                                        <option value="">Choose
                                                                                        </option>
                                                                                        <option value='Cash'>Cash</option>
                                                                                        <option value='Online'>Online
                                                                                        </option>
                                                                                        <option value='Upi'>Upi</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-4 col-sm-12">
                                                                            <div class="form-group">
                                                                                <label for="exampleFormControlInputText1"
                                                                                    class="form-label">Add
                                                                                    Amount</label>
                                                                                <div class="form-control-wrap">
                                                                                    <input type="text" required
                                                                                        name="total" class="form-control"
                                                                                        id="exampleFormControlInputText1"
                                                                                        placeholder="Add Amount">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-4 col-sm-12">
                                                                            <div class="form-group">
                                                                                <label for="exampleFormControlInputText1"
                                                                                    class="form-label">Date</label>
                                                                                <div class="form-control-wrap">
                                                                                    <input type="date" required
                                                                                        name="date"
                                                                                        class="form-control"
                                                                                        id="exampleFormControlInputText1"
                                                                                        placeholder="Add Amount">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-sm btn-secondary"
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
                                                <div class="modal fade" id="exampleModal{{ $item->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
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
                                                                <p>Are You Sure You Want To Detele This Purchase Data</p>
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


{{-- <div class="row g-gs">
    <div class="col-xl-12 px-0">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-xl-3">
                        <h3>ADD PURCHASE</h3>

                        <div class="form-group">
                            <label class="form-label">Expenses Category</label>
                            <div class="form-control-wrap">
                                <select class="js-select" data-search="true" data-sort="false">
                                    <option value="">Choose</option>
                                    <option value="1">PayPal</option>
                                    <option value="2">Bank Transfer</option>
                                    <option value="3">Skrill</option>
                                    <option value="4">Moneygram</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-4">
                        <div class="expen_no">
                            <p>Expenses No.</p>
                            <input type="text" class="form-control" id="exampleFormControlInputText1"
                                placeholder="Input text placeholder">
                        </div>
                        <div class="expen_date">
                            <p>Date:</p>
                            <input placeholder="dd/mm/yyyy" type="text" class="form-control js-datepicker"
                                data-title="Text" data-today-btn="true" data-today-btn-mode="1" data-clear-btn="true"
                                autocomplete="off" id="datePicker1">

                        </div>
                    </div>

                    <div class="col-xl-12 mt-4">
                        <div class="add_row_div">
                            <table class="_table">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>ITEM</th>
                                        <th>QTY</th>
                                        <th>Price/Unit(₹)</th>
                                        <th>
                                            Amount
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="">
                                        </td>
                                        <td>

                                            <div class="quantity_put">
                                                <div class="input_div">
                                                    <input type="number" class="form-control form-control-sm">
                                                </div>


                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select class="form-select form-select-sm"
                                                            id="exampleFormControlInputText5"
                                                            aria-label="Default select example">
                                                            <option selected>Unit</option>
                                                            <option>Piece</option>
                                                            <option>kg</option>
                                                            <option>Three</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="text" class="form-control"></td>

                                        <td>
                                            <div class="action_container">
                                                <button class=" btn btn-danger btn-sm" onclick="remove_tr(this)">
                                                    <em class="icon ni ni-trash-fill"></em>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- <tr>
                    <td>
                        <div class="action_container">
                        <button class="success" onclick="create_tr('table_body')">
                            <i class="fa fa-plus"></i>
                        </button>
                        </div>
                    </td>
                    </tr> -->
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td> </td>
                                        <td style="border-right: none;">Total</td>
                                        <td>0</td>
                                        <td></td>
                                        <td>0</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="action_container mt-3">
                                <button class=" btn btn-info btn-sm" onclick="create_tr('table_body')">
                                    <em class="icon ni ni-plus-circle-fill me-1"></em>
                                    Add Row
                                </button>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="pay_detail_docu">
                    <div class="col-xl-3 col-sm-6">
                        <div class="form-group">
                            <label for="exampleFormSelect1" class="form-label">Payment Type</label>
                            <div class="form-control-wrap">
                                <select class="form-select" id="exampleFormSelect1" aria-label="Default select example">
                                    <option selected>Cash</option>
                                    <option>Online</option>
                                    <option>UPI</option>
                                </select>
                            </div>
                        </div>

                        <div class="add_descp">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <textarea placeholder="Add Description" class="form-control"
                                        id="exampleFormControlTextarea8" rows="1"></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="form-group mt-3">
                            <label for="formFile" class="form-label">Add Image</label>
                            <div class="form-control-wrap">
                                <input class="form-control form-control-sm" type="file" id="formFile">
                            </div>
                        </div>


                    </div>

                    <div class="col-xl-4 col-sm-6">
                        <div class="pay_total">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Round off
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInputText1" class="form-label">Total</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="exampleFormControlInputText1">
                                </div>
                            </div>
                        </div>


                    </div>


                </div>


                <div class="save_btn mt-3">
                    <button class="btn btn-primary">Save</button>
                </div>


            </div>
        </div>
    </div>


</div> --}}

@endsection