<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = Item::with('unit','category')->get();
        return view('pages.items.view', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.items.itemes');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'unit_id' => ['required'],
            'category_id' => ['required'],
        ]);
        $fileName = null;
        if ($request->image) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $fileName);
        }
        $data = new Item;
        $data->name = $request->name;
        $data->unit_id = $request->unit_id;
        $data->category_id = $request->category_id;
        $data->image = $fileName;
        $data->save();
        toastr()->success('New Item has been Added','sucess');
        return redirect('/items');
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
        $itemData = Item::find($id);
        return view('pages.items.edit', compact('itemData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'unit_id' => ['required'],
            'category_id' => ['required'],
        ]);
        $itemUpdate = Item::find($id);
        if ($request->image) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            if ($itemUpdate->image) {
                unlink("images/" . $itemUpdate->image);
            }
            $itemUpdate->image = $fileName;
        }
        $itemUpdate->name = $request->name;
        $itemUpdate->unit_id = $request->unit_id;
        $itemUpdate->category_id = $request->category_id;
        $itemUpdate->save();
        toastr()->success('Your item has been updated','sucess');
        return redirect('/items');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        Item::destroy($id);
        if ($item->image) {
            unlink("images/" . $item->image);
        }
        toastr()->success('Items has been deleted successfully!','sucess');
        return redirect('/items');
    }
}
