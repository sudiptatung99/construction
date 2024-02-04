<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = Category::all();
        return view('pages.category.view', compact('client'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.category.category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories',
        ]);
        $data = new Category;
        $data->name = $request->name;
        $data->save();
        toastr()->success('New Category has beeen Added','sucess');
        return redirect('/category');
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
        $categoryData = Category::find($id);
        return view('pages.category.edit', compact('categoryData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { $validatedData = $request->validate([
        'name' => 'required|unique:categories',
    ]);
        $categoryUpdate = Category::find($id);
        $categoryUpdate->name = $request->name;
        $categoryUpdate->save();
        toastr()->success('Your Category has been updated','sucess');
        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);
        toastr()->success('Category has been deleted successfully!','Sucess',);
        return redirect('/category');
    }
}
