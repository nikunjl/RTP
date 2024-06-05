<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use Validator;

class GroupsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Manage Group | ' . env('APP_NAME');
        $group = Group::get();
        return view('admin.group.index', compact('title', 'group'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Group | ' . env('APP_NAME');
        return view('admin.group.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    	// dd($request->all());
        $validator = $request->validate([
            'name'   => 'required|unique:product_groups,name',
        ]);

      	// $name = !empty($request->name) ? count($request->name) : 0;
      	// if(!empty($name)) {
      	// 	for($i=0;$i<$name;$i++) {
// dd((array)$request->product_code);
            $checkcode = Group::select('product_code')->get()->toArray();
            if(!empty($checkcode)) {
              $finalarrary = explode(",",implode(",",array_column($checkcode, 'product_code')));
              // dd($finalarrary);
              $ccc = (array)$request->product_code;
              // dd());
              $isduplicate = false;
              foreach ($finalarrary as $key => $value) {
                if(in_array($value, explode(",", $ccc[0]))) {
                  $isduplicate = true;
                }
              }
            }

            if($isduplicate == false) {
  		        $group = new Group();
  		        $group->name = $request->name ?? 0;
              $group->product_code = $request->product_code ?? 0;
  		        $group->save();
            } else {
              return redirect()->back()->with('error', 'product code is already in database');;
            }
      		// }
      	// }

        return redirect()->route('groups.index')->with('success', 'Record created!.');;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Group | ' . env('APP_NAME');
        $group = Group::find($id);
        return view('admin.group.edit', compact('group', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $request->validate([

            'name'   => 'required|unique:product_groups,name,'.$id,

        ]);

          $isduplicate = false;
          // $checkcode = Group::select('product_code')->whereNotIN('product_codes',explode(",", $request->product_code))->get()->toArray();
          $checkcode = \DB::select('select count(*) as count from `product_groups` where `product_code` IN ('.$request->product_code.') and `id` <> '.$id.'');
          if(($checkcode[0]->count) > 0) {
            $isduplicate = true;
          }
// dd($isduplicate);
        if($isduplicate == false) {        
          $group = Group::find($id);
          $group->name = $request->name ?? 0;
          $group->product_code = $request->product_code ?? 0;
          $group->save();
        } else {
          return redirect()->back()->with('error', 'product code is already in database');;
        }

        return redirect()->route('groups.index')->with('success', 'Record updated!.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $group = Group::find($id)->delete();
        return redirect()->route('groups.index')->with('success', 'Record deleted!.');;
    }
}
