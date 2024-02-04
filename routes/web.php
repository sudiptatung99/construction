<?php

use App\Http\Controllers\Backend\CaseBankController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\clientController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\ItemsController;
use App\Http\Controllers\Backend\PartiesController;
use App\Http\Controllers\Backend\PurchaseController;
use App\Http\Controllers\Backend\PurchaseItemController;
use App\Http\Controllers\Backend\SaleController;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReportPartiesController;
use App\Http\Controllers\Backend\ReturnFormPartiesController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\User\MailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', [MailController::class,'index'])->name('home');
Route::post('/contract', [MailController::class,'mail_send'])->name('contract');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/change-pass', function () {
        return view('pages.profiles.changepassword');
    })->name('change-pass');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::resource('dashboard', HomeController::class);

    Route::get('dashboard', [HomeController::class,'index'])->name('dashboard');
    Route::get('/salesadboard/{id}', [HomeController::class,'salemonth'])->name('salesadboard');
    Route::get('/expenseboard/{id}', [HomeController::class,'expensemonth'])->name('expenseboard');
    Route::get('/purchaseboard/{id}', [HomeController::class,'purchasemonth'])->name('purchaseboard');
    Route::get('/reciveabord/{id}', [HomeController::class,'recive'])->name('reciveabord');


    // Route::resource('parties', PartiesController::class);
    Route::get('/parties', [PartiesController::class,'no_id'])->name('parties');
    Route::get('/parties/{id}', [PartiesController::class, 'view'])->name('parties');
    Route::post('/parties/{id}', [PartiesController::class, 'addamount'])->name('parties');
    Route::get('/parties/editamount/{id}', [PartiesController::class, 'editamount'])->name('parties.edit-amount');
    Route::put('/parties/update-amount/{id}', [PartiesController::class, 'updateamount'])->name('parties.update-amount');
    Route::delete('/parties/delete-amount/{id}', [PartiesController::class, 'deleteamount'])->name('parties.delete-amount');

    Route::resource('items', ItemsController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('client', clientController::class);

    Route::resource('vendors', VendorController::class);

    //sale
    // Route::resource('sale', SaleController::class);
    Route::get('sale', [SaleController::class, 'index'])->name('sale');
    Route::get('sale/creates/{id}', [SaleController::class, 'createid'])->name('sale.creates');
    Route::get('sale/create', [SaleController::class, 'create'])->name('sale.create');
    Route::post('sale/create', [SaleController::class, 'store'])->name('sale.store');
    Route::get('sale/edit/{id}', [SaleController::class, 'edit'])->name('sale.edit');
    Route::put('sale/edit/{id}', [SaleController::class, 'update'])->name('sale.update');
    Route::get('sale/show/{id}', [SaleController::class, 'show'])->name('sale.show');
    Route::delete('sale/delete/{id}', [SaleController::class, 'destroy'])->name('sale.destory');

    //expense
    Route::get('expense', [ExpenseController::class, 'index'])->name('expense');
    Route::get('expense/create', [ExpenseController::class, 'create'])->name('expense.create');
    Route::post('expense/create', [ExpenseController::class, 'store'])->name('expense.store');
    Route::get('expense/edit/{id}', [ExpenseController::class, 'edit'])->name('expense.edit');
    Route::put('expense/edit/{id}', [ExpenseController::class, 'update'])->name('expense.update');
    Route::delete('expense/delete/{id}', [ExpenseController::class, 'destroy'])->name('expense.destory');

    //purchase
    Route::resource('purchase', PurchaseController::class);
    Route::get('purchase/item/view/{id}', [PurchaseItemController::class, 'index'])->name('purchase.item.view');
    Route::post('purchase/item/unit', [PurchaseItemController::class, 'unit'])->name('purchase.item.unit');
    
    Route::get('payment/{id}', [PurchaseItemController::class, 'payment'])->name('payment');
    Route::post('payment/create/{id}', [PurchaseItemController::class, 'AddPayment'])->name('payment.create');

    // case&bank
    Route::get('/bank/{id}', [CaseBankController::class, 'bank'])->name('bank');
    Route::get('/bank', [CaseBankController::class, 'bank_wihoutid'])->name('empty-bank');
    Route::post('add-bank', [CaseBankController::class, 'addbank'])->name('add-bank');
    Route::post('bank/post/{id}', [CaseBankController::class, 'addbankamount'])->name('bank.post');
    Route::post('bank/remove/post/{id}', [CaseBankController::class, 'removebankamount'])->name('bank.remove.post');

    Route::post('case/post', [CaseBankController::class, 'addamount'])->name('case.post');
    Route::post('case/remove/post/{id}', [CaseBankController::class, 'removeamount'])->name('case.remove.post');
    Route::get('case/delete/{id}', [CaseBankController::class, 'deleteAmount'])->name('case.delete');
    Route::get('case', [CaseBankController::class, 'case'])->name('case');
    
    // Route::resource('return-parties', ReturnFormPartiesController::class);
    Route::get('return-items/{id}', [ReturnFormPartiesController::class,'show'])->name('return-items');
    Route::get('return-items/create/{id}', [ReturnFormPartiesController::class,'create'])->name('return-items.create');
    Route::post('return-items/create/{id}', [ReturnFormPartiesController::class,'store'])->name('return-items.create');
    Route::get('return-items/edit/{id}', [ReturnFormPartiesController::class,'edit'])->name('return-items.edit');
    Route::post('return-items/edit/{id}', [ReturnFormPartiesController::class,'update'])->name('return-items.edit');
    Route::delete('return-items/delete/{id}', [ReturnFormPartiesController::class,'destroy'])->name('return-items.delete');
    Route::post('sale-items', [ReturnFormPartiesController::class,'return'])->name('sale-items');

    Route::get('generate-pdf', [PartiesController::class, 'generatePDF'])->name('generate-pdf');

    //report
    Route::group(['prefix'=>'report','as'=>'report.'],function () {

        Route::get('sale', [ReportController::class, 'sale'])->name('sale');
        Route::get('sales/{id}', [ReportController::class, 'salefilter'])->name('sales');
        Route::post('sales/between', [ReportController::class, 'between'])->name('sales.between');

        Route::get('recive-amount', [ReportController::class, 'reciveAmount'])->name('recive-amount');
        Route::post('recive-amount/between', [ReportController::class, 'reciveAmountBetween'])->name('recive-amount.between');

        Route::get('advance-amount', [ReportController::class, 'reciveAdvanceAmount'])->name('advance-amount');
        Route::post('advance-amount/between', [ReportController::class, 'reciveAdvanceAmountBetween'])->name('advance-amount.between');

        Route::get('purchase', [ReportController::class, 'purchase'])->name('purchase');
        Route::get('purchases/{id}', [ReportController::class, 'searchpurchase'])->name('purchases');
        Route::post('purchase/between', [ReportController::class, 'purchasebetween'])->name('purchase.between');
        
        Route::get('expense', [ReportController::class, 'expense'])->name('expense');
        Route::post('expense/between', [ReportController::class, 'expenseBetween'])->name('expense.between');

        Route::get('daybook', [ReportController::class, 'daybook'])->name('daybook');



        Route::get('transation', [ReportController::class, 'transation'])->name('transation');
        // Route::get('transations/{id}', [ReportController::class, 'transationfilter'])->name('transations');
        // Route::post('transations/between', [ReportController::class, 'transationbetween'])->name('transations.between');


        Route::get('profit-loss', [ReportController::class, 'profit_loss'])->name('profit-loss');

        Route::get('year/profit', [ReportController::class, 'year_profit'])->name('year.profit');
        Route::get('year/profit/{id}', [ReportController::class, 'year_profit_search'])->name('year.profit.search');

        Route::get('bill-profit', [ReportController::class, 'bill_profit'])->name('bill-profit');
        Route::post('bill-profit/between', [ReportController::class, 'bill_profit_between'])->name('bill-profit.between');

        Route::get('balance-sheet', [ReportController::class, 'balance_sheet'])->name('balance-sheet');
        Route::get('balance-sheet/{id}', [ReportController::class, 'balance_sheet_search'])->name('balance-sheet.search');
        Route::get('case-flow', [ReportController::class, 'case_flow'])->name('case-flow ');



        Route::get('parties-profit', [ReportPartiesController::class, 'partyprofit'])->name('parties-profit');
        Route::post('parties-profit/search', [ReportPartiesController::class, 'party_profit_search'])->name('parties-profit.search');
        Route::get('statement', [ReportPartiesController::class, 'statement'])->name('statement ');




    });


    Route::fallback(function(){
        return "<h1>Page Not Found</h1>";
    });
    
});


require __DIR__ . '/auth.php';
