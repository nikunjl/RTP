<?php







namespace App\Http\Controllers\Admin;







use App\Http\Controllers\Controller;



use Illuminate\Http\Request;



use App\Models\User;

use App\Models\Category;

use App\Models\Product;

use App\Models\Order;



use Hash;



use Auth;



use DB;







class DashboardController extends Controller



{



    public function index()

    {



        $title = 'Manage Dashboard | ' . env('APP_NAME');

        $totalCate =  Category::count();
        $totalCustomer =  User::where('role',4)->count();
        $totalProduct =  Product::count();
        $totalOrder =  Order::count();
        $totalOrderToday =  Order::where('created_at', ">", \Carbon\Carbon::now()->format('Y-m-d'))->count();
        $totalgrantaccess =  User::where('grant_access',2)->count();



        return view('admin.dashboard', compact('title','totalCate','totalProduct','totalOrder','totalOrderToday','totalgrantaccess','totalCustomer'));

    }







    public function profile_details()



    {



        $title = 'Manage Profile | ' . env('APP_NAME');



        return view('admin.profile', compact('title'));

    }



    public function profile_update(Request $request)



    {



        $this->validate($request, [



            'name' => 'required',



        ]);







        if ($request->password != '' && $request->new_password != '') {



            if (Hash::check($request->password, Auth::user()->password)) {



                $data_update['password'] = bcrypt($request->new_password);

            } else {



                return redirect()->route('admin.profile')->with('error', 'Currant password not match..!');

            }

        }



        $user_id = Auth::user()->id;



        $data_update['name'] = isset($request->name) ? $request->name : Auth::user()->name;



        User::where('id', $user_id)->update($data_update);







        return redirect()->route('admin.profile')->with('success', 'Profile detail update successfully.');

    }







    public function cron()

    {



        \Artisan::call('database:backup');

    }

}

