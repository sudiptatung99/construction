@extends('pages.layout')
@section('title')
    Sale
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
                {{-- <form action="{{ route('return-items.create', encrypt($id)) }}" method="POST" enctype="multipart/form-data">
                    @csrf --}}
                <input type="hidden" name="_method" value="PUT">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-xl-8">
                            <h3>SALLING ITEMS</h3>
                            <div class="d-flex gap-3 mt-3">
                                <div class="form-group col-4">
                                    <label class="form-label">Client Name</label>
                                    <div class="form-control-wrap">
                                        <select class="js-select" data-search="true" name="client_id" data-sort="false">
                                            <option value="">Select</option>
                                            {{ getClient($sale->client_id) }}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="expen_date" style='justify-content:flex-end;gap: 5px;'>
                                <p>Date:</p>
                                <input type="date" class="form-control" id="start" name="date"
                                    value="{{ $sale->date }}" style='width: 151px;' />
                            </div>
                        </div>
                        <div class="col-xl-12 mt-2">
                            <div class="add_row_div">
                                <table class="_table">
                                    <thead>
                                        <tr>
                                            <th>Add</th>
                                            <th width="30%">Item</th>
                                            <th width="30%">QTY</th>
                                            <th>
                                                Rate
                                            </th>
                                            <th>
                                                Amount
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($saleItem) > 0)
                                            @php $no = 1; @endphp
                                            @foreach ($saleItem as $item)
                                                @php $i = $no++; @endphp
                                                <tr>
                                                    <td><button class="btn btn-info btn-sm"
                                                            onclick="returnData({{ $item->id }},{{ $item->qty }})">+</button>
                                                    </td>
                                                    <td>
                                                        <select class="form-select form-control iteminput" required
                                                            data-search="true" data-sort="false">
                                                            <option value="">Choose</option>
                                                            {{ getItems($item->item_id) }}
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="quantity_put">
                                                            <div class="input_div">
                                                                <input type="number" id="qtyn{{ $i }}" required
                                                                    value="{{ $item->qty }}"
                                                                    class="form-control form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" required
                                                                    value="{{ $item->item->unit->name }}"
                                                                    class="form-control form-control" readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" required value="{{ $item->price }}"
                                                            class="form-control"></td>
                                                    <td><input type="text" required value="{{ $item->amount }}" readonly
                                                            class="form-control"></td>
                                                    <td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
    <div class="row g-gs mt-4">
        <div class="col-xl-12 px-0">
            <div class="card">
                <form action="{{ route('return-items.create', encrypt($id)) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    {{-- <input type="hidden" name="_method" value="PUT"> --}}
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-xl-8">
                                <h3>Return Items</h3>
                                <div class="d-flex gap-3 mt-3">
                                    <div class="form-group col-4">
                                        <label class="form-label">Client Name</label>
                                        <div class="form-control-wrap">
                                            <select class="js-select" data-search="true" name="client_id" data-sort="false">
                                                <option value="">Select</option>
                                                {{ getClient($sale->client_id) }}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="expen_date" style='justify-content:flex-end;gap: 5px;'>
                                    <p>Date:</p>
                                    <input type="date" class="form-control" required id="start" name="date"
                                        style='width: 151px;' />
                                </div>
                            </div>
                            <div class="col-xl-12 mt-2">
                                <div class="add_row_div">
                                    <table class="_table" id="dynamicTable">
                                        <thead>
                                            <tr>
                                                <th width="30%">Item</th>
                                                <th width="30%">QTY</th>
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
                                            <tr>
                                                <td>
                                                    <select class="form-select form-control iteminput"
                                                        name="addmore[0][item_id]" required data-search="true"
                                                        data-sort="false" id="items0">
                                                        <option value="">Choose</option>
                                                        {{ getItems('') }}
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="quantity_put">
                                                        <div class="input_div">
                                                            <input type="text"
                                                                pattern="^(?:0|[1-9]\d*)(?:\.(?!.*000)\d+)?$" required
                                                                id="qty0" name="addmore[0][qty]"
                                                                class="form-control form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" required id="unit0"
                                                                class="form-control form-control" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><input type="text" required name="addmore[0][price]"
                                                        id="price0" class="form-control"></td>
                                                <td><input type="text" name="addmore[0][amount]" readonly
                                                        id="amount0" class="form-control"></td>
                                                <td>
                                                    <div class="action_container">
                                                        <a class=" btn btn-danger remove-tr" id="">
                                                            <em class="icon ni ni-trash-fill"></em>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div>
                                        <a id="add">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-sm-6 mt-2">
                            <div class="mr-3">
                                <div class="form-group">
                                    <label for="total" class="form-label">Total</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="total" id="total"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="save_btn mt-3">
                            <button type="submit" class="btn btn-primary">Return</button>
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
        let i = 0;
        var totalamount = [];
        $("#add").click(function() {
            ++i;
            let name = "{{ getItems('') }}";
            let client = " {{ getClient('') }}";

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
                '" class="form-control" /></td><td><input type="text" name="addmore[' +
                i + '][amount]" readonly id="amount' + i +
                '" class="form-control" /></td><td><a  data-row-id="' + i +
                '" class="btn btn-danger remove-tr"><em class="icon ni ni-trash-fill"></em></a></td></tr>');

        });
        $(document).on('click', '.remove-tr', function() {
            var row_id = $(this).data('rowId');
            $(this).parents('tr').remove();
            update_amount();
        });
        for (let j = 0; j <= 500; j++) {
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
            $(document).on('focusout', `#price${j}`, function() {
                var amount = $(this).val();
                var qty = $(`#qty${j}`).val();
                var total = amount * qty;
                $(`#amount${j}`).val(total);
                update_amount();
            })



        }

        var total_amount = 0;

        function update_amount() {
            var table = document.getElementById("dynamicTable");
            var sumVal = 0;
            for (var i = 1; i < table.rows.length; i++) {
                var amount = Number(parseFloat(table.rows[i].cells[3].getElementsByTagName("input")[0].value).toFixed(2))
                sumVal = Number(sumVal + amount);
            }
            document.getElementById("total").value = parseFloat(sumVal).toFixed(2);
            total_amount = sumVal;
        }
    </script>
    <script>
        $(document).on('change', `#paymentstatus`, function(e) {
            document.getElementById('ini_amount').style.display = 'none';
            document.getElementById('invalue').value = 0;
            var percent = e.target.value;
            if (percent == "Unpaid") {
                document.getElementById('ini_amount').style.display = 'block';
            }
        })
    </script>

    <script>
        var a = 0;
        // for (let j = 0; j <= 500; j++) {
        //     $(`#saleitem${j}`).click(function() {
        //         var value = document.getElementById(`saleitem${j}`).value;
        //         var qtyValue = document.getElementById(`qtyn${j}`).value;
        //         var table = document.getElementById("dynamicTable");

        //     })
        // }

        const arr = [];

        function returnData(id, qty) {

            if (arr.includes(id)) {
                alert('This Data Already Exist')
            } else {
                arr.push(id);
                $.ajax({
                    url: "/sale-items",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "data": id
                    },
                    success: function(data) {
                        if (a > 0) {
                            document.getElementById('add').click();
                        }
                        document.getElementById(`items${a}`).value = data.data.item_id
                        document.getElementById(`amount${a}`).value = data.data.amount
                        document.getElementById(`qty${a}`).value = data.data.qty
                        document.getElementById(`qty${a}`).max = qty;
                        document.getElementById(`unit${a}`).value = data.data.item.unit.name
                        document.getElementById(`price${a}`).value = data.data.price
                        update_amount()
                        a = a + 1
                    }
                })
            }


        }
    </script>
@endsection
