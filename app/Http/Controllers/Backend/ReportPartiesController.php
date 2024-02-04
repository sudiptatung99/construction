<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

// use Carbon\Carbon;

class ReportPartiesController extends Controller
{
    public function partyprofit()
    {
        $client = Client::with('sale', 'reciver')->latest()->get();
        return view('pages.reports.party.profitloss', compact('client'));
    }
    public function party_profit_search(Request $request)
    {

        $client = Client::with('sale', 'reciver')->latest()->get();
        return view('pages.reports.party.profitloss', compact('client'));
    }

    public function statement()
    {
        $client = Client::with('sale', 'reciver')->latest()->get();
        return view('pages.reports.party.statement', compact('client'));
    }
}
