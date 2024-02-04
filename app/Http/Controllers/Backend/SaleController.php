<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ReciveAmount;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\CaseAmount;
use Illuminate\Support\Facades\Redirect;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sale = Sale::with('client')->latest()->get();
        return view('pages.sale.view', compact('sale'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = '';
        return view('pages.sale.sale', compact('id'));
    }
    public function createid($id)
    {
        return view('pages.sale.sale', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */

    //  ini_amount
    public function store(Request $request)
    {
        $sale = Sale::all();
        if(count($sale)>0){
            $randsale = count($sale) + 1;
        }else{
            $randsale = 1;
        }
        $fileName = null;
        if ($request->image) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $fileName);
        }
        $data = new Sale;
        $data->total = $request->total;
        $data->details = $request->details;
        $data->payment_mode = $request->payment_mode;
        $data->payment_status = $request->payment_status;
        $data->gst = $request->gst;
        $data->gstamount = $request->gstamount;
        $data->sale_no = $randsale;
        $data->subtotal = $request->subtotal;
        $data->client_id = $request->client_id;
        $data->date = $request->date;
        $data->image = $fileName;
        $data->save();
        if ($request->ini_amount > 0 || $request->payment_status == 'Paid') {
            $inamount = new ReciveAmount;
            $inamount->client_id = $request->client_id;
            $inamount->payment_mode = $request->payment_mode;
            $inamount->sale_id = $data->id;
            $inamount->date = $request->date;
            $inamount->payment_status = $request->payment_status;
            $inamount->bank_id = $request->payment_mode=="Online"?$request->bank:"";
            $request->payment_status == 'Paid' ? $inamount->amount = $request->total : $inamount->amount = $request->ini_amount;
            $inamount->save();
        }
        if($request->payment_mode=="Online"){
            $bank = Bank::find($request->bank);
            $request->payment_status == 'Paid' ?$bank->amount = $bank->amount + $request->total : $bank->amount = $bank->amount + $request->ini_amount;
            $bank->save();
        }else{
            $cash = CaseAmount::get()->first();
            if($cash){
                $request->payment_status == 'Paid' ? $cash->amount = $cash->amount + $request->total : $cash->amount = $cash->amount + $request->ini_amount;
                $cash->save(); 
            }else{
                $firstCash = new CaseAmount;
                $request->payment_status == 'Paid' ? $firstCash->amount = $request->total : $firstCash->amount = $request->ini_amount;
                $firstCash->name = "Cash In Hand";
                $firstCash->date = $request->date;
                $firstCash->save();
            }
        }
        foreach ($request->addmore as $value) {
            $pur_item = new SaleItem;
            $pur_item->item_id = $value['item_id'];
            $pur_item->qty = $value['qty'];
            $pur_item->price = $value['price'];
            $pur_item->amount = $value['amount'];
            $pur_item->sale_id = $data->id;
            $pur_item->save();
        }
        toastr()->success('New Sales Data has beeen Added', 'sucess');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = decrypt($id);
        $sale = Sale::with('client')->find($id);
        $saleItem = SaleItem::with('item', 'sale', 'item.unit')->where('sale_id', $id)->latest()->get();
        return view('pages.sale.saleItem', compact('sale', 'saleItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = decrypt($id);
        $sale = Sale::with('client', 'client.reciver')->find($id);
        $saleItem = SaleItem::with('item', 'sale', 'item.unit')->where('sale_id', $sale->id)->get();
        $reciveamount = ReciveAmount::where('sale_id',$id)->first();
        $bank = Bank::find($reciveamount->bank_id);
        return view('pages.sale.edit', compact('sale', 'saleItem','reciveamount','bank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = decrypt($id);
        $itemUpdate = Sale::find($id);
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
        $itemUpdate->gstamount = $request->gstamount;
        $itemUpdate->subtotal = $request->subtotal;
        $itemUpdate->client_id = $request->client_id;
        $itemUpdate->date = $request->date;
        $itemUpdate->save();
        $reciveAmount = ReciveAmount::where('sale_id',$id)->first();
        if ($reciveAmount) {
            if($reciveAmount->bank_id!=""){
                $bank = Bank::find($reciveAmount->bank_id);
                $bank->amount = $bank->amount - $reciveAmount->amount;
                $bank->save();
            }else{
                 $cash = CaseAmount::get()->first();
                 $cash->amount =  $cash->amount - $reciveAmount->amount;
                 $cash->save();
            }
            $reciveAmount->delete();
        }
        
        if($request->payment_mode=="Online"){
            $bank = Bank::find($request->bank);
            $request->payment_status == 'Paid' ?$bank->amount = $bank->amount + $request->total : $bank->amount = $bank->amount + $request->ini_amount;
            $bank->save();
        }else{
            $cash = CaseAmount::get()->first();
            $request->payment_status == 'Paid' ? $cash->amount = $cash->amount + $request->total  : $cash->amount = $cash->amount + $request->ini_amount;
            $cash->save(); 
        }
       
        if ($request->ini_amount > 0 || $request->payment_status == 'Paid') {
            $inamount = new ReciveAmount;
            $inamount->client_id = $request->client_id;
            $inamount->payment_mode = $request->payment_mode;
            $inamount->sale_id = $itemUpdate->id;
            $inamount->date = $request->date;
            $inamount->payment_status = $request->payment_status;
            $request->payment_mode=="Online"? $inamount->bank_id = $request->bank:$inamount->bank_id="";
            $request->payment_status == 'Paid' ? $inamount->amount = $request->total : $inamount->amount = $request->ini_amount;
            $inamount->save();
        }
        SaleItem::where('sale_id', $id)->delete();
        foreach ($request->addmore as $value) {
            $sale_item = new SaleItem;
            $sale_item->item_id = $value['item_id'];
            $sale_item->qty = $value['qty'];
            $sale_item->price = $value['price'];
            $sale_item->amount = $value['amount'];
            $sale_item->sale_id = $id;
            $sale_item->save();
        }
        toastr()->success('Your Sales data has been updated', 'sucess');
        return redirect('/sale');
    }

    public function destroy(string $id)
    {
        $id = decrypt($id);
        $item = Sale::find($id);
        Sale::destroy($id);
        if ($item->image) {
            unlink("images/" . $item->image);
        }
        SaleItem::where('sale_id', $id)->delete();
        toastr()->success('Sales data has been deleted successfully!', 'sucess');
        return redirect('/sale');
    }
}
