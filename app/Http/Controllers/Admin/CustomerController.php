<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logs;
use App\Models\Role;

class CustomerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:customer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Manage Customer | ' . env('APP_NAME');
        $customer = User::where('role',4)->orderby('id','DESC')->get();
        return view('admin.customer.index', compact('title', 'customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Customer | ' . env('APP_NAME');
        return view('admin.customer.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validator = $request->validate([
        //     'name'   => 'required|unique:categories,name',
        //     'description' => 'required',
        //     'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        // ]);

        // $fileName = time() . '.' . $request->image->extension();
        // $request->image->move(public_path('category'), $fileName);

        // $category = new User();
        // $category->name = $request->name;
        // $category->img = $fileName;
        // $category->description = $request->description;
        // $category->parent_category = $request->parent_category;
        // $category->status = $request->status;
        // $category->save();

        // return redirect()->route('categorys.index')->with('success', 'Record created!.');;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Customer | ' . env('APP_NAME');
        $customer = User::find($id);
        $rols = Role::all();
        return view('admin.customer.edit', compact('customer', 'title','rols'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // echo $id;exit;
        $validator = $request->validate([
            'name'   => 'required',
            // 'role' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile_no' => 'required'
        ]);
// dd($request->all());
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 4;//$request->role;
        $user->gender = $request->gender;
        $user->mobile_no = $request->mobile_no;
        $user->gst_number = $request->gst_number;
        $user->pan_number = $request->pan_number;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('customer.index')->with('success', 'Record updated!.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = User::find($id)->delete();
        Logs::where('user_id',$id)->delete();
        return redirect()->route('customer.index')->with('success', 'Record deleted!.');;
    }

    public function customerlogin()
    {
        $title = 'Customer Login Location | ' . env('APP_NAME');
        if(\Auth::user()->role != 1) {
            $customer = Logs::select('logs.*','users.name')
                ->leftJoin('users','users.id','logs.user_id')
                ->where('logs.user_id',\Auth::user()->id)
                ->orderby('logs.id','DESC')
                ->get();
        } else {
            $customer = Logs::select('logs.*','users.name')
                ->leftJoin('users','users.id','logs.user_id')
                ->orderby('logs.id','DESC')
                ->get();
        }
        return view('admin.customer.location', compact('title', 'customer'));
    }

    public function customerAccess(Request $request)
    {
        $title = 'Customer Access | ' . env('APP_NAME');
        if(!empty($request->id)) {
            User::where('id',$request->id)->update(['grant_access' => 1]);
        }
        $customer = User::where('grant_access',2)->get();
        return view('admin.customer.requestaccess', compact('title', 'customer'));
    }

    public function customerAccessReq($id)
    {
        $title = 'Customer Access | ' . env('APP_NAME');
        $customer = User::find($id)->update(['grant_access' => 1]);
        return view('admin.customer.location', compact('title', 'customer'));
    }
}
