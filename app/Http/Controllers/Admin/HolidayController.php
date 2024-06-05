<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Holiday;
use Validator;

class HolidayController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:holiday-list|holiday-create|holiday-edit|holiday-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:holiday-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:holiday-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:holiday-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Manage Holiday | ' . env('APP_NAME');
        $holiday = Holiday::get();
        return view('admin.holiday.index', compact('title', 'holiday'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Holiday | ' . env('APP_NAME');
        return view('admin.holiday.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name'   => 'required|unique:categories,name',
        ]);

      
        $holiday = new Holiday();
        $holiday->name = $request->name;
        $holiday->holiday_date = $request->holiday_date;
        $holiday->status = $request->status;
        $holiday->save();

        return redirect()->route('holiday.index')->with('success', 'Record created!.');;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Holiday | ' . env('APP_NAME');
        $holiday = Holiday::find($id);
        return view('admin.holiday.edit', compact('holiday', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $request->validate([
            'name'   => 'required'
        ]);
        
        $holiday = Holiday::find($id);
        $holiday->name = $request->name;
        $holiday->holiday_date = $request->holiday_date;
        $holiday->status = $request->status;
        $holiday->save();

        return redirect()->route('holiday.index')->with('success', 'Record updated!.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $holiday = Holiday::find($id)->delete();
        return redirect()->route('holiday.index')->with('success', 'Record deleted!.');;
    }
}
