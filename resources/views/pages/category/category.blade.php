@extends('pages.layout')
@section('title')
Category
@endsection
@section('content')
<div class="row g-gs">
    <div class="col-xl-12 px-0">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row justify-content-between">

                    <div class="d-flex" style="justify-content: space-between">
                        <h4 style="margin-bottom: 15px; font-size: 20px;">Add Category </h4>
                        <a href="{{route('category.index')}}" class="btn btn-primary">Category List</a>
                    </div>

                    <div class="col-9 m-auto">
                        <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <label for="exampleFormControlInputText1" class="mb-1">Category Name</label>
                                        <input type="text" name="name" class="form-control"
                                            id="exampleFormControlInputText1" placeholder="Enter Category Name">
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('name')
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


        {{-- <div class="card price_tab">
            <div class="card-body">
                <ul class="nav nav-tabs mb-3 nav-tabs-s1">
                    <li class="nav-item">
                        <button class="nav-link active" style="font-weight: 600;" data-bs-toggle="tab"
                            data-bs-target="#custom-home-tab-pane" type="button">Pricing</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#custom-profile-tab-pane"
                            type="button">Stock</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="custom-home-tab-pane">

                        <div class="total_pricediv">
                            <div class="pricediv">

                                <div class="sale_div">
                                    <h3 style="color: #000; font-size: 17px; font-weight: 600;">Sale Price</h3>

                                    <div class="item_price" id="saleprice">


                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    id="exampleFormControlInputText1" placeholder="Sale Price">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <select class="form-select" id="exampleFormControlInputText5"
                                                    aria-label="Default select example">
                                                    <option selected>Without tax</option>
                                                    <option>With Tax</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <button class="btn add_wholesale" id="button_sale">+ Add sale
                                    Price</button>

                            </div>

                            <div class="pricediv">
                                <div class="wholesale_price mt-2">
                                    <h3 style="color: #000; font-size: 17px; font-weight: 600; margin-left: 22px;">
                                        Wholesale Price</h3>

                                    <div class="wholesale_price_div" id="wholesale">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control"
                                                    id="exampleFormControlInputText1" placeholder="wholesale price">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <select class="form-select" id="exampleFormControlInputText5"
                                                    aria-label="Default select example">
                                                    <option selected>Without tax</option>
                                                    <option>With Tax</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn add_wholesale" id="button_wholesale">+ Add
                                    Wholesale
                                    Price</button>
                            </div>
                        </div>

                        <div class="total_pricediv">
                            <div class="pricediv">
                                <h4 style="font-size: 15px; color: #000; font-weight: 700;">Purchase Price</h4>

                                <div class="item_price">


                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="exampleFormControlInputText1"
                                                placeholder="Purchase Price">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <select class="form-select" id="exampleFormControlInputText5"
                                                aria-label="Default select example">
                                                <option selected="">Without tax</option>
                                                <option>With Tax</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="pricediv">
                                <h4 style="font-size: 15px; color: #000; font-weight: 700;">Taxes</h4>

                                <div class="form-group tax_rate mt-3">
                                    <label for="exampleFormControlInputText5" class="form-label">Tax rate</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select" id="exampleFormControlInputText5"
                                            aria-label="Default select example">
                                            <option selected>None</option>
                                            <option value="1">One</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="save_btn">
                            <button class="btn btn-primary mt-4">Save</button>

                        </div>


                    </div>

                    <div class="tab-pane fade" id="custom-profile-tab-pane">
                        <div class="col-xl-7">
                            <div class="row">
                                <div class="col-xl-4 .col-sm-12">
                                    <input type="text" class="form-control" placeholder="Opening Quantity">

                                </div>

                                <div class="col-xl-4 .col-sm-12">
                                    <input type="text" class="form-control" placeholder="All Price">

                                </div>


                                <div class="col-xl-4 .col-sm-12 mb-3">

                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input placeholder="dd/mm/yyyy" type="text"
                                                class="form-control js-datepicker" data-title="Date"
                                                data-today-btn="true" data-clear-btn="true" autocomplete="off"
                                                id="datePicker1">
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xl-4 .col-sm-12">

                                    <input type="text" class="form-control" placeholder="Min Stock to Maintain">

                                </div>

                                <div class="col-xl-4 .col-sm-12">

                                    <input type="text" class="form-control" placeholder="Location">

                                </div>

                                <div class="col-xl-12 px-0">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row justify-content-between">

                                                <div class="col-xl-12">
                                                    <h4 style="margin-bottom: 15px; font-size: 20px;">ITEMS:</h4>
                                                </div>

                                                <div class="col-xl-6 col-sm-12">
                                                    <div class="item_detail">

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control"
                                                                        id="exampleFormControlInputText1"
                                                                        placeholder="Item Name">
                                                                </div>
                                                            </div>

                                                        </div>


                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <select class="form-select" id="exampleFormSelect1"
                                                                        aria-label="Default select example">
                                                                        <option selected>Select Unit</option>
                                                                        <option value="1">Kg</option>
                                                                        <option value="2">Piece</option>
                                                                        <option value="3">Litr</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="item_detail">

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <select class="form-select" id="exampleFormSelect1"
                                                                        aria-label="Default select example">
                                                                        <option selected>Categoy</option>
                                                                        <option value="1">Bricks</option>
                                                                        <option value="2">Sand</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>




                                                        <div class="col-6">
                                                            <div class="form-control-wrap">
                                                                <input class="form-control form-control-sm"
                                                                    id="formFileRg" type="file">
                                                            </div>
                                                        </div>


                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card price_tab">
                                        <div class="card-body">

                                            <ul class="nav nav-tabs mb-3 nav-tabs-s1">
                                                <li class="nav-item">
                                                    <button class="nav-link active" style="font-weight: 600;"
                                                        data-bs-toggle="tab" data-bs-target="#custom-home-tab-pane"
                                                        type="button">Pricing</button>
                                                </li>
                                                <li class="nav-item">
                                                    <button class="nav-link" data-bs-toggle="tab"
                                                        data-bs-target="#custom-profile-tab-pane"
                                                        type="button">Stock</button>
                                                </li>

                                            </ul>
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="custom-home-tab-pane">

                                                    <div class="total_pricediv">
                                                        <div class="pricediv">

                                                            <div class="sale_div">
                                                                <h3
                                                                    style="color: #000; font-size: 17px; font-weight: 600;">
                                                                    Sale Price</h3>

                                                                <div class="item_price" id="saleprice">


                                                                    <div class="form-group">
                                                                        <div class="form-control-wrap">
                                                                            <input type="text" class="form-control"
                                                                                id="exampleFormControlInputText1"
                                                                                placeholder="Sale Price">
                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <div class="form-control-wrap">
                                                                            <select class="form-select"
                                                                                id="exampleFormControlInputText5"
                                                                                aria-label="Default select example">
                                                                                <option selected>Without tax</option>
                                                                                <option>With Tax</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>


                                                            <button class="btn add_wholesale" id="button_sale">+ Add
                                                                sale
                                                                Price</button>

                                                        </div>

                                                        <div class="pricediv">
                                                            <div class="wholesale_price mt-2">
                                                                <h3
                                                                    style="color: #000; font-size: 17px; font-weight: 600; margin-left: 22px;">
                                                                    Wholesale Price</h3>

                                                                <div class="wholesale_price_div" id="wholesale">
                                                                    <div class="form-group">
                                                                        <div class="form-control-wrap">
                                                                            <input type="text" class="form-control"
                                                                                id="exampleFormControlInputText1"
                                                                                placeholder="wholesale price">
                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <div class="form-control-wrap">
                                                                            <select class="form-select"
                                                                                id="exampleFormControlInputText5"
                                                                                aria-label="Default select example">
                                                                                <option selected>Without tax</option>
                                                                                <option>With Tax</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                            <button class="btn add_wholesale" id="button_wholesale">+
                                                                Add
                                                                Wholesale
                                                                Price</button>




                                                        </div>
                                                    </div>

                                                    <div class="total_pricediv">
                                                        <div class="pricediv">
                                                            <h4 style="font-size: 15px; color: #000; font-weight: 700;">
                                                                Purchase Price</h4>

                                                            <div class="item_price">


                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"
                                                                            id="exampleFormControlInputText1"
                                                                            placeholder="Purchase Price">
                                                                    </div>
                                                                </div>


                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <select class="form-select"
                                                                            id="exampleFormControlInputText5"
                                                                            aria-label="Default select example">
                                                                            <option selected="">Without tax</option>
                                                                            <option>With Tax</option>
                                                                        </select>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>

                                                        <div class="pricediv">
                                                            <h4 style="font-size: 15px; color: #000; font-weight: 700;">
                                                                Taxes</h4>

                                                            <div class="form-group tax_rate mt-3">
                                                                <label for="exampleFormControlInputText5"
                                                                    class="form-label">Tax rate</label>
                                                                <div class="form-control-wrap">
                                                                    <select class="form-select"
                                                                        id="exampleFormControlInputText5"
                                                                        aria-label="Default select example">
                                                                        <option selected>None</option>
                                                                        <option value="1">One</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <button class="btn btn-primary btn-sm mt-4">Save</button>


                                                </div>

                                                <div class="tab-pane fade" id="custom-profile-tab-pane">
                                                    <div class="col-xl-7">
                                                        <div class="row">
                                                            <div class="col-xl-4 .col-sm-12">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Opening Quantity">

                                                            </div>

                                                            <div class="col-xl-4 .col-sm-12">
                                                                <input type="text" class="form-control"
                                                                    placeholder="All Price">

                                                            </div>


                                                            <div class="col-xl-4 .col-sm-12 mb-3">

                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input placeholder="dd/mm/yyyy" type="text"
                                                                            class="form-control js-datepicker"
                                                                            data-title="Date" data-today-btn="true"
                                                                            data-clear-btn="true" autocomplete="off"
                                                                            id="datePicker1">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="col-xl-4 .col-sm-12">

                                                                <input type="text" class="form-control"
                                                                    placeholder="Min Stock to Maintain">

                                                            </div>

                                                            <div class="col-xl-4 .col-sm-12">

                                                                <input type="text" class="form-control"
                                                                    placeholder="Location">

                                                            </div>




                                                        </div>

                                                        <button class="btn btn-primary btn-sm mt-4">Save</button>

                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                </div>


                            </div>
                            <button class="btn btn-primary btn-sm mt-4">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
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
