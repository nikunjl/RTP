<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use Validator;

class SizeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:size-list|size-create|size-edit|size-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:size-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:size-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:size-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Manage Size | ' . env('APP_NAME');
        $size = Size::all();
        return view('admin.size.index', compact('title', 'size'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Size | ' . env('APP_NAME');
        return view('admin.size.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name'   => 'required|unique:sizes,name',
        ]);

        $category = new Size();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('sizes.index')->with('success', 'Record created!.');;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Size | ' . env('APP_NAME');
        $size = Size::find($id);
        return view('admin.size.edit', compact('size', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $request->validate([
            'name'   => 'required|unique:sizes,name,' . $id,
        ]);


        $category = Size::find($id);
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('sizes.index')->with('success', 'Record updated!.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Size::find($id)->delete();
        return redirect()->route('sizes.index')->with('success', 'Record deleted!.');;
    }
}
