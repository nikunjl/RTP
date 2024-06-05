<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Validator;

class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:order-list|order-create|order-edit|order-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:order-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:order-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:order-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Manage Order | ' . env('APP_NAME');
        if(\Auth::user()->role != 1) {
            $order = Order::where('user_id',\Auth::user()->id)->get();
        } else {
            $order = Order::get();
        }
        return view('admin.order.index', compact('title', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Order | ' . env('APP_NAME');
        return view('admin.order.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name'   => 'required|unique:categories,name',
        ]);

      
        $order = new Order();
        $order->name = $request->name;
        $order->order_date = $request->order_date;
        $order->status = $request->status;
        $order->save();

        return redirect()->route('order.index')->with('success', 'Record created!.');;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Order | ' . env('APP_NAME');
        $order = Order::find($id);
        return view('admin.order.edit', compact('order', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $request->validate([
            'name'   => 'required'
        ]);
        
        $order = Order::find($id);
        $order->name = $request->name;
        $order->order_date = $request->order_date;
        $order->status = $request->status;
        $order->save();

        return redirect()->route('order.index')->with('success', 'Record updated!.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::find($id)->delete();
        return redirect()->route('order.index')->with('success', 'Record deleted!.');;
    }

     /**
     * Show the form for editing the specified resource.
     */
    public function orderdetail($id)
    {
        $title = 'Order Detail | ' . env('APP_NAME');
        $order = Order::where('id',$id)->first();
        $userDetail = User::where('id',$order->user_id)->first();
        $OrderDetail = OrderDetail::select('order_details.*','products.name as product','karats.name as karat_name','sizes.name as size_name')
        ->where('order_details.order_id',$id)
        ->leftjoin('products','products.id','order_details.product_id')
        ->leftjoin('karats','karats.id','order_details.karat_id')
        ->leftjoin('sizes','sizes.id','order_details.size_id')
        ->get();
        // dd($order);
        return view('admin.order.detail', compact('order', 'title','OrderDetail','userDetail'));
    }
}
