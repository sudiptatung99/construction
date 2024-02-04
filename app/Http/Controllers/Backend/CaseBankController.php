<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\CaseAmount;
use Illuminate\Http\Request;

class CaseBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function bank($id)
    {
        $id = decrypt($id);
        $bank = Bank::find($id);
        $banks = Bank::all();
        return view('pages.CashBank.bank_account', compact('bank', 'banks', 'id'));
    }

    public function bank_wihoutid()
    {
        // $id = decrypt($id);
        // $bank = Bank::find($id);
        $banks = Bank::all();
        return view('pages.CashBank.bank_account', compact('banks'));
    }

    public function addbank(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required'],
            'holdername' => ['required'],
            'account_number' => ['required'],
        ]);
        $bank = new Bank;
        $bank->name = $request->name;
        $bank->holdername = $request->holdername;
        $bank->account_number = $request->account_number;
        $bank->amount = $request->amount ? $request->amount : 0;
        $bank->save();
        toastr()->success('New Bank has beeen Added', 'sucess');
        return back();
    }

    public function addbankamount(Request $request, $id)
    {
        $id = decrypt($id);
        $bank = Bank::find($id);
        $bankamount = $request->extra_amount;
        $banktotalAmount = $bankamount + $bank->amount;
        $bank->amount = $banktotalAmount;
        $bank->save();
        toastr()->success('Amount Added has been Updated!', 'sucess');
        return back();
    }
    public function removebankamount(Request $request, $id)
    {
        $id = decrypt($id);
        $bank = Bank::find($id);
        $bankamount = $request->extra_amount;
        $banktotalAmount = $bank->amount - $bankamount;
        if ($banktotalAmount < 0) {
            toastr()->warning('Amount Not Suffecient!', 'warning');
            return back();
        }
        $bank->amount = $banktotalAmount;
        $bank->save();
        toastr()->success('Amount Debited has been Updated!', 'sucess');
        return back();
    }

    public function case ()
    {
        $case = CaseAmount::all();
        return view('pages.CashBank.caseinhand', compact('case'));
    }
    public function addamount(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'amount' => 'required',
        ]);
        $bank = new CaseAmount;
        $bank->name = $request->name;
        $bank->date = $request->date;
        $bank->amount = $request->amount;
        $bank->save();
        toastr()->success('Amount Added  has been Updated!', 'sucess');
        return back();
    }
    public function removeamount($id, Request $request)
    {
        $id = decrypt($id);
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'amount' => 'required',
        ]);
        $bank = CaseAmount::find($id);
        $bank->name = $request->name;
        $bank->date = $request->date;
        $bank->amount = $request->amount;
        $bank->save();
        toastr()->success('Amount has been Updated!', 'sucess');
        return back();
    }

    public function deleteAmount($id){
        $id = decrypt($id);
        CaseAmount::destroy($id);
        toastr()->success('Amount has been Deleted Successfully!', 'sucess');
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
