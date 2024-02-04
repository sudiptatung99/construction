@extends('pages.layout')
@section('title')
Expense
@endsection
@section('content')
<div class="row g-gs">
    <div class="col-xl-12 px-0">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row justify-content-between">

                    <div class="d-flex" style="justify-content: space-between">
                        <h4 style="margin-bottom: 15px; font-size: 20px;">Add New Expense </h4>
                        <a href="{{route('expense')}}" class="btn btn-primary">Expense List</a>
                    </div>

                    <div class="col-9 m-auto">
                        <form action="{{route('expense.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label for="exampleFormControlInputText1" class="mb-1">Item</label>
                                        <input type="text" name="expense" class="form-control"
                                            id="exampleFormControlInputText1" placeholder="Enter Item">
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('expense')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
							<div class="col-12 mt-2">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label for="exampleFormControlInputText1" class="mb-1">Pay to Whom</label>
                                        <input type="text" name="pay_whome" class="form-control"
                                            id="exampleFormControlInputText1" placeholder="Pay to Whom">
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('pay_whome')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label for="exampleFormControlInputText1" class="mb-1">Expense Amount({{env('CURRENCY')}}) </label>
                                        <input type="number" name="amount" class="form-control"
                                            id="exampleFormControlInputText1" placeholder="Enter Expense Amount">
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('amount')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label for="exampleFormControlInputText1" class="mb-1">Payment Mode </label>
                                        <select class="form-select" id="exampleFormSelect1"
                                            aria-label="Default select example" name="pay_mode">
                                            <option value="" selected disabled>--Select Payment Mode--</option>
                                            {{getPaymentMode('')}}
                                        </select>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('pay_mode')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <label for="exampleFormControlInputText1" class="mb-1">Payment Status
                                            </label>
                                            <select class="form-select" id="exampleFormSelect1"
                                                aria-label="Default select example" name="pay_status">
                                                <option selected disabled>--Select Payment Status--</option>
                                                {{getPaymentStatus('')}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('pay_status')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label for="exampleFormControlInputText1" class="mb-1">Expense Details </label>
                                        <textarea type="text" name="details" class="form-control"
                                            id="exampleFormControlInputText1"
                                            placeholder="Enter Expense Details"></textarea>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('details')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label for="exampleFormControlInputText1" class="mb-1"> Date</label>
                                        <input type="date" name="date" class="form-control"
                                            id="exampleFormControlInputText1" placeholder="Enter Expense Date">
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('pin')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-control-wrap">
                                    <label for="exampleFormControlInputText1" class="mb-1">Expense Image</label>
                                    <input type="file" class="form-control " name="image"
                                        accept="image/png, image/gif, image/jpeg">
                                </div>
                                <span class="text-danger">
                                    @error('image')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="save_btn">
                                <button class="btn btn-primary mt-4" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection