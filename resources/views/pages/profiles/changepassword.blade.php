@extends('pages.layout')
@section('content')

<div class="row g-gs">
    <div class="col-xl-9 col-sm-12">
        <div class="row">
            <x-app-layout>
                <div class="py-12">
                    <div class=" mx-auto ">
                        <div class="p-4 sm:p-8">
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>

                        {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div> --}}
                    </div>
                </div>
            </x-app-layout>
        </div>
    </div>
</div>
@endsection
