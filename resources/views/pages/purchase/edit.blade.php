@extends('pages.layout')
@section('title')
Purchase
@endsection
@section('content')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

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
        }

        .action_container .btn {
            font-size: 15px;
        }
    </style>

    <div class="row g-gs">
        <div class="col-xl-12 px-0">
            <div class="card">
                <form action="{{ route('purchase.update', encrypt($purchase->id)) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-xl-8">
                                <h3>UPDATE PURCHASE</h3> 
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="form-label">Payment Mode</label>
                                            <div class="form-control-wrap">
                                                <select class="js-select" data-search="true" name="payment_mode" data-sort="false">
                                                    <option value="">Choose</option>
                                                    {{ getPaymentMode($purchase->payment_mode) }}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"> 
                                            <label for="exampleFormSelect1" class="form-label">Payment Status</label>
                                            <div class="form-control-wrap">
                                                <select class="js-select" id="exampleFormSelect1" name="payment_status"
                                                    aria-label="Default select example">
                                                    <option value="">Choose</option>
                                                    {{ getPaymentStatus($purchase->payment_status) }}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"> 
                                            <label for="exampleFormSelect1" class="form-label">Vendor Name</label>
                                            <div class="form-control-wrap">
                                                <select class="js-select" id="exampleFormSelect1" name="vendor_id"
                                                    aria-label="Default select example">
                                                    <option value="">Choose</option>
                                                    {{ getVendor($purchase->vendor_id) }}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-xl-4">
                                <div class="expen_date" style='justify-content:flex-end;gap: 5px;'>
                                    <p>Date:</p>
                                    <input type="date" class="form-control" id="start" name="date" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d',$purchase->date)->format('Y-m-d')  }}" />
                                </div>
                            </div>
                            <div class="col-xl-12 mt-4">
                                <div class="add_row_div">
                                    <table class="_table" id="dynamicTable">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>QTY</th>
                                                <th>
                                                    Rate
                                                </th>
                                                <th>
                                                    Amount
                                                </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_body">
                                            @php $no = 1; @endphp
                                            @foreach ($purchaseitem as $item)
                                                @php $i = $no++; @endphp
                                                <tr>
                                                    <td>
                                                        <select class="form-select form-control iteminput"
                                                            name="addmore[{{ $i }}][item_id]" data-search="true"
                                                            data-sort="false" id="items{{ $i }}">
                                                            <option value="">Choose</option>
                                                            {{ getItems($item->item_id) }}
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="quantity_put">
                                                            <div class="input_div">
                                                                <input type="text" value="{{ $item->qty }}"
                                                                    id="qty{{ $i }}"
                                                                    name="addmore[{{ $i }}][qty]"
                                                                    class="form-control form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" id="unit{{ $i }}"
                                                                    value="{{ $item->item->unit->name }}"
                                                                    class="form-control form-control" readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="addmore[{{ $i }}][price]"
                                                            value="{{ $item->price }}" id="price{{ $i }}"
                                                            class="form-control" readonly ></td>
                                                    <td><input type="text" name="addmore[{{ $i }}][amount]"
                                                            value="{{ $item->amount }}" 
                                                            id="amount{{ $i }}" class="form-control"></td>
                                                    <td>
                                                        <div class="action_container">
                                                            <a class=" btn btn-danger remove-tr" id="">
                                                                <em class="icon ni ni-trash-fill"></em>
                                                            </a>
                                                        </div>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="action_container mt-3">
                                        <a class=" btn btn-info btn-sm" id="add">
                                            <em class="icon ni ni-plus-circle-fill me-1"></em>
                                            Add Row
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pay_detail_docu">
                            <div class="col-xl-6 col-sm-6"> 
                                
                                <div class="add_descp">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <textarea placeholder="Add Description" name="details" class="form-control" id="exampleFormControlTextarea8"
                                                rows="4">{{ $purchase->details }}</textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group mt-3">
                                    <label for="formFile" class="form-label">Add Image</label>
                                    <div class="form-control-wrap">
                                        <input class="form-control" type="file" id="formFile"
                                            name="image" accept="image/png, image/gif, image/jpeg">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-sm-6">
                                <div class="mr-3">
                                    <div class="form-group">
                                        <label for="total" class="form-label">Sub Total</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control"  value="{{ $purchase->subtotal }}" name="subtotal" id="subtotal" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="form-group">
                                        <label for="total" class="form-label">GST</label>
                                        <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control col-3" name="gst"
                                                value="{{ $purchase->gst }}" id="gst">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control col-3" name="gstamount"
                                                value="{{ $purchase->gstamount }}" id="gstamount"
                                                readonly>
                                        </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <div class="form-group">
                                        <label for="total" class="form-label">Total</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" value="{{ $purchase->total }}"
                                                name="total" id="total" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="save_btn mt-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <form id="form-data">
        @csrf
        <input type="hidden" name="item" id="itemdata">
    </form>

    <script type="text/javascript">
        let i = {{ count($purchaseitem) }};
        var totalamount = [];
        $("#add").click(function() {
            ++i;
            let name = "{{ getItems('') }}"
            $("#dynamicTable").append('<tr><td>' +
                '<select class="form-select form-control iteminput" name="addmore[' + i +
                '][item_id]"data-search="true" data-sort="false" id="items' + i +
                '"><option value="">Choose</option>' + name +
                '</select></td><td><div class="quantity_put"><div class="input_div"><input type="number" id="qty' +
                i + '" name="addmore[' + i +
                '][qty]"class="form-control form-control"></div><div class="form-group"><input type="text" id="unit' +
                i + '" name="addmore[' + i +
                '][unit]"class="form-control form-control" readonly></div></div></td><td><input type="text" name="addmore[' +
                i + '][price]" id="price' + i +
                '" class="form-control" readonly/></td><td><input type="text" name="addmore[' +
                i + '][amount]"  id="amount' + i +
                '" class="form-control" /></td><td><a  data-row-id="' + i +
                '" class="btn btn-danger remove-tr"><em class="icon ni ni-trash-fill"></em></a></td></tr>');

        });
        $(document).on('click', '.remove-tr', function() {
            var row_id = $(this).data('rowId');
            $(this).parents('tr').remove();
            update_amount();
        });
        for (let j = 1; j <= 500; j++) {
            $(document).on('change', `#items${j}`, function() {
                var data = $(this).val();
                $('#itemdata').val(data);
                var value = $('#form-data').serialize();
                $.ajax({
                    type: 'post',
                    url: "{{ route('purchase.item.unit') }}",
                    data: value,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {},
                    complete: function(response) {
                        $(`#unit${j}`).val(response.responseJSON.item.name);
                    }
                });
            })
            $(document).on('focusout', `#amount${j}`, function() {
                var amount = $(this).val();
                var qty = $(`#qty${j}`).val();
                var total = amount / qty;
                $(`#price${j}`).val(parseFloat(total).toFixed(2));
                update_amount();
                var percent = e.target.value;
                var amount = total_amount;
                var gst = amount * percent / 100;
                document.getElementById("gstamount").value = gst;
                document.getElementById("total").value = amount + gst;
            })



        }
        var total_amount = 0;

        function update_amount() {
            var table = document.getElementById("dynamicTable");
            var sumVal = 0;
            for (var i = 1; i < table.rows.length; i++) {
                sumVal = sumVal + Number(parseInt(table.rows[i].cells[3].getElementsByTagName("input")[0].value).toFixed(2));
            }
            document.getElementById("total").value = sumVal;
            document.getElementById("subtotal").value = sumVal;
            total_amount = sumVal;
            var percent = document.getElementById("gst").value;
            var amount = total_amount;
            var gst = amount * percent / 100;
            document.getElementById("gstamount").value = parseFloat(gst).toFixed(2);
            document.getElementById("total").value = parseFloat(amount + gst).toFixed(2);
        }

        $(document).on('focusout', `#gst`, function(e) {
            var percent = e.target.value;
            var amount = total_amount;
            var gst = amount * percent / 100;
            document.getElementById("gstamount").value = parseFloat(gst).toFixed(2);
            document.getElementById("total").value = parseFloat(amount + gst).toFixed(2);
        })
    </script>
@endsection
