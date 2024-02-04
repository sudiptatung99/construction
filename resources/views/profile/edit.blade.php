@extends('pages.layout')
@section('title') Profile @endsection 
@section('content') 
    <div class="row g-gs">
        <div class="col-xl-12 px-0"> 
            <div class="card mb-3">
                <div class="card-body">
                    <div class="container">
                        @include('profile.partials.update-profile-information-form') 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

