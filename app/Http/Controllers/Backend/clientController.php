<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = Client::all();
        return view('pages.client.view', compact('client'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.client.client');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'first_number' => ['required'],
            'address' => ['required'],
            'pin' => ['required'],
        ]);
        $data = new Client;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->first_number = $request->first_number;
        $data->second_number = $request->second_number;
        $data->address = $request->address;
        $data->pin = $request->pin;
        $data->save();
        toastr()->success('New Client has been Added', 'Sucess');
        return redirect('/client');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = decrypt($id);
        $clientData = Client::find($id);
        return view('pages.client.show', compact('clientData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = decrypt($id);
        $clientData = Client::find($id);
        return view('pages.client.edit', compact('clientData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        $id = decrypt($id);
        $validatedData = $request->validate([
        'name' => ['required'],
        'email' => ['required'],
        'first_number' => ['required'],
        'address' => ['required'],
        'pin' => ['required'],
    ]);
        $itemUpdate = Client::find($id);
        $itemUpdate->name = $request->name;
        $itemUpdate->email = $request->email;
        $itemUpdate->first_number = $request->first_number;
        $itemUpdate->second_number = $request->second_number;
        $itemUpdate->address = $request->address;
        $itemUpdate->pin = $request->pin;
        $itemUpdate->save();
        toastr()->success('Your Client has been updated', 'Sucess');
        return redirect('/client');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = decrypt($id);
        Client::destroy($id);
        toastr()->success('Client has been deleted successfully!', 'Sucess');
        return redirect('/client');
    }
}
