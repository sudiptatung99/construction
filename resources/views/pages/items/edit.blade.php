@extends('pages.layout')
@section('title')
    Items
@endsection
@section('content')
    <div class="row g-gs">
        <div class="col-xl-12 px-0">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row justify-content-between">

                        <div class="d-flex" style="justify-content: space-between">
                            <h4 style="margin-bottom: 15px; font-size: 20px;">Items Update</h4>
                            <a href="{{route('items.index')}}" class="btn btn-primary">Item List</a>
                        </div>

                        <div class="col-xl-9 m-auto">
                            <form action="{{ route('items.update',$itemData->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="item_detail">
                                    <div class="col-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <label for="exampleFormControlInputText1" class="mb-1">Item Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    id="exampleFormControlInputText1" placeholder="Item Name" value="{{$itemData->name}}">
                                            </div>
                                        </div>
                                        <span class="text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <label for="exampleFormControlInputText1" class="mb-1">Item Measure Unit</label>
                                                <select class="form-select" id="exampleFormSelect1"
                                                    aria-label="Default select example" name="unit_id">
                                                    {{onGetUnit($itemData->unit_id)}}
                                                </select>
                                            </div>
                                        </div>
                                        <span class="text-danger">
                                            @error('unit')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="item_detail">
                                    <div class="col-7">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <label for="exampleFormControlInputText1" class="mb-1">Item Category</label>
                                                <select class="form-select" id="exampleFormSelect1"
                                                    aria-label="Default select example" name="category_id">
                                                    {{onGetCategory($itemData->category_id)}}
                                                </select>
                                            </div>
                                        </div>
                                        <span class="text-danger">
                                            @error('category')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-control-wrap">
                                            <label for="exampleFormControlInputText1" class="mb-1">Item Image</label>
                                            <input class="form-control form-control-sm" name="image" id="formFileRg"
                                                type="file">
                                        </div>
                                        <span class="text-danger">
                                            @error('image')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="save_btn">
                                    <button class="btn btn-primary mt-4" type="submit">Update Item</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function create_tr(table_id) {
            let table_body = document.getElementById(table_id),
                first_tr = table_body.firstElementChild
            tr_clone = first_tr.cloneNode(true);

            table_body.append(tr_clone);

            clean_first_tr(table_body.firstElementChild);
        }

        function clean_first_tr(firstTr) {
            let children = firstTr.children;

            children = Array.isArray(children) ? children : Object.values(children);
            children.forEach(x => {
                if (x !== firstTr.lastElementChild) {
                    x.firstElementChild.value = '';
                }
            });
        }

        function remove_tr(This) {
            if (This.closest('tbody').childElementCount == 1) {
                alert("You Don't have Permission to Delete This ?");
            } else {
                This.closest('tr').remove();
            }
        }
    </script>


@endsection
