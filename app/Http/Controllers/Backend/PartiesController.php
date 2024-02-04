<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ReciveAmount;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\CaseAmount;
use PDF;

class PartiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = Client::with('sale','reciver')->latest()->get();
        return view('pages.parties.parties', compact('client'));
    }
    public function no_id()
    {
        return view('pages.parties.parties');
    }

    public function view($id)
    {
        $id = decrypt($id);
        $client = Client::with('sale','reciver')->latest()->get();
        $oneClient = Client::find($id);
        $recive = ReciveAmount::where('client_id', $id)->latest()->get();
        $saledata = Sale::with('saleItem', 'return')->where('client_id', $id)->latest()->get();
        // return $saledata ;
        return view('pages.parties.parties', compact('client', 'oneClient', 'saledata', 'id', 'recive'));
    }

    public function addamount(Request $request, $id)
    {
        $validatedData = $request->validate([
            'payment_mode' => ['required'],
            'ini_amount' => ['required'],
            'date' => ['required'],
        ]);
        $id = decrypt($id);
         if($request->payment_mode=="Online"){
            $bank = Bank::find($request->bank);
            $bank->amount =  $bank->amount + $request->ini_amount;
            $bank->save();
        }else{
            $cash = CaseAmount::get()->first();
            if($cash){
                $cash->amount =  $cash->amount + $request->ini_amount;
                $cash->save(); 
            }else{
                $firstCash = new CaseAmount;
                $firstCash->amount = $request->ini_amount;
                $firstCash->name = "Cash In Hand";
                $firstCash->date = $request->date;
                $firstCash->save();
            }
        }
        $inamount = new ReciveAmount;
        $inamount->client_id = $id;
        $inamount->payment_mode = $request->payment_mode;
        $inamount->amount = $request->ini_amount;
        $inamount->payment_status = $request->payment_status;
        $inamount->date = $request->date;
        $inamount->bank_id = $request->bank;
        $inamount->save();
        toastr()->success('Recive Amount has beeen Added', 'sucess');
        return back();
    }

    public function editamount($id)
    {
        $id = decrypt($id);
        $reciveamount = ReciveAmount::find($id);
        $bank = Bank::where("id", $reciveamount->bank_id)->first();
        return view('pages.parties.edit_amount', compact('reciveamount','bank'));
    }

    public function updateamount(Request $request, $id)
    {
        $id = decrypt($id);
        $recive = ReciveAmount::find($id);
        $bank = Bank::find($recive->bank_id);
         if($recive->bank_id!=""){
            $bank = Bank::find($recive->bank_id);
            $bank->amount = $bank->amount - $recive->amount;
            $bank->save();
        }else{
             $cash = CaseAmount::get()->first();
             $cash->amount =  $cash->amount - $recive->amount;
             $cash->save();
        }
        $recive->payment_mode = $request->payment_mode;
        $recive->amount = $request->ini_amount;
        $recive->payment_status = $request->payment_status;
        $request->payment_mode=="Online"?$recive->bank_id = $request->bank_id:$recive->bank_id="";
        $recive->date = $request->date;
        $recive->save();
         if($recive->bank_id!=""){
            $bank = Bank::find($recive->bank_id);
            $bank->amount = $bank->amount + $recive->amount;
            $bank->save();
        }else{
             $cash = CaseAmount::get()->first();
             $cash->amount =  $cash->amount + $recive->amount;
             $cash->save();
        }
        toastr()->success('Recive Amount has beeen Updated', 'sucess');
        return redirect()->back();
    }

    public function deleteamount($id)
    {
        $id = decrypt($id);
        ReciveAmount::destroy($id);
        toastr()->success('Recive Amount has beeen Deleted', 'sucess');
        return redirect()->back();
    }

    public function generatePDF(){
        $client = Client::with('sale','reciver')->latest()->get();
        // $client = compact('data');
        $pdf = PDF::loadView('partiespdf', compact('client'));
        return $pdf->download('PartiesDue.pdf');
    }
}
