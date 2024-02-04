@extends('pages.layout')
@section('title')
Party
@endsection
@section('content')

    <div class="row g-gs">
        <div class="col-xl-12 px-0">

            <div class="card mb-3">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">Name</div>
                            <div class="col">{{ $clientData->name }}</div>
                            <div class="w-100"></div>
                            <div class="col">Email</div>
                            <div class="col">{{ $clientData->email }}</div>
                            <div class="w-100"></div>
                            <div class="col">First Phone Number</div>
                            <div class="col">{{ $clientData->first_number }}</div>
                            <div class="w-100"></div>
                            <div class="col">Second Phone Number</div>
                            <div class="col">{{ $clientData->second_number }}</div>
                            <div class="w-100"></div>
                            <div class="col">Pin Code</div>
                            <div class="col">{{ $clientData->pin }}</div>
                            <div class="w-100"></div>
                            <div class="col">Address</div>
                            <div class="col">{{ $clientData->address }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
