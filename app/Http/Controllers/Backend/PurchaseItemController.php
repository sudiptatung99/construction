<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Unit;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use App\Models\VendorPayment;


class PurchaseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $id = decrypt($id);
        $purchase = Purchase::find($id);
        $purchaseitem = PurchaseItem::with('item','purchase','item.unit')->where('purchase_id',$id)->latest()->get();
        // return  $purchase;
        return view('pages.purchase.purchaseItem', compact('purchase','purchaseitem'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $id=decrypt($id);
        return view('pages.purchase.purchaseItem',compact('id'));
    }

    public function unit(Request $request)
    {
        $item = Item::find($request->item);
        $unit = Unit::find($item->unit_id );
       return response()->json(['success' => true, 'item' => $unit]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $id = decrypt($id);
        $request->validate([
            'addmore.*.item_id' => 'required',
            'addmore.*.qty' => 'required',
            'addmore.*.purchase_id' => 'required',
            'addmore.*.amount' => 'required',
        ]);
        foreach ($request->addmore as  $value) {
             PurchaseItem::create($value);;
        }
        toastr()->success('New Purchase Item has beeen Added','sucess');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = decrypt($id);
        $purchaseitem = PurchaseItem::find($id);
        return view('pages.purchaseitem.edit',compact('purchaseitem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = decrypt($id);
        PurchaseItem::destroy($id);
        toastr()->success('Purchase Item has been deleted successfully!','sucess');
        return redirect('/purchase/item/view');
    }
    
     public function payment($id)
    {
        $id = decrypt($id);
        $purchase = Purchase::find($id);
        $venPayment = VendorPayment::where('purchase_id', $id)->get();
        return view('pages.purchase.payment_status', compact('id', 'purchase', 'venPayment'));
    }
    public function AddPayment($id, Request $request)
    {
        $id = decrypt($id);
        $request->validate([
            'payment_mode' => 'required',
            'total' => 'required',
            'date' => 'required',
        ]);
        $amount = 0;
        $purchaseData = Purchase::find($id);
        $venPayment = VendorPayment::where('purchase_id', $id)->get();
        foreach ($venPayment as $key => $value) {
            $amount = ($amount + $value->total);
        }
        if ($purchaseData->total <= ($amount+$request->total)) {
            $purchaseData->payment_status = 'Paid';
            $purchaseData->save();
        }
        $vendor = new VendorPayment;
        $vendor->payment_mode = $request->payment_mode;
        $vendor->total = $request->total;
        $vendor->date = $request->date;
        $vendor->purchase_id = $id;
        $vendor->save();
        toastr()->success('New Payment Added successfully!', 'sucess');
        return redirect()->back();
    }
}
