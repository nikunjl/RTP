<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karat;
use Validator;

class KaratController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:karat-list|karat-create|karat-edit|karat-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:karat-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:karat-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:karat-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Manage Karat | ' . env('APP_NAME');
        $karat = Karat::all();
        return view('admin.karat.index', compact('title', 'karat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Karat | ' . env('APP_NAME');
        return view('admin.karat.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name'   => 'required|unique:karats,name',
        ]);

        $category = new Karat();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('karat.index')->with('success', 'Record created!.');;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Karat | ' . env('APP_NAME');
        $karat = Karat::find($id);
        return view('admin.karat.edit', compact('karat', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $request->validate([
            'name'   => 'required|unique:karats,name,' . $id,
        ]);


        $category = Karat::find($id);
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('karat.index')->with('success', 'Record updated!.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Karat::find($id)->delete();
        return redirect()->route('karat.index')->with('success', 'Record deleted!.');;
    }
}
