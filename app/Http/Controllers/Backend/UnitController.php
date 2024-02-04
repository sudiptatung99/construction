<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unit = Unit::all();
        return view('pages.unit.view', compact('unit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.unit.unit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:units',
        ]);
        $data = new Unit;
        $data->name = $request->name;
        $data->save();
        toastr()->success('New Measur Unit has beeen Added','sucess');
        return redirect('/unit');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $clientData = Client::find($id);
        // return view('pages.client.edit', compact('clientData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $unitData = Unit::find($id);
        return view('pages.unit.edit', compact('unitData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { $validatedData = $request->validate([
        'name' => 'required|unique:units',
    ]);
        $unitUpdate = Unit::find($id);
        $unitUpdate->name = $request->name;
        $unitUpdate->save();
        toastr()->success('Your Measur Unit has been updated','sucess');
        return redirect('/unit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Unit::destroy($id);
        toastr()->success('Measur Unit has been deleted successfully!','Sucess',);
        return redirect('/unit');
    }
}
