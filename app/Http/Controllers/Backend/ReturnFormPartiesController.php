<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ReturnClient;
use App\Models\ReturnFormParties;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class ReturnFormPartiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $returnItem = ReturnClient::with('client', 'returnItem.item')->get();
        return view('pages.return.parties.parties', compact('returnItem'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $id = decrypt($id);
        $sale = Sale::with('client', 'client.reciver')->find($id);
        $saleItem = SaleItem::with('item', 'sale', 'item.unit')->where('sale_id', $id)->get();
        return view('pages.return.parties.create_return_parties', compact('sale', 'saleItem', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $id = decrypt($id);
        $returnItem = new ReturnClient;
        $returnItem->client_id = $request->client_id;
        $returnItem->sale_id = $id;
        $returnItem->date = $request->date;
        $returnItem->total = $request->total;
        $returnItem->save();
        foreach ($request->addmore as $value) {
            $parties = new ReturnFormParties;
            $parties->item_id = $value['item_id'];
            $parties->return_client_id = $returnItem->id;
            $parties->qty = $value['qty'];
            $parties->price = $value['price'];
            $parties->amount = $value['amount'];
            $parties->save();
        }
        toastr()->success('Return Item has been Added', 'sucess');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = decrypt($id);
        $return = ReturnClient::find($id);
        $returnItem = ReturnFormParties::where('return_client_id', $id)->with('item')->get();
        return view('pages.return.parties.viewmore', compact('return', 'returnItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = decrypt($id);
        $return = ReturnClient::find($id);
        $returnItem = ReturnFormParties::where('return_client_id', $id)->with('item')->get();
        return view('pages.return.parties.edit_parties', compact('return', 'returnItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = decrypt($id);
        $updatereturn = ReturnClient::find($id);
        $updatereturn->client_id = $request->client_id;
        $updatereturn->date = $request->date;
        $updatereturn->total = $request->total;
        $updatereturn->save();
        ReturnFormParties::where('return_client_id', $updatereturn->id)->delete();
        foreach ($request->addmore as $value) {
            $parties = new ReturnFormParties;
            $parties->item_id = $value['item_id'];
            $parties->return_client_id = $updatereturn->id;
            $parties->qty = $value['qty'];
            $parties->price = $value['price'];
            $parties->amount = $value['amount'];
            $parties->save();
        }
        toastr()->success('Return Item has been Update successfully!', 'sucess');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = decrypt($id);
        ReturnClient::destroy($id);
        toastr()->success('Return Item has been deleted successfully!', 'sucess');
        return redirect()->back();
    }

    public function return (Request $request)
    {
        $id = $request->data;
        $returnItem = SaleItem::with('item.unit')->where('id', $id)->first();
        return response()->json(['data' => $returnItem]);
    }
}
