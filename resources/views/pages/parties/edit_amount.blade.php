@extends('pages.layout')
@section('title')
Edit Amount
@endsection
@section('content')
 <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<div class="row g-gs">
    <div class="col-xl-12 px-0">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row justify-content-between">

                    <div class="d-flex" style="justify-content: space-between">
                        <h4 style="margin-bottom: 15px; font-size: 20px;">Recive Amount Update</h4>
                    </div>
                    <div class="col-xl-9 m-auto ">
                        <form action="{{ route('parties.update-amount', encrypt($reciveamount->id))}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">

                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label for="exampleFormControlInputText1" class="mb-1">Recive Amount</label>
                                        <input type="text" name="ini_amount" value="{{$reciveamount->amount}}"
                                            class="form-control" id="exampleFormControlInputText1"
                                            placeholder="Enter Recive Amount">
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('ini_amount')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label for="exampleFormControlInputText1" class="mb-1">Payment Mode </label>
                                        <select class="form-select"  id="paymentmode"
                                            aria-label="Default select example" name="payment_mode">
                                            <option selected hidden>--Select Payment Mode--</option>
                                            {{getPaymentMode($reciveamount->payment_mode)}}
                                        </select>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('payment_mode')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-12 mt-2" id="ini_amount" style="display:none">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label for="exampleFormControlInputText1" class="mb-1">Bank Name </label>
                                        <select class="form-select" id="exampleFormSelect1"
                                            aria-label="Default select example" name="bank_id">
                                            <option selected disabled>--Select Bank--</option>
                                            {{onGetBank(isset($reciveamount->bank_id)?$reciveamount->bank_id:"")}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2" >
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label for="exampleFormControlInputText1" class="mb-1">Payment Status </label>
                                        <select class="form-select" id="exampleFormSelect1"
                                            aria-label="Default select example" name="payment_status">
                                            <option selected hidden>--Select Payment Mode--</option>
                                            {{getSellPayment($reciveamount->payment_status)}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label for="exampleFormControlInputText1" class="mb-1">Date</label>
                                        <input type="date" name="date" value="{{isset($reciveamount->date)?date('Y-m-d',strtotime($reciveamount->date)):"" }}"
                                            class="form-control" id="exampleFormControlInputText1"
                                            placeholder="Enter date">
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('date') 
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            
                            <div class="save_btn">
                                <button class="btn btn-primary mt-4" type="submit">Update Recive Amount</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <script>
    let pay_mode ='{{$reciveamount->payment_mode}}';
        $(document).on('change', `#paymentmode`, function(e) {
            document.getElementById('ini_amount').style.display = 'none';
            var percent = e.target.value;
            console.log(percent);
            if (percent == "Online") {
                document.getElementById('ini_amount').style.display = 'block';
            }
        })
       if(pay_mode=="Online"){
            document.getElementById('ini_amount').style.display = 'block';
        }
    </script>

@endsection