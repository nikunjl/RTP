<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Datewise;
use Validator;

class DatewiseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:datewise-list|datewise-create|datewise-edit|datewise-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:datewise-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:datewise-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:datewise-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Manage Datewise | ' . env('APP_NAME');
        $datewise = Datewise::get();
        return view('admin.datewise.index', compact('title', 'datewise'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Datewise | ' . env('APP_NAME');
        return view('admin.datewise.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'shift_id'   => 'required',
            'order_take'   => 'required',
            'shift_date'   => 'required',
        ]);

        $asd = Datewise::where('shift_id',$request->shift_id)->where('shift_date',$request->shift_date)->first();
        if(!empty($asd)) {
            return redirect()->back()->with('error','Same data already inserted');
        }
      
        $datewise = new Datewise();
        $datewise->shift_id = $request->shift_id;
        $datewise->shift_date = $request->shift_date;
        $datewise->order_take = $request->order_take;
        $datewise->status = $request->status;
        $datewise->save();

        return redirect()->route('datewise.index')->with('success', 'Record created!.');;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Datewise | ' . env('APP_NAME');
        $datewise = Datewise::find($id);
        return view('admin.datewise.edit', compact('datewise', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $request->validate([
            'shift_id'   => 'required',
            // 'order_take'   => 'required',
            'shift_date'   => 'required'
        ]);

        $asd = Datewise::where('shift_id',$request->shift_id)->where('shift_date',$request->shift_date)->first();
        if(isset($asd->id) && $asd->id != $id) {
            return redirect()->back()->with('error','Same data already inserted');
        }
        
        $datewise = Datewise::find($id);
        $datewise->shift_id = $request->shift_id;
        $datewise->shift_date = $request->shift_date;
        $datewise->order_take = $request->order_take;
        $datewise->status = $request->status;
        $datewise->save();

        return redirect()->route('datewise.index')->with('success', 'Record updated!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datewise = Datewise::find($id)->delete();
        return redirect()->route('datewise.index')->with('success', 'Record deleted!.');
    }
}
