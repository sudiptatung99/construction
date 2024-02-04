@extends('pages.layout')
@section('title')
    Return Sale Item
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
                            <h4 style="font-size: 20px;">Return item List</h4>
                            <a href="{{ route('return-parties.create') }}" class="btn btn-primary">Create Return
                                Item Data </a>
                        </div>
                        <div class="col-xl-12 mt-4">
                            <table id="myexpense" width="100%" class="datatable-init table"
                                data-nk-container="table-responsive table-border">
                                <thead>
                                    <tr>
                                        <th><span class="overline-title">#</span></th>
                                        {{-- <th><span class="overline-title">Expenses No.</span></th> --}}
                                        <th><span class="overline-title">Parties Name</span></th>
                                        <th><span class="overline-title">Date</span></th>
                                        <th><span class="overline-title">Action</span></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($returnItem) > 0)
                                        @foreach ($returnItem as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->client->name }}</td>
                                                <td>{{ $item->date }}</td>
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
                                                                <a
                                                                    href="{{ route('return-parties.show', encrypt($item->id)) }}">View More</a>
                                                            </li>
                                                            <li>
                                                                <a type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModalreturn{{ $item->id }}">Delete</a>
                                                            </li>

                                                            <form
                                                                action="{{ route('return-parties.destroy', encrypt($item->id)) }}"
                                                                id="return{{ $item->id }}" method="POST">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
                                                            </form>
                                                        </ul>
                                                    </div>
                                                    <div class="modal fade" id="exampleModalreturn{{ $item->id }}"
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
                                                                    <p>Are You Sure You Want To Detele This Return Item
                                                                    </p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        Close
                                                                    </button>
                                                                    <button type="button" class="btn btn-sm btn-danger"
                                                                        onclick="event.preventDefault();
                                                                    document.getElementById('return{{ $item->id }}').submit();">
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
        </div>
    </div>
@endsection
