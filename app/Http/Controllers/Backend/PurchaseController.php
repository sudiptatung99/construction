<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Carbon\Carbon;

class PurchaseController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchase = Purchase::with('vendor')->latest()->get();
        return view('pages.purchase.view', compact('purchase'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.purchase.purches');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $randpur = 'PUR' . rand(00000, 99999);
        // return $request->all();
        // $validatedData = $request->validate([
        //     'date' => ['required'],
        //     'payment_mode' => ['required'],
        //     'payment_status' => ['required'],
        //     'expeseno' => ['required'],
        //     'details' => ['required'],
        //     'total' => ['required'],
        // ]);
        // $request->validate([
        //     'addmore.*.item_id' => 'required',
        //     'addmore.*.qty' => 'required',
        //     'addmore.*.price' => 'required',
        //     'addmore.*.amount' => 'required',
        // ]);
        $fileName = null;
        if ($request->image) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $fileName);
        }
        $data = new Purchase;
        $data->total = $request->total;
        $data->subtotal = $request->subtotal;
        $data->details = $request->details;
        $data->payment_mode = $request->payment_mode;
        $data->payment_status = $request->payment_status;
        $data->gst = $request->gst;
        $data->gstamount = $request->gstamount;
        $data->vendor_id = $request->vendor_id;
        $data->expeseno = $randpur;
        $data->date =$request->date;
        $data->image = $fileName;
        $data->save();
        foreach ($request->addmore as  $value) {
            $pur_item = new PurchaseItem;
            $pur_item->item_id=$value['item_id'];
            $pur_item->qty=$value['qty'];
            $pur_item->price=$value['price'];
            $pur_item->amount=$value['amount'];
            $pur_item->purchase_id=$data->id;
            $pur_item->save();
       }
        toastr()->success('New Purches Data has beeen Added','sucess');
        return redirect('/purchase');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id=decrypt($id);
        $purchase = Purchase::find($id);
        $purchaseitem = PurchaseItem::with('item','purchase','item.unit')->where('purchase_id',$purchase->id)->get();
        // return $purchaseitem;
        return view('pages.purchase.edit', compact('purchase','purchaseitem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id=decrypt($id);
        // $validatedData = $request->validate([
        //     'name' => ['required'],
        //     'unit_id' => ['required'],
        //     'category_id' => ['required'],
        // ]);
        $itemUpdate = Purchase::find($id);
        if ($request->image) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            if ($itemUpdate->image) {
                unlink("images/" . $itemUpdate->image);
            }
            $itemUpdate->image = $fileName;
        }
        $itemUpdate->total = $request->total;
        $itemUpdate->details = $request->details;
        $itemUpdate->payment_mode = $request->payment_mode;
        $itemUpdate->payment_status = $request->payment_status;
        $itemUpdate->gst = $request->gst;
        $itemUpdate->subtotal = $request->subtotal;
        $itemUpdate->gstamount = $request->gstamount;
        $itemUpdate->vendor_id = $request->vendor_id;
        $itemUpdate->date =$request->date;
        $itemUpdate->save();
        PurchaseItem::where('purchase_id',$id)->delete();
        foreach ($request->addmore as  $value) {
            $pur_item = new PurchaseItem;
            $pur_item->item_id=$value['item_id'];
            $pur_item->qty=$value['qty'];
            $pur_item->price=$value['price'];
            $pur_item->amount=$value['amount'];
            $pur_item->purchase_id=$id;
            $pur_item->save();
       }
        toastr()->success('Your purchase data has been updated','sucess');
        return redirect('/purchase');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id=decrypt($id);
        $item = Purchase::find($id);
        Purchase::destroy($id);
        if ($item->image) {
            unlink("images/" . $item->image);
        }
        PurchaseItem::where('purchase_id',$id)->delete();
        toastr()->success('Purchase data has been deleted successfully!','sucess');
        return redirect('/purchase');
    }
}
