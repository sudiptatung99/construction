<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\CaseAmount;
use App\Models\Client;
use App\Models\Expense;
use App\Models\Purchase;
use App\Models\ReciveAmount;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// \Carbon\

class ReportController extends Controller
{
    public function sale()
    {
        $id = '';
        $paid = Sale::where('payment_status', 'Paid')->latest()->get();
        $unpaid = Sale::where('payment_status', 'Unpaid')->latest()->get();
        $advance = Sale::where('payment_status', 'Advance')->latest()->get();
        $alldata = Sale::with('client')->latest()->get();
        $reciveamount = ReciveAmount::all();
        return view('pages.reports.transation.sale', compact('paid', 'unpaid', 'alldata','reciveamount','id','advance'));
    }

    public function salefilter($id)
    {
        if ($id == 'this_month') {
            $thismonth = Carbon::now()->format('Y-m');
            $paid = Sale::where('date', 'LIKE', $thismonth . '%')->where('payment_status', 'Paid')->latest()->get();
            $unpaid = Sale::where('date', 'LIKE', $thismonth . '%')->where('payment_status', 'Unpaid')->latest()->get();
            $alldata = Sale::with('client')->where('date', 'LIKE', $thismonth . '%')->latest()->get();
            $reciveamount = ReciveAmount::where('date', 'LIKE', $thismonth . '%')->latest()->get();
            return view('pages.reports.transation.sale', compact('paid', 'unpaid', 'alldata', 'id','reciveamount','advance'));

        } else if ($id == 'last_month') {
            $lastmonth = Carbon::now()->modify('-1 months')->format('Y-m');
            $paid = Sale::where('date', 'LIKE', $lastmonth . '%')->where('payment_status', 'Paid')->latest()->get();
            $unpaid = Sale::where('date', 'LIKE', $lastmonth . '%')->where('payment_status', 'Unpaid')->latest()->get();
            $alldata = Sale::where('date', 'LIKE', $lastmonth . '%')->with('client')->where('date', 'LIKE', $lastmonth . '%')->latest()->get();
            $reciveamount = ReciveAmount::where('date', 'LIKE', $thismonth . '%')->latest()->get();
            return view('pages.reports.transation.sale', compact('paid', 'unpaid', 'alldata', 'id','reciveamount','advance'));

        } else if ($id == 'last_three') {
            $lastform = Carbon::now()->format('Y-m-d');
            $lastto = Carbon::now()->modify('-3 months')->format('Y-m-d');
            $paid = Sale::where('payment_status', 'Paid')->whereBetween('date', [$lastto, $lastform])->latest()->get();
            $unpaid = Sale::where('payment_status', 'Unpaid')->whereBetween('date', [$lastto, $lastform])->latest()->get();
            $alldata = Sale::with('client')->whereBetween('date', [$lastto, $lastform])->latest()->get();
            $advance = Sale::where('payment_status', 'Advance')->whereBetween('date', [$lastto, $lastform])->latest()->get();
            $reciveamount = ReciveAmount::where('date', 'LIKE', $thismonth . '%')->latest()->get();
            return view('pages.reports.transation.sale', compact('paid', 'unpaid', 'alldata', 'id','reciveamount','advance'));

        } else if ($id = 'pre_year') {
            $preyear = Carbon::now()->modify('-1 year')->format('Y');
            $paid = Sale::where('date', 'LIKE', $preyear . '%')->where('payment_status', 'Paid')->latest()->get();
            $unpaid = Sale::where('date', 'LIKE', $preyear . '%')->where('payment_status', 'Unpaid')->latest()->get();
            $alldata = Sale::with('client')->where('date', 'LIKE', $preyear . '%')->latest()->get();
            $advance = Sale::where('payment_status', 'Advance')->where('date', 'LIKE', $preyear . '%')->latest()->get();
            $reciveamount = ReciveAmount::where('date', 'LIKE', $thismonth . '%')->latest()->get();
            return view('pages.reports.transation.sale', compact('paid', 'unpaid', 'alldata', 'id','reciveamount','advance'));

        } else {
            $paid = Sale::where('payment_status', 'Paid')->latest()->get();
            $unpaid = Sale::where('payment_status', 'Unpaid')->latest()->get();
            $alldata = Sale::with('client')->latest()->get();
            $advance = Sale::where('payment_status', 'Advance')->latest()->get();
             $reciveamount = ReciveAmount::all();
            return view('pages.reports.transation.sale', compact('paid', 'unpaid', 'alldata', 'id','reciveamount','advance'));
        }

    }

    public function between(Request $request)
    {
        // $from = Carbon::createFromFormat('d/m/Y', $request->first_date)->format('Y-m-d');
        // $to = Carbon::createFromFormat('d/m/Y',$request->second_date)->format('Y-m-d');
        $from = $request->first_date;
        $to = $request->second_date;
        $id = 'sale';
        $paid = Sale::where('payment_status', 'Paid')->whereBetween('date', [$from, $to])->latest()->get();
        $unpaid = Sale::where('payment_status', 'Unpaid')->whereBetween('date', [$from, $to])->latest()->get();
        $advance = Sale::where('payment_status', 'Advance')->whereBetween('date', [$from, $to])->latest()->get();
        $alldata = Sale::with('client')->whereBetween('date', [$from, $to])->latest()->get();
        $reciveamount = ReciveAmount::whereBetween('date', [$from, $to])->latest()->get();
        return view('pages.reports.transation.sale', compact('paid', 'unpaid', 'alldata', 'id', 'from', 'to','reciveamount','advance'));
    }

    public function purchase()
    {
        $id = '';
        $paid = Purchase::where('payment_status', 'Paid')->latest()->get();
        $unpaid = Purchase::where('payment_status', 'Unpaid')->latest()->get();
        $alldata = Purchase::with('vendor')->latest()->get();
        return view('pages.reports.transation.purchase', compact('paid', 'unpaid', 'alldata', 'id'));
    }

    public function searchpurchase($id)
    {
        if ($id == 'this_month') {
            $thismonth = Carbon::now()->format('Y-m');
            $paid = Purchase::where('date', 'LIKE', $thismonth . '%')->where('payment_status', 'Paid')->latest()->get();
            $unpaid = Purchase::where('date', 'LIKE', $thismonth . '%')->where('payment_status', 'Unpaid')->latest()->get();
            $alldata = Purchase::where('date', 'LIKE', $thismonth . '%')->with('vendor')->latest()->get();
            return view('pages.reports.transation.purchase', compact('paid', 'unpaid', 'alldata', 'id'));

        } else if ($id == 'last_month') {
            $lastmonth = Carbon::now()->modify('-1 months')->format('Y-m');
            $paid = Purchase::where('date', 'LIKE', $lastmonth . '%')->where('payment_status', 'Paid')->latest()->get();
            $unpaid = Purchase::where('date', 'LIKE', $lastmonth . '%')->where('payment_status', 'Unpaid')->latest()->get();
            $alldata = Purchase::where('date', 'LIKE', $lastmonth . '%')->with('vendor')->latest()->get();
            return view('pages.reports.transation.purchase', compact('paid', 'unpaid', 'alldata', 'id'));

        } else if ($id == 'last_three') {
            $lastform = Carbon::now()->format('Y-m-d');
            $lastto = Carbon::now()->modify('-3 months')->format('Y-m-d');
            $paid = Purchase::where('payment_status', 'Paid')->whereBetween('date', [$lastto, $lastform])->latest()->get();
            $unpaid = Purchase::where('payment_status', 'Unpaid')->whereBetween('date', [$lastto, $lastform])->latest()->get();
            $alldata = Purchase::whereBetween('date', [$lastto, $lastform])->with('vendor')->latest()->get();
            return view('pages.reports.transation.purchase', compact('paid', 'unpaid', 'alldata', 'id'));

        } else if ($id = 'pre_year') {
            $preyear = Carbon::now()->modify('-1 year')->format('Y');
            $paid = Purchase::where('date', 'LIKE', $preyear . '%')->where('payment_status', 'Paid')->latest()->get();
            $unpaid = Purchase::where('date', 'LIKE', $preyear . '%')->where('payment_status', 'Unpaid')->latest()->get();
            $alldata = Purchase::where('date', 'LIKE', $preyear . '%')->with('vendor')->latest()->get();
            return view('pages.reports.transation.purchase', compact('paid', 'unpaid', 'alldata', 'id'));

        } else {
            $paid = Purchase::where('payment_status', 'Paid')->latest()->get();
            $unpaid = Purchase::where('payment_status', 'Unpaid')->latest()->get();
            $alldata = Purchase::with('vendor')->get();
            return view('pages.reports.transation.purchase', compact('paid', 'unpaid', 'alldata', 'id'));
        }

    }

    public function purchasebetween(Request $request)
    {
        // $from = Carbon::createFromFormat('d/m/Y', $request->first_date)->format('Y-m-d');
        // $to = Carbon::createFromFormat('d/m/Y',$request->second_date)->format('Y-m-d');
        $request->validate([
            'first_date' => ['required'],
            'second_date' => ['required'],
        ]);
        $from = $request->first_date;
        $to = $request->second_date;
        $id = 'sale';
        $paid = Purchase::where('payment_status', 'Paid')->whereBetween('date', [$from, $to])->latest()->get();
        $unpaid = Purchase::where('payment_status', 'Unpaid')->whereBetween('date', [$from, $to])->latest()->get();
        $alldata = Purchase::whereBetween('date', [$from, $to])->with('vendor')->latest()->get();
        return view('pages.reports.transation.purchase', compact('paid', 'unpaid', 'alldata', 'id', 'from', 'to'));
    }

    public function daybook()
    {
        $expense = Expense::all();
        return view('pages.reports.transation.daybook', compact('expense'));
    }

    public function transation()
    {
        $id = '';
        $paid = Sale::where('payment_status', 'Paid')->latest()->get();
        $unpaid = Sale::where('payment_status', 'Unpaid')->latest()->get();
        $alldata = Sale::with('client')->latest()->get();
        return view('pages.reports.transation.transation', compact('paid', 'unpaid', 'alldata', 'id'));
    }

    public function transationfilter($id)
    {
        if ($id == 'this_month') {
            $thismonth = Carbon::now()->format('Y-m');
            $paid = Sale::where('date', 'LIKE', $thismonth . '%')->where('payment_status', 'Paid')->latest()->get();
            $unpaid = Sale::where('date', 'LIKE', $thismonth . '%')->where('payment_status', 'Unpaid')->latest()->get();
            $alldata = Sale::with('client')->where('date', 'LIKE', $thismonth . '%')->latest()->get();
            return view('pages.reports.transation.transation', compact('paid', 'unpaid', 'alldata', 'id'));

        } else if ($id == 'last_month') {
            $lastmonth = Carbon::now()->modify('-1 months')->format('Y-m');
            $paid = Sale::where('date', 'LIKE', $lastmonth . '%')->where('payment_status', 'Paid')->latest()->get();
            $unpaid = Sale::where('date', 'LIKE', $lastmonth . '%')->where('payment_status', 'Unpaid')->latest()->get();
            $alldata = Sale::with('client')->where('date', 'LIKE', $lastmonth . '%')->latest()->get();
            return view('pages.reports.transation.transation', compact('paid', 'unpaid', 'alldata', 'id'));

        } else if ($id == 'last_three') {
            $lastform = Carbon::now()->format('Y-m-d');
            $lastto = Carbon::now()->modify('-3 months')->format('Y-m-d');
            $paid = Sale::where('payment_status', 'Paid')->whereBetween('date', [$lastto, $lastform])->latest()->get();
            $unpaid = Sale::where('payment_status', 'Unpaid')->whereBetween('date', [$lastto, $lastform])->latest()->get();
            $alldata = Sale::with('client')->whereBetween('date', [$lastto, $lastform])->latest()->get();
            return view('pages.reports.transation.transation', compact('paid', 'unpaid', 'alldata', 'id'));

        } else if ($id = 'pre_year') {
            $preyear = Carbon::now()->modify('-1 year')->format('Y');
            $paid = Sale::where('date', 'LIKE', $preyear . '%')->where('payment_status', 'Paid')->latest()->get();
            $unpaid = Sale::where('date', 'LIKE', $preyear . '%')->where('payment_status', 'Unpaid')->latest()->get();
            $alldata = Sale::with('client')->where('date', 'LIKE', $preyear . '%')->latest()->get();
            return view('pages.reports.transation.transation', compact('paid', 'unpaid', 'alldata', 'id'));

        } else {
            $paid = Sale::where('payment_status', 'Paid')->latest()->get();
            $unpaid = Sale::where('payment_status', 'Unpaid')->latest()->get();
            $alldata = Sale::with('client')->latest()->latest()->get();
            return view('pages.reports.transation.transation', compact('paid', 'unpaid', 'alldata', 'id'));
        }

    }

    public function transationbetween(Request $request)
    {
        $request->validate([
            'first_date' => ['required'],
            'second_date' => ['required'],
        ]);
        // $from = Carbon::createFromFormat('d/m/Y', $request->first_date)->format('Y-m-d');
        // $to = Carbon::createFromFormat('d/m/Y',$request->second_date)->format('Y-m-d');
        $from = $request->first_date;
        $to = $request->second_date;
        $id = 'sale';
        $paid = Sale::where('payment_status', 'Paid')->whereBetween('date', [$from, $to])->latest()->get();
        $unpaid = Sale::where('payment_status', 'Paid')->whereBetween('date', [$from, $to])->latest()->get();
        $alldata = Sale::with('client')->whereBetween('date', [$from, $to])->latest()->get();
        return view('pages.reports.transation.transation', compact('paid', 'unpaid', 'alldata', 'id', 'from', 'to'));
    }

    public function profit_loss()
    {
        $sale = Sale::all();
        $expense = Expense::all();
        $purchase = Purchase::all();
        $recive = ReciveAmount::all();
        return view('pages.reports.transation.profitloss', compact('sale', 'expense', 'purchase', 'recive'));
    }

    public function bill_profit()
    {
        // $client= Client::with('sale','reciver')->latest()->get();
         $client= Client::all();
        foreach ($client as $key => $value) {
            $data = [];
            $sale = Sale::where('client_id',$value->id)->latest()->get();
            $recive = ReciveAmount::where('client_id',$value->id)->latest()->get();
            array_push($data,$sale); 
            $value->sale = $sale; 
            $value->reciver = $recive; 
        }
        // $bill = Sale::with('client', 'client.reciver')->latest()->whereBetween('date', [$from, $to])->get();
        return view('pages.reports.transation.billprofit', compact('client'));
    }

    public function bill_profit_between(Request $request)
    {
        $request->validate([
            'first_date' => ['required'],
            'second_date' => ['required'],
        ]);
        $from = $request->first_date;
        $to = $request->second_date;
        $client= Client::all();
        foreach ($client as $key => $value) {
            $data = [];
            $sale = Sale::where('client_id',$value->id)->whereBetween('date', [$from, $to])->latest()->get();
            $recive = ReciveAmount::where('client_id',$value->id)->whereBetween('date', [$from, $to])->latest()->get();
            array_push($data,$sale); 
            $value->sale = $sale; 
            $value->reciver = $recive; 
        }
        // $bill = Sale::with('client', 'client.reciver')->latest()->whereBetween('date', [$from, $to])->get();
        return view('pages.reports.transation.billprofit', compact('client', 'from', 'to'));
    }

    public function balance_sheet()
    {
        $bank = Bank::all();
        $case = CaseAmount::all();
        $saledata = Sale::all();
        $purchase = Purchase::all();
        $expense = Expense::all();
        $recive = ReciveAmount::all();
        $id = '';
        return view('pages.reports.transation.blancesheet', compact('saledata', 'id', 'recive', 'purchase', 'bank', 'case', 'expense'));
    }

    public function balance_sheet_search($id)
    {
        $from = ($id) . '-' . '04' . '-' . '01';
        $to = ($id + 1) . '-' . '03' . '-' . '31';
        $bank = Bank::whereBetween('updated_at', [$from, $to])->latest()->get();
        $case = CaseAmount::whereBetween('date', [$from, $to])->latest()->get();
        $saledata = Sale::whereBetween('date', [$from, $to])->latest()->get();
        $purchase = Purchase::whereBetween('date', [$from, $to])->latest()->get();
        $expense = Expense::whereBetween('date', [$from, $to])->latest()->get();
        $recive = ReciveAmount::whereBetween('date', [$from, $to])->latest()->get();
        return view('pages.reports.transation.blancesheet', compact('saledata', 'id', 'recive', 'purchase', 'bank', 'case', 'expense'));
    }

    public function year_profit()
    {
        $client= Client::with('sale','reciver')->latest()->get();
        $id = '';
        return view('pages.reports.transation.year_wise_profit', compact('client','id'));
    }

    public function  year_profit_search($id){
        $from = ($id) . '-' . '04' . '-' . '01';
        $to = ($id + 1) . '-' . '03' . '-' . '31';
        $client= Client::all();
        foreach ($client as $key => $value) {
            $data = [];
            $sale = Sale::where('client_id',$value->id)->whereBetween('date', [$from, $to])->latest()->get();
            $recive = ReciveAmount::where('client_id',$value->id)->whereBetween('date', [$from, $to])->latest()->get();
            array_push($data,$sale); 
            $value->sale = $sale; 
            $value->reciver = $recive; 
        }
        return view('pages.reports.transation.year_wise_profit', compact('client','id'));
    }

    public function reciveAmount(){
        $recive = ReciveAmount::where('payment_status','!=','Advance')->with('client')->orderBy('date','asc')->get();
        $case = ReciveAmount::where('payment_status','!=','Advance')->where('payment_mode','Cash')->orderBy('date','asc')->get();
        $online = ReciveAmount::where('payment_status','!=','Advance')->where('payment_status','Online')->orderBy('date','asc')->get();
        return view('pages.reports.transation.recive_amount',compact('recive','case','online'));
    }

    public function reciveAmountBetween(Request $request){
        $request->validate([
            'first_date' => ['required'],
            'second_date' => ['required'],
        ]);
        $from = $request->first_date;
        $to = $request->second_date;
        $recive = ReciveAmount::where('payment_status','!=','Advance')->whereBetween('date', [$from, $to])->with('client')->orderBy('date','asc')->get();
        $case = ReciveAmount::where('payment_status','!=','Advance')->where('payment_mode','Cash')->whereBetween('date', [$from, $to])->orderBy('date','asc')->get();
        $online = ReciveAmount::where('payment_status','!=','Advance')->where('payment_status','Online')->where('payment_status','!=','Advance')->whereBetween('date', [$from, $to])->orderBy('date','asc')->get();
        return view('pages.reports.transation.recive_amount',compact('recive','case','online','from','to'));
    }

    public function reciveAdvanceAmount(){
        $recive = ReciveAmount::where('payment_status','Advance')->with('client')->orderBy('date','asc')->get();
        $case = ReciveAmount::where('payment_status','Advance')->where('payment_mode','Cash')->orderBy('date','asc')->get();
        $online = ReciveAmount::where('payment_status','Advance')->where('payment_mode','Online')->orderBy('date','asc')->get();
        return view('pages.reports.transation.advance_amount',compact('recive','case','online'));
    }

    public function reciveAdvanceAmountBetween(Request $request){
        $request->validate([
            'first_date' => ['required'],
            'second_date' => ['required'],
        ]);
        $from = $request->first_date;
        $to = $request->second_date;
        $recive = ReciveAmount::where('payment_status','Advance')->whereBetween('date', [$from, $to])->with('client')->orderBy('date','asc')->get();
        $case = ReciveAmount::where('payment_status','Advance')->where('payment_mode','Cash')->whereBetween('date', [$from, $to])->orderBy('date','asc')->get();
        $online = ReciveAmount::where('payment_status','Advance')->where('payment_mode','Online')->whereBetween('date', [$from, $to])->orderBy('date','asc')->get();
        return view('pages.reports.transation.advance_amount',compact('recive','case','online','from','to'));
    }
    
    public function expense(){
        $expense = Expense::all();
        $case = Expense::where('pay_mode','Cash')->orderBy('date','asc')->get();
        $online = Expense::where('pay_mode','Online')->orderBy('date','asc')->get();
        return view('pages.reports.transation.expense',compact('online','case','expense'));
    }

    public function expenseBetween(Request $request){
        $request->validate([
            'first_date' => ['required'],
            'second_date' => ['required'],
        ]);
        $from = $request->first_date;
        $to = $request->second_date;
        $expense = Expense::whereBetween('date', [$from, $to])->orderBy('date','asc')->get();
        $case = Expense::where('pay_mode','Cash')->whereBetween('date', [$from, $to])->orderBy('date','asc')->get();
        $online = Expense::where('pay_mode','Online')->whereBetween('date', [$from, $to])->orderBy('date','asc')->get();
        return view('pages.reports.transation.expense',compact('online','case','expense','from','to'));
    }

}
