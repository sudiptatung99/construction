<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expense = Expense::all();
        return view('pages.expenses.view', compact('expense'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.expenses.expense');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'expense' => ['required'],
            'amount' => ['required'],
            'pay_status'=>['required'],
            'pay_whome'=>['required'],
            'pay_mode' => ['required'],
            'details' => ['required'],
            'date' => ['required'],
        ]);
        $fileName = null;
        if ($request->image) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $fileName);
        }
        $data = new Expense;
        $data->expense = $request->expense;
        $data->amount = $request->amount;
        $data->pay_mode = $request->pay_mode;
        $data->pay_status = $request->pay_status;
        $data->pay_whome = $request->pay_whome;
        $data->details = $request->details;
        $data->date = $request->date;
        $data->image = $fileName;
        $data->save();
        toastr()->success('New Expense Data has beeen Added', 'sucess');
        return redirect('/expense');
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
        $id = decrypt($id);
        $expense = Expense::find($id);
        return view('pages.expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = decrypt($id);
        $validatedData = $request->validate([
            'expense' => ['required'],
            'amount' => ['required'],
            'pay_mode' => ['required'],
			'pay_whome'=>['required'],
            'pay_status'=>['required'],
            'details' => ['required'],
            'date' => ['required'],
        ]);  
        $expense = Expense::find($id);
        if ($request->image) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            if ($expense->image) {
                unlink("images/" . $expense->image);
            }
            $expense->image = $fileName;
        }
        $expense->expense = $request->expense;
        $expense->amount = $request->amount;
        $expense->pay_mode = $request->pay_mode;
        $expense->pay_status = $request->pay_status;
		$expense->pay_whome = $request->pay_whome;
        $expense->details = $request->details;
        $expense->date = $request->date;
        $expense->save();
        toastr()->success('Your Expense Data has been updated', 'sucess');
        return redirect('/expense');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = decrypt($id);
        $expenseData = Expense::find($id);
        Expense::destroy($id);
        if ($expenseData->image) {
            unlink("images/" . $expenseData->image);
        }
        toastr()->success('Expense Data has been deleted successfully!', 'sucess');
        return redirect('/expense');
    }
}
