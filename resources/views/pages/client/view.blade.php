@extends('pages.layout')
@section('title')
    Parties
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
                            <h4 style="font-size: 20px;">Parties List</h4>
                            <a href="{{ route('client.create') }}" class="btn btn-primary">Create Party</a>
                        </div>
                        <div class="col-xl-12 mt-4">
                            <table id="myexpense" width="100%" class="datatable-init table"
                                data-nk-container="table-responsive table-border">
                                <thead>
                                    <tr>
                                        <th><span class="overline-title">#</span></th>
                                        <th><span class="overline-title">Name</span></th>
                                        <th><span class="overline-title">Email</span></th>
                                        <th><span class="overline-title">First Phone Number</span></th>
                                        <th><span class="overline-title">Second Phone Number</span></th>
                                        <th><span class="overline-title">Address</span></th>
                                        <th><span class="overline-title">Pin Code</span></th>
                                        <th><span class="overline-title">Action</span></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($client) > 0)
                                        @foreach ($client as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->first_number }}</td>
                                                <td>{{ $item->second_number }}</td>
                                                <td>{{ $item->address }}</td>
                                                <td>{{ $item->pin }}</td>
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
                                                                    href="{{ route('client.edit', encrypt($item->id)) }}">Edit</a>
                                                            </li>
                                                            <li>
                                                                {{-- <a onclick="event.preventDefault();
                                                            document.getElementById('logout{{$item->id}}').submit();" style="cursor: pointer">Delete</a> --}}
                                                                <a type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal{{ $item->id }}">Delete</a>
                                                            </li>

                                                            <form action="{{ route('client.destroy', encrypt($item->id)) }}"
                                                                id="client{{ $item->id }}" method="POST">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
                                                            </form>
                                                        </ul>
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
                                                                    <p>Are You Sure You Want To Detele This Client</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        Close
                                                                    </button>
                                                                    <button type="button" class="btn btn-sm btn-danger"
                                                                        onclick="event.preventDefault();
                                                                    document.getElementById('client{{ $item->id }}').submit();">
                                                                        Delete
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <p>Parties Not Found!</p>
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
