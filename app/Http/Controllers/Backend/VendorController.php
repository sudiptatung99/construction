<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendor = Vendor::all();
        return view('pages.vendor.view', compact('vendor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.vendor.vendor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'first_number' => 'required',
            'address' => 'required',
            'pin' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'first_number' => $request->first_number,
                'second_number' => $request->second_number,
                'address' => $request->address,
                'pin' => $request->pin,
            ];
            Vendor::create($data);
            DB::commit();
            toastr()->success('New Vendor has been Added', 'sucess');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
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
        $vendor = Vendor::find($id);
        return view('pages.vendor.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = decrypt($id);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'first_number' => 'required',
            'address' => 'required',
            'pin' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'first_number' => $request->first_number,
                'second_number' => $request->second_number,
                'address' => $request->address,
                'pin' => $request->pin,
            ];
            Vendor::find($id)->update($data);
            DB::commit();
            toastr()->success('New Vendor has been Updated', 'sucess');
            return redirect('/vendors');
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = decrypt($id);
        Vendor::destroy($id);
        toastr()->success('New Vendor has been Deleted', 'sucess');
        return back();
    }
}
