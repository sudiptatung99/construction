@extends('pages.layout')
@section('title')
Report || Day Book
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
                    <div class="col-xl-12 mt-4">
                        <table id="myexpense" width="100%" class="datatable-init table"
                            data-nk-container="table-responsive table-border">
                            <thead>
                                <tr>
                                    <th><span class="overline-title">#</span></th>
                                    <th><span class="overline-title">Expense</span></th>
                                    <th><span class="overline-title">Amount({{env('CURRENCY')}})</span></th>
                                    <th><span class="overline-title">Payment Mode</span></th>
                                    <th><span class="overline-title">Patment Status</span></th>
                                    <th><span class="overline-title">Date</span></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($expense as $key=>$item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ $item->expense }}</td>
                                    <td>{{env('CURRENCY')}}{{number_format($item->amount,2) }}</td>
                                    <td>{{ $item->pay_mode }}</td>
                                    <td>{{$item->pay_status}}</td>
                                    <td>{{ $item->date }}</td>
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