<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\CaseAmount;
use App\Models\Expense;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\ReciveAmount;
use App\Models\Sale;
use App\Models\Item;
use App\Models\SaleItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalamount = 0;
        $totalexpense = 0;
        $totalpurchase = 0;
        $totalrecive = 0;
        $totalpurchase = 0;

        $sevendatatotal = 0;
        $sixdatatotal = 0;
        $fivedatatotal = 0;
        $fourdatatotal = 0;
        $threedatatotal = 0;
        $twodatatotal = 0;
        $onedatatotal = 0;
        $presentdatatotal = 0;

        $alldata = Sale::all();
        $purchase = Purchase::all();
        $expense = Expense::all();
        $bank = Bank::all();
        $recive = ReciveAmount::all();
        $case = CaseAmount::all();
        $sellItem = array();
        $items = SaleItem::with('item', 'item.unit')->get();
        $stock = Item::with('purchaseitem','saleitem')->get();

        foreach ($alldata as $key => $value) {
            $totalamount = $totalamount + $value->total;
        }
        foreach ($purchase as $key => $value) {
            $totalpurchase = $totalpurchase + $value->total;
        }
        foreach ($expense as $key => $value) {
            $totalexpense = $totalexpense + $value->amount;
        }
        foreach ($recive as $key => $value) {
            $totalrecive = $totalrecive + $value->amount;
        }

        $sevenmonth = Carbon::now()->modify('-7 months')->format('M');
        $sixmonth = Carbon::now()->modify('-6 months')->format('M');
        $fivemonth = Carbon::now()->modify('-5 months')->format('M');
        $fourmonth = Carbon::now()->modify('-4 months')->format('M');
        $threemonth = Carbon::now()->modify('-3 months')->format('M');
        $twomonth = Carbon::now()->modify('-2 months')->format('M');
        $onemonth = Carbon::now()->modify('-1 months')->format('M');
        $presentmonth = Carbon::now()->format('M');

        $sevenmonths = Carbon::now()->modify('-7 months')->format('Y-m');
        $sixmonths = Carbon::now()->modify('-6 months')->format('Y-m');
        $fivemonths = Carbon::now()->modify('-5 months')->format('Y-m');
        $fourmonths = Carbon::now()->modify('-4 months')->format('Y-m');
        $threemonths = Carbon::now()->modify('-3 months')->format('Y-m');
        $twomonths = Carbon::now()->modify('-2 months')->format('Y-m');
        $onemonths = Carbon::now()->modify('-1 months')->format('Y-m');
        $presentmonths = Carbon::now()->format('Y-m');

        $sevendata = Sale::where('date', 'LIKE', $sevenmonths . '%')->get();
        foreach ($sevendata as $key => $value) {
            $sevendatatotal = $sevendatatotal + $value->total;
        }
        $sixdata = Sale::where('date', 'LIKE', $sixmonths . '%')->get();
        foreach ($sixdata as $key => $value) {
            $sixdatatotal = $sixdatatotal + $value->total;
        }
        $fivedata = Sale::where('date', 'LIKE', $fivemonths . '%')->get();
        foreach ($fivedata as $key => $value) {
            $fivedatatotal = $fivedatatotal + $value->total;
        }
        $fourdata = Sale::where('date', 'LIKE', $fourmonths . '%')->get();
        foreach ($fourdata as $key => $value) {
            $fourdatatotal = $fourdatatotal + $value->total;
        }
        $threedata = Sale::where('date', 'LIKE', $threemonths . '%')->get();
        foreach ($threedata as $key => $value) {
            $threedatatotal = $threedatatotal + $value->total;
        }
        $twodata = Sale::where('date', 'LIKE', $twomonths . '%')->get();
        foreach ($twodata as $key => $value) {
            $twodatatotal = $twodatatotal + $value->total;
        }
        $onedata = Sale::where('date', 'LIKE', $onemonths . '%')->get();
        foreach ($onedata as $key => $value) {
            $onedatatotal = $onedatatotal + $value->total;
        }
        $presentdata = Sale::where('date', 'LIKE', $presentmonths . '%')->get();
        foreach ($presentdata as $key => $value) {
            $presentdatatotal = $presentdatatotal + $value->total;
        }

        $salemonthdata = Sale::select('*')->whereBetween('created_at', [Carbon::now()->subMonth(6), Carbon::now()])->get();

        return view('pages.dashboard.home', compact('sevenmonth', 'sixmonth',
            'fivemonth', 'fourmonth', 'threemonth', 'twomonth', 'onemonth', 'presentmonth', 'sevendatatotal',
            'sixdatatotal', 'fivedatatotal', 'fourdatatotal', 'threedatatotal','stock', 'twodatatotal', 'onedatatotal', 'presentdatatotal', 'salemonthdata', 'items', 'totalamount', 'bank', 'case', 'totalrecive', 'totalexpense', 'totalpurchase'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function salemonth($id)
    {
        if ($id == 'this_month') {
            $totalamount = 0;
            $totalrecive = 0;
            $thismonth = Carbon::now()->format('Y-m');
            $alldata = Sale::where('date', 'LIKE', $thismonth . '%')->get();
            $reciveamount = ReciveAmount::where('created_at', 'LIKE', $thismonth . '%')->get();
            foreach ($alldata as $key => $value) {
                $totalamount = $totalamount + $value->total;
            }
            foreach ($reciveamount as $key => $value) {
                $totalrecive = $totalrecive + $value->amount;
            }
            return json_encode(['recive' => $totalrecive, 'sale' => $totalamount]);

        } else if ($id == 'last_month') {
            $totalamount = 0;
            $totalrecive = 0;
            $lastmonth = Carbon::now()->modify('-1 months')->format('Y-m');
            $alldata = Sale::where('date', 'LIKE', $lastmonth . '%')->get();
            $reciveamount = ReciveAmount::where('created_at', 'LIKE', $lastmonth . '%')->get();
            foreach ($alldata as $key => $value) {
                $totalamount = $totalamount + $value->total;
            }
            foreach ($reciveamount as $key => $value) {
                $totalrecive = $totalrecive + $value->amount;
            }
            return json_encode(['recive' => $totalrecive, 'sale' => $totalamount]);

        } else if ($id == 'three_month') {
            $totalamount = 0;
            $totalrecive = 0;
            $lastform = Carbon::now()->format('Y-m-d');
            $lastto = Carbon::now()->modify('-3 months')->format('Y-m-d');
            $alldata = Sale::whereBetween('date', [$lastto, $lastform])->get();
            $reciveamount = ReciveAmount::whereBetween('created_at', [$lastto, $lastform])->get();
            foreach ($alldata as $key => $value) {
                $totalamount = $totalamount + $value->total;
            }
            foreach ($reciveamount as $key => $value) {
                $totalrecive = $totalrecive + $value->amount;
            }
            return json_encode(['recive' => $totalrecive, 'sale' => $totalamount]);

        } else if ($id == 'pre_year') {
            $totalamount = 0;
            $totalrecive = 0;
            $preyear = Carbon::now()->modify('-1 year')->format('Y');
            $alldata = Sale::where('date', 'LIKE', $preyear . '%')->get();
            $reciveamount = ReciveAmount::where('created_at', 'LIKE', $preyear . '%')->get();
            foreach ($alldata as $key => $value) {
                $totalamount = $totalamount + $value->total;
            }
            foreach ($reciveamount as $key => $value) {
                $totalrecive = $totalrecive + $value->amount;
            }
            return json_encode(['recive' => $totalrecive, 'sale' => $totalamount]);

        } else {
            $totalamount = 0;
            $totalrecive = 0;
            $alldata = Sale::with('client')->get();
            $reciveamount = ReciveAmount::all();
            foreach ($alldata as $key => $value) {
                $totalamount = $totalamount + $value->total;
            }
            foreach ($reciveamount as $key => $value) {
                $totalrecive = $totalrecive + $value->amount;
            }
            return json_encode(['recive' => $totalrecive, 'sale' => $totalamount]);
        }

    }

    public function expensemonth($id)
    {
        if ($id == 'this_month') {
            $totalamount = 0;
            $thismonth = Carbon::now()->format('Y-m');
            $alldata = Expense::where('date', 'LIKE', $thismonth . '%')->get();
            foreach ($alldata as $key => $value) {
                $totalamount = $totalamount + $value->amount;
            }
            return json_encode($totalamount);

        } else if ($id == 'last_month') {
            $totalamount = 0;
            $lastmonth = Carbon::now()->modify('-1 months')->format('Y-m');
            $alldata = Expense::where('date', 'LIKE', $lastmonth . '%')->get();
            foreach ($alldata as $key => $value) {
                $totalamount = $totalamount + $value->amount;
            }
            return json_encode($totalamount);

        } else if ($id == 'three_month') {
            $totalamount = 0;
            $lastform = Carbon::now()->format('Y-m-d');
            $lastto = Carbon::now()->modify('-3 months')->format('Y-m-d');
            $alldata = Expense::whereBetween('date', [$lastto, $lastform])->get();
            foreach ($alldata as $key => $value) {
                $totalamount = $totalamount + $value->amount;
            }
            return json_encode($totalamount);

        } else if ($id == 'pre_year') {
            $totalamount = 0;
            $preyear = Carbon::now()->modify('-1 year')->format('Y');
            $alldata = Expense::where('date', 'LIKE', $preyear . '%')->get();
            foreach ($alldata as $key => $value) {
                $totalamount = $totalamount + $value->amount;
            }
            return json_encode($totalamount);

        } else {
            $totalamount = 0;
            $alldata = Expense::all();
            foreach ($alldata as $key => $value) {
                $totalamount = $totalamount + $value->amount;
            }
            return json_encode($totalamount);
        }

    }

    public function purchasemonth($id)
    {
        if ($id == 'this_month') {
            $totalpurchase = 0;
            $thismonth = Carbon::now()->format('Y-m');
            $alldata = Purchase::where('date', 'LIKE', $thismonth . '%')->get();
            foreach ($alldata as $key => $item) {
                $totalpurchase = $totalpurchase + $item->total;
            }
            return json_encode($totalpurchase);

        } else if ($id == 'last_month') {
            $totalpurchase = 0;
            $lastmonth = Carbon::now()->modify('-1 months')->format('Y-m');
            $alldata = Purchase::where('date', 'LIKE', $lastmonth . '%')->get();
            foreach ($alldata as $key => $item) {
                $totalpurchase = $totalpurchase + $item->total;
            }
            return json_encode($totalpurchase);

        } else if ($id == 'three_month') {
            $totalpurchase = 0;
            $lastform = Carbon::now()->format('Y-m-d');
            $lastto = Carbon::now()->modify('-3 months')->format('Y-m-d');
            $alldata = Purchase::whereBetween('date', [$lastto, $lastform])->get();
            foreach ($alldata as $key => $item) {
                $totalpurchase = $totalpurchase + $item->total;
            }
            return json_encode($totalpurchase);

        } else if ($id == 'pre_year') {
            $totalpurchase = 0;
            $preyear = Carbon::now()->modify('-1 year')->format('Y');
            $alldata = Purchase::where('date', 'LIKE', $preyear . '%')->get();
            foreach ($alldata as $key => $item) {
                $totalpurchase = $totalpurchase + $item->total;
            }
            return json_encode($totalpurchase);

        } else {
            $totalpurchase = 0;
            $alldata = Purchase::with('client')->get();
            foreach ($alldata as $key => $item) {
                $totalpurchase = $totalpurchase + $item->total;
            }
            return json_encode($totalpurchase);
        }

    }

    public function recive($id)
    {
        if ($id == 'this_month') {
            $totalrecive = 0;
            $thismonth = Carbon::now()->format('Y-m');
            $reciveamount = ReciveAmount::where('created_at', 'LIKE', $thismonth . '%')->get();
            foreach ($reciveamount as $key => $value) {
                $totalrecive = $totalrecive + $value->amount;
            }
            return json_encode($totalrecive);

        } else if ($id == 'last_month') {
            $totalrecive = 0;
            $lastmonth = Carbon::now()->modify('-1 months')->format('Y-m');
            $reciveamount = ReciveAmount::where('created_at', 'LIKE', $lastmonth . '%')->get();

            foreach ($reciveamount as $key => $value) {
                $totalrecive = $totalrecive + $value->amount;
            }
            return json_encode($totalrecive);

        } else if ($id == 'three_month') {
            $totalrecive = 0;
            $lastform = Carbon::now()->format('Y-m-d');
            $lastto = Carbon::now()->modify('-3 months')->format('Y-m-d');
            $reciveamount = ReciveAmount::whereBetween('created_at', [$lastto, $lastform])->get();

            foreach ($reciveamount as $key => $value) {
                $totalrecive = $totalrecive + $value->amount;
            }
            return json_encode($totalrecive);

        } else if ($id == 'pre_year') {
            $totalrecive = 0;
            $preyear = Carbon::now()->modify('-1 year')->format('Y');
            $reciveamount = ReciveAmount::where('created_at', 'LIKE', $preyear . '%')->get();

            foreach ($reciveamount as $key => $value) {
                $totalrecive = $totalrecive + $value->amount;
            }
            return json_encode($totalrecive);

        } else {
            $totalamount = 0;
            $totalrecive = 0;
            $reciveamount = ReciveAmount::all();
            foreach ($reciveamount as $key => $value) {
                $totalrecive = $totalrecive + $value->amount;
            }
            return json_encode($totalrecive);
        }

    }

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
