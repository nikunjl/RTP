<?php



namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Logs;
use App\Models\User;
use App\Models\ProductImage;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Addtocart;
use App\Models\Datewise;
use App\Models\Holiday;
use App\Models\Product;
use App\Models\Group;
use App\Models\Size;
use App\Models\Karat;
use App\Models\Material;
use App\Models\Notification;
use Validator;
use Hash;



class UserController extends Controller

{
    
     public function loginWithPassword(Request $request) {

    	

    	$validator = Validator::make($request->all(), [

            // 'name'  => 'required|string',

            'email'  => 'required',
            'password'  => 'required',

        ]);



        if ($validator->fails()) {

            return response()->json($validator->errors()->toJson(), 400);

        }



        $user = User::where('email',$request->email)->first();



        if(!empty($user)) {
            
            if (!Hash::check($request->password, $user->password)) {
        	    return response()->json([

                    'success' => true,
    
                    'token' => [],
    
                    'msg' => "Password is not match!",

                ]);
            }

        	$data['token'] = $user->createToken('RTPAPP')->plainTextToken;

			$data['user_data'] = $user;



        	return response()->json([

                'success' => true,

                'token' => $data,

                'msg' => "Login successfull",

            ]);

        }

        else

        {

            // $user = User::create([

            //     'name' => $request->name,

            //     'email' => $request->email,

            //     'photo' => $request->photo,

            //     'role' => 4

            // ]);



            // $data['token'] = $user->createToken('RTPAPP')->plainTextToken;

            // $data['user_data'] = $user;



            return response()->json([

                'success' => true,

                'token' => [],

                'msg' => "Email is not exist in database",

            ]);

        }



    }

    public function getLoginData(Request $request) {

    	

    	$validator = Validator::make($request->all(), [

            'name'  => 'required|string',

            'email'  => 'required',

        ]);



        if ($validator->fails()) {

            return response()->json($validator->errors()->toJson(), 400);

        }



        $user = User::where('name','=', $request->name)->where('email',$request->email)->first();



        if(!empty($user)) {

        	$data['token'] = $user->createToken('RTPAPP')->plainTextToken;

			$data['user_data'] = $user;



        	return response()->json([

                'success' => true,

                'token' => $data,

                'msg' => "Login successfull",

            ]);

        }

        else

        {

            $user = User::create([

                'name' => $request->name,

                'email' => $request->email,

                'photo' => $request->photo,

                'role' => 4

            ]);



            $data['token'] = $user->createToken('RTPAPP')->plainTextToken;

            $data['user_data'] = $user;



            return response()->json([

                'success' => true,

                'token' => $data,

                'msg' => "Login successfully.",

            ]);

        }



    }



    public function checkFlag(Request $request) {

        $user = User::where('id','=', $request->id)->first();

        $datass = User::find($request->id);
        $datass->notification_token = $request->notification_token;
        $datass->save();

        $data['isvalid'] = false;

        if(!empty($user['mobile_no']) && !empty($user['city']) && !empty($user['state'])) {

            $data['isvalid'] = true;

        }

        $data['grantaccess'] = false;
        if($user['grant_access'] == 1) {

            $data['grantaccess'] = true;

        }



        $logs = new Logs();

        $logs->city_name = $request->city_name;

        $logs->user_id = $request->id;

        $logs->save();





        return response()->json([

            'success' => true,

            'data' => $data,

            'msg' => "Data retrived successfully.",

        ]);

    }



    public function acccessgrant(Request $request) {

        $user = User::where('id','=', $request->id)->first();

        if(!empty($user)) {

            $userd = User::where('id','=', $request->id)->update(['grant_access' => 2]);  

        }



        return response()->json([

            'success' => true,

            'data' => [],

            'msg' => "Request added successfully.",

        ]);

    }



    public function afterLoginUpdate(Request $request) {

        $validator = Validator::make($request->all(), [

            'mobile_no'  => 'required',

            'city'  => 'required',

            'state'  => 'required',

            // 'pan_number'  => 'required',

        ]);



        if ($validator->fails()) {

            return response()->json($validator->errors()->toJson(), 400);

        }



        $user = User::find($request->id);

        $user->mobile_no = $request->mobile_no;

        $user->address = $request->address;

        $user->city = $request->city;

        $user->state = $request->state;

        $user->pan_number = $request->pan_number;

        $user->gst_number = $request->gst_number;

        $user->role = 4;

        $user->save();



        return response()->json([

            'success' => true,

            'data' => [],

            'msg' => "Data Updated successfully.",

        ]);

    }



    public function dashboard(Request $request) {

        $category_data = [];

        $category = category::whereNull('parent_category')->get();

        $data['slider'] = Slider::all();

        if(!empty($category)) {

            $checkgrantAccess = User::where('id',$request->id)->first();

            

            foreach ($category as $key => $value) {



                if(isset($checkgrantAccess['grant_access']) && $checkgrantAccess['grant_access'] == 1){

                    $grantaccesscount = Product::where('normal_category',"2")->count();

                } else {

                    $cat_ids = Category::whereRaw('(id = '.$value->id.') OR (parent_category = '.$value->id.')')->groupby('id')->pluck('id');                    

                    $grantaccesscount = Product::where('normal_category',"1")->whereIn('category_id',$cat_ids)->count();

                }

                        

                $category_data[] = [

                    "id" => $value['id'],

                    "name" => $value['name'],

                    "img" => $value['img'],

                    "description" => $value['description'],

                    "parent_category" => $value['parent_category'],

                    "status" => $value['status'],

                    "deleted_at" => $value['deleted_at'],

                    "created_at" => $value['created_at'],

                    "updated_at" => $value['updated_at'],

                    'grantaccesscount' => $grantaccesscount

                ];

            }

        }

        $data['category'] = $category_data;





        return response()->json([

            'success' => true,

            'data' => $data,

            'msg' => "Data Updated successfully.",

        ]);

    }



    public function productListByCategoryId($id) {

        $product = Product::with('images')->where('category_id',$id)->get()->toArray();

        $data['product'] = [];
        if(!empty($product)) {

            foreach ($product as $key => $value) {

                $products[] = [

                    "id"=> $value['id'],

                    "name"=> $value['name'],

                    "image"=> $value['images']['name'] ?? '',

                    "code"=> $value['code'],

                    "description"=> $value['description'],

                    "karat_id"=> $value['karat_id'],

                    "size_id"=> $value['size_id'],

                    "pcs"=> $value['pcs'],

                    "gender"=> $value['gender'],

                    "category_id"=> $value['category_id'],

                    "sub_category_id"=> $value['sub_category_id'],

                    "gross"=> $value['gross'],

                    "net"=> $value['net'],

                    "stone"=> $value['stone'],

                    "normal_category"=> $value['normal_category'],

                    "show_actual_category"=> $value['show_actual_category'],

                    "status"=> $value['status'],

                    "deleted_at"=> $value['deleted_at'],

                    "created_at"=> $value['created_at'],

                    "updated_at"=> $value['updated_at'],

                ];

            }

        	$data['product'] = $products;
        }


        $data['subCategory'] = Category::where('parent_category',$id)->get();

        $data['karatlist'] = Karat::all();

        $data['sizelist'] = Size::all();

        $data['sorting'] = [

            'Latest First',

            'Oldest First',

            'Latest Last',

            'Oldest Last',

            'Gross Wt High to Low',

            'Gross Wt Low to High'

        ];

        $data['gender'] = [

            'Male',

            'Female',

            'Other'

        ];



        return response()->json([

            'success' => true,

            'data' => $data,

            'msg' => "Data Retrived successfully.",

        ]);

    }



    public function getUserDetail($id) {

        $user = User::find($id);

        $user->photo = !empty($user->photo) ? asset('profile/'.$user->photo) : '';

        return response()->json([

            'success' => true,

            'data' => $user,

            'msg' => "Data Retrived successfully.",

        ]);

    }



    public function getUserDetailUpdate(Request $request) {

        $user = User::find($request->id);

        if ($request->hasFile('photo')) {

            $fileName = time() . '.' . $request->photo->extension();

            $request->photo->move(public_path('profile'), $fileName);

        } else {
            $fileName =  $user->photo;
        }

        $user->mobile_no = $request->mobile_no;

        $user->address = $request->address;

        $user->pan_number = $request->pan_number;

        $user->gst_number = $request->gst_number;

        $user->photo = $fileName;

        $user->role = \Auth::user()->role == 1 ? 1 : 4;

        $user->save();

        

        return response()->json([

            'success' => true,

            'data' => [],

            'msg' => "Data Retrived successfully.",

        ]);

    }

    public function filter(Request $request) {

        $products = [];

        $product = Product::with('images');
        if(!empty($request->sub_category_id)) {
        	$dd = explode(",", $request->sub_category_id);
            $product = $product->whereIn('sub_category_id',$dd);
        }
        if(!empty($request->category_id)) {
            $dd1 = explode(",", $request->category_id);
            $product = $product->whereIn('category_id',$dd1);
        }
        if(!empty($request->gender)) {
        	$ddsss = explode(",", $request->gender);
            $product = $product->whereIn('gender',$ddsss);
        } 

        if(!empty($request->gross_form)) {
            $product = $product->whereRaw('gross >='.$request->gross_form);
        }
        if(!empty($request->gross_to)) {
            $product = $product->whereRaw('gross <='.$request->gross_to);
        }
        if(!empty($request->gross_form) && !empty($request->gross_to)) {
            $product = $product->whereRaw('gross >='.$request->gross_form)->whereRaw('gross <='.$request->gross_to);
        }
        if(!empty($request->net_from)) {
            $product = $product->whereRaw('net >= '.$request->net_from);
        }
        if(!empty($request->net_to)) {
            $product = $product->whereRaw('net <= '.$request->net_to);
        }
        if(!empty($request->net_from) && !empty($request->net_to)) {
            $product = $product->whereRaw('net >= '.$request->net_from)->whereRaw('net <= '.$request->net_to);
        }
        if(!empty($request->karat_id)) {
            $ss = $request->karat_id;
            $product = $product->where(function($q) use ($ss) {
                foreach (explode(",", $ss) as $key => $value) {
                    $q->where('karat_id','LIKE',"%{$value}%");   
                }
            });
            // $product = $product->where('karat_id','LIKE',"%{$request->karat_id}%");
        }
        if(!empty($request->size_id)) {
            $ss1 = $request->size_id;
            $product = $product->where(function($q1) use ($ss1) {
                foreach (explode(",", $ss1) as $key => $valuess) {
                    $q1->where('size_id','LIKE',"%{$valuess}%");   
                }
            });
        	// $ssssssd = explode(",", $request->size_id);
        	$product = $product->where('size_id','LIKE',"%{$request->size_id}%");
            // $product = $product->whereIn('size_id',$ssssssd);
        }

        $product = $product->get()->toArray();


        if(!empty($product)) {

            foreach ($product as $key => $value) {

                $products[] = [

                    "id"=> $value['id'],

                    "name"=> $value['name'],

                    "image"=> $value['images']['name'] ?? '',

                    "code"=> $value['code'],

                    "description"=> $value['description'],

                    "karat_id"=> $value['karat_id'],

                    "size_id"=> $value['size_id'],

                    "pcs"=> $value['pcs'],

                    "gender"=> $value['gender'],

                    "category_id"=> $value['category_id'],

                    "sub_category_id"=> $value['sub_category_id'],

                    "gross"=> $value['gross'],

                    "net"=> $value['net'],

                    "stone"=> $value['stone'],

                    "normal_category"=> $value['normal_category'],

                    "show_actual_category"=> $value['show_actual_category'],

                    "status"=> $value['status'],

                    "deleted_at"=> $value['deleted_at'],

                    "created_at"=> $value['created_at'],

                    "updated_at"=> $value['updated_at'],

                ];

            }

        }

        $data['product'] = $products;

        return response()->json([

            'success' => true,

            'data' => $data,

            'msg' => "Data Retrived successfully.",

        ]);


    }

    public function getProductDetails(Request $request) {

        $productdetail = Product::where('id',$request->id)->first();
        $data = [];
        if(!empty($productdetail)) {
	        	$productssss[] = [

	            "id"=> $productdetail['id'],

	            "name"=> $productdetail['name'],

	            "image"=> $productdetail['images']['name'] ?? '',

	            "code"=> $productdetail['code'],

	            "description"=> $productdetail['description'],

	            "karat_id"=> $productdetail['karat_id'],

	            "size_id"=> $productdetail['size_id'],

	            "pcs"=> $productdetail['pcs'],

	            "gender"=> $productdetail['gender'],

	            "category_id"=> $productdetail['category_id'],

	            "sub_category_id"=> $productdetail['sub_category_id'],

	            "gross"=> $productdetail['gross'],

	            "net"=> $productdetail['net'],

	            "stone"=> $productdetail['stone'],

	            "normal_category"=> $productdetail['normal_category'],

	            "show_actual_category"=> $productdetail['show_actual_category'],

	            "status"=> $productdetail['status'],

	            "deleted_at"=> $productdetail['deleted_at'],

	            "created_at"=> $productdetail['created_at'],

	            "updated_at"=> $productdetail['updated_at'],

	        ];

	        $product_images = ProductImage::where('product_id', $request->id)->get();

	        $data['productdetail'] = $productssss;

	        $data['productimage'] = $product_images;

	        $data['metrial'] = Material::where('product_id',$request->id)->get();

	        $data['karatlist'] = Karat::whereIn('id',explode(",", $productssss[0]['karat_id']))->get();

	        $data['sizelist'] = Size::whereIn('id',explode(",", $productssss[0]['size_id']))->get();

	        $checkcode = Group::select('product_code')->where('product_code','LIKE',"%{$productssss[0]['code']}%")->first();
	        $data['reletedProduct'] = [];
	        if(!empty($checkcode)) {
	        	$final = [];
	            $code = explode(",", $checkcode['product_code']);
	            unset($code[$productssss[0]['code']]);
	            // foreach ($code as $ssas => $ss) {
	            // 	if($ss != $productssss[0]['code']) {
	            // 		$final[] = $ss;
	            // 	}
	            // }
	            // dd($code);
	            $product = Product::whereIn('code',$code)->get();

	            if(!empty($product)) {

	                foreach ($product as $key => $value) {

	                    $products[] = [

	                        "id"=> $value['id'],

	                        "name"=> $value['name'],

	                        "image"=> $value['images']['name'] ?? '',

	                        "code"=> $value['code'],

	                        "description"=> $value['description'],

	                        "karat_id"=> $value['karat_id'],

	                        "size_id"=> $value['size_id'],

	                        "pcs"=> $value['pcs'],

	                        "gender"=> $value['gender'],

	                        "category_id"=> $value['category_id'],

	                        "sub_category_id"=> $value['sub_category_id'],

	                        "gross"=> $value['gross'],

	                        "net"=> $value['net'],

	                        "stone"=> $value['stone'],

	                        "normal_category"=> $value['normal_category'],

	                        "show_actual_category"=> $value['show_actual_category'],

	                        "status"=> $value['status'],

	                        "deleted_at"=> $value['deleted_at'],

	                        "created_at"=> $value['created_at'],

	                        "updated_at"=> $value['updated_at'],

	                    ];

	                }

	            }
	            $data['reletedProduct'] = $products;
	        }
        }


        return response()->json([

            'success' => true,

            'data' => $data,

            'msg' => "Data Retrived successfully.",

        ]);

    }

    public function search(Request $request) {

    	$productlist = Product::where('product_code','LIKE',"%{$request->keyword}%")->get();
    	return response()->json([

            'success' => true,

            'data' => $productlist,

            'msg' => "Data Retrived successfully.",

        ]);
    }

    public function deletecart($id) {
        Addtocart::where('id',$id)->delete();
        return response()->json([

            'success' => true,

            'data' => [],

            'msg' => "Item Deleted successfully!",

        ]);
    }

    public function addtocart(Request $request) {

        $order = Addtocart::where('product_id',$request->product_id)
            ->where('user_id',$request->user_id)
            ->first();
        if(!empty($order)) {

            $qty = $request->qty + $order['qty'];

            $order = Addtocart::find($order->id);
            $order->product_id = $request->product_id;
            $order->size_id = $request->size_id;
            $order->karat_id = $request->karat_id;
            $order->qty = $qty;
            $order->user_id = $request->user_id;
            $order->status = 0;
            $order->order_status = 0;
            $order->save();
        } else {
        	$order = new Addtocart();
        	$order->product_id = $request->product_id;
        	$order->size_id = $request->size_id;
        	$order->karat_id = $request->karat_id;
        	$order->qty = $request->qty;
        	$order->user_id = $request->user_id;
            $order->status = 0;
            $order->order_status = 0;
        	$order->save();
        }

    	return response()->json([

            'success' => true,

            'data' => $order,

            'msg' => "Data Retrived successfully.",

        ]);
    }

    public function gettocart(Request $request) {
    	$order = Addtocart::select('addtocarts.*','addtocarts.id as main_id','addtocarts.karat_id as kt','addtocarts.size_id as sz','products.*')
        ->leftjoin('products','products.id','addtocarts.product_id')
        ->selectRaw('(select product_images.name as img from product_images where product_images.product_id = addtocarts.product_id order by product_images.id limit 1) as productimage')
        ->where('addtocarts.user_id',$request->user_id)
        ->get();

        $data = [];
        if(!empty($order)) {
            foreach ($order as $key => $value) {

                // $size_ids = Karat::whereIn('id',explode(",", $value['karat_id']))->get();
                // if(empty($size_ids)) {
                //     $size_ids = [];
                // }
                // $sizelist = Size::whereIn('id',explode(",", $value['size_id']))->get();
                // if(empty($sizelist)) {
                //     $sizelist = [];
                // }
                $data[$key] = [
                    'id' => $value['main_id'],
                    'product_id' => $value['product_id'],
                    'karat_id' => $value['karat_id'],
                    'kt' => $value['kt'],
                    'size_id' => $value['size_id'],
                    'sz' => $value['sz'],
                    'qty' => $value['qty'],
                    'user_id' => $value['user_id'],
                    'status' => $value['status'],
                    'order_status' => $value['order_status'],
                    'deleted_at' => $value['deleted_at'],
                    'created_at' => $value['created_at"'],
                    'updated_at' => $value['updated_at"'],
                    'name' => $value['name'],
                    'image' => $value['image'],
                    'code' => $value['code'],
                    'description' => $value['description'],
                    'pcs' => $value['pcs'],
                    'gender' => $value['gender'],
                    'category_id' => $value['category_id'],
                    'sub_category_id' => $value['sub_category_id'],
                    'gross' => $value['gross'],
                    'net' => $value['net'],
                    'stone' => $value['stone'],
                    'normal_category' => $value['normal_category'],
                    'show_actual_category' => $value['show_actual_category'],
                    'productimage' => asset('product/'.$value['productimage'])
                ];

                $data[$key]['karatlist'] = Karat::whereIn('id',explode(",", $value['karat_id']))->get();
                $data[$key]['sizelist'] = Size::whereIn('id',explode(",", $value['size_id']))->get();
                $data[$key]['metrial'] = Material::where('product_id',$value['id'])->get();

                // $data['metrial'] = ;

                // $data['karatlist'] = Karat::whereIn('id',explode(",", $value['karat_id']))->get();

                // $data['sizelist'] = Size::whereIn('id',explode(",", $value['size_id']))->get();
            }
        }

    	return response()->json([

            'success' => true,

            'data' => $data,

            'msg' => "Data Retrived successfully.",

        ]);
    }

    public function placeorder(Request $request) {

        // $data = Datewise::where('shift_id','=','9to2')
        $data = Datewise::where('shift_date',\Carbon\Carbon::now()->format('Y-m-d'))->first();
        if(empty($data)) {
            // $data = Datewise::where('shift_id','=','9to2')
            $data = Datewise::orderby('id','DESC')
            ->first();
        }

        $cart_datas = json_decode($request->cart_data);
        if(!empty($cart_datas)) {
            $ass = array_column($cart_datas, 'product_id');
            $nets = Product::select('net')->whereIn('id',$ass)->sum('net');
        }
        // dd($nets);
        // dd((int)$data['order_take'] < (int)$nets);

        if(isset($data['order_take']) && (int)$data['order_take'] < (int)$nets) {
           return response()->json([

                'success' => false,

                'data' => [],

                'msg' => "Your order not place due to more weight!",

            ]);
        }

        $orderDate = \Carbon\Carbon::now()->format('Y-m-d h:i:s');
        $dataholiday = Holiday::where('holiday_date','=',\Carbon\Carbon::now()->format('Y-m-d'))->count();
        if(!empty($dataholiday)) {
            $orderDate = \Carbon\Carbon::now()->addDays(1)->format('Y-m-d h:i:s');
            // return response()->json([

            //     'success' => false,

            //     'data' => [],

            //     'msg' => "Your order not place due to holiday",

            // ]);
        }
        
        if(!empty($cart_datas)) {
            $order = new Order();
            $order->order_id = 'order-'.rand();
            $order->user_id = $cart_datas[0]->user_id;
            $order->status = 0;
            $order->order_status = 2;
            $order->shift_id = $data['id'];
            $order->shift_name = $data['shift_id'];
            $order->created_at = $orderDate;
            $order->save();
            $net = $stone = $gross = 0;
            foreach ($cart_datas as $key => $value) {
                $orderdetail = new OrderDetail();
                $orderdetail->order_id = $order->id;
                $orderdetail->product_id = $value->product_id;
                $orderdetail->size_id = $value->size_id;
                $orderdetail->karat_id = $value->karat_id;
                $orderdetail->qty = $value->qty;
                $orderdetail->user_id = $value->user_id;
                $orderdetail->status = 0;
                $orderdetail->order_status = 2;
                $orderdetail->save();

                $nets = Product::select('net','gross','stone')->where('id',$value->product_id)->first();
                $net += $nets['net'];
                $gross += $nets['gross'];
                $stone += $nets['stone'];
            }
            $orderupda = Order::find($order->id);            
            $orderupda->totalnet = $net;            
            $orderupda->gross = $gross;            
            $orderupda->stone = $stone;            
            $orderupda->save();        
            Addtocart::where('user_id',$cart_datas[0]->user_id)->delete();

            $getuser = Order::select('user_id')->where('order_id',$order->order_id)->first();
            $usertoken = User::select('notification_token')->where('id',$getuser->user_id)->first();
            $message = 'Your Order place successfully Order ID '.$order->order_id.' – RTP';
            $this->sendmessage($usertoken->notification_token,$message,$getuser->user_id,'Place Order');
        }

        return response()->json([

            'success' => true,

            'data' => [],

            'msg' => "Data Retrived successfully.",

        ]);
    }

    public function orderdetail(Request $request) {

        // $order = Order::where('orders.id',$request->orderid)
        // ->select('products.name','orders.*','sizes.name as size_name','karats.name as karat_name','users.name as customerName')
        // ->join('order_details','order_details.order_id','orders.id')
        // ->leftjoin('products','products.id','order_details.product_id')
        // ->leftjoin('karats','karats.id','order_details.karat_id')
        // ->leftjoin('sizes','sizes.id','order_details.size_id')
        // ->leftjoin('users','users.id','orders.user_id')
        // ->first();
        $data = [];
        $order = Order::select('orders.*',\DB::raw("(CASE WHEN orders.order_status = 0 THEN 'pending' WHEN orders.order_status = 1 THEN 'process' WHEN orders.order_status = 3 THEN 'readyfordispatch' ELSE 'process' END) AS status"),)->where('orders.id',$request->orderid)->first();


        $data['order'] = [
            "id"=> $order['id'],
            "order_id"=> $order['order_id'],
            "totalnet"=> $order['totalnet'],
            "gross"=> $order['gross'],
            "stone"=> $order['stone'],
            "user_id"=> $order['user_id'],
            "order_status_update_by"=> $order['order_status_update_by'],
            "photo"=> !empty($order['photo']) ? asset('orderupdatestatus/'.$order['photo']) : '',
            "status"=> $order['status'],
            "order_status"=> $order['order_status'],
            "shift_id"=> $order['shift_id'],
            "shift_name"=> $order['shift_name'],
            "order_update_at"=> $order['order_update_at'],
            "is_sms_sended"=> $order['is_sms_sended'],
            "deleted_at"=> $order['deleted_at'],
            "created_at"=> $order['created_at'],
            "updated_at"=> $order['updated_at']
        ];


        $OrderDe = OrderDetail::where('order_details.order_id',$request->orderid)
        ->select('products.name','order_details.*')
        ->leftjoin('products','products.id','order_details.product_id')
        ->selectRaw('(select product_images.name as img from product_images where product_images.product_id = order_details.product_id order by product_images.id limit 1) as productimage')
        ->get();
        if(!empty($OrderDe)) { 
            foreach ($OrderDe as $key => $value) {
                $data['order_detail'][$key] = [
                    'id' => $value['id'],
                    'product_id' => $value['product_id'],
                    'karat_id' => $value['karat_id'],
                    'kt' => $value['kt'],
                    'size_id' => $value['size_id'],
                    'sz' => $value['sz'],
                    'qty' => $value['qty'],
                    'user_id' => $value['user_id'],
                    'status' => $value['status'],
                    'order_status' => $value['order_status'],
                    'created_at' => $value['created_at"'],
                    'name' => $value['name'],
                    'image' => $value['image'],
                    'code' => $value['code'],
                    'description' => $value['description'],
                    'pcs' => $value['pcs'],
                    'gender' => $value['gender'],
                    'gross' => $value['gross'],
                    'net' => $value['net'],
                    'stone' => $value['stone'],
                    'normal_category' => $value['normal_category'],
                    'show_actual_category' => $value['show_actual_category'],
                    'productimage' => asset('product/'.$value['productimage'])
                ];

                $data['order_detail'][$key]['karatlist'] = Karat::whereIn('id',explode(",", $value['karat_id']))->get();
                $data['order_detail'][$key]['sizelist'] = Size::whereIn('id',explode(",", $value['size_id']))->get();
                $data['order_detail'][$key]['metrial'] = Material::where('product_id',$value['id'])->get();
            }
        }

        return response()->json([

            'success' => true,

            'data' => $data,

            'msg' => "Data Retrived successfully.",

        ]);
    }

    public function orderlist(Request $request) {

        $order = Order::where('orders.user_id',$request->user_id)
        ->select(
            'orders.id',
            'orders.order_id as order_number',
            'orders.totalnet as totalnet',
            'orders.gross as totalgross',
            'orders.stone as totalstone',
            'orders.created_at',
            // 'orders.order_status as order_status',
            'users.name as customerName',
            \DB::raw("(CASE WHEN orders.order_status = 2 THEN 'order received' WHEN orders.order_status = 4 THEN 'take your order' WHEN orders.order_status = 5 THEN 'order complete' ELSE 'order received' END) AS status"),
        )
        // ->selectRaw(
        //         '(
        //             CASE WHEN orders.order_status = 0 THEN pending  END
        //             CASE WHEN orders.order_status = 1 THEN process  END
        //         ) as status'
        //     )
        // ->leftjoin('order_details','order_details.order_id','orders.id')
        // ->leftjoin('products','products.id','order_details.product_id')
        // ->leftjoin('karats','karats.id','order_details.karat_id')
        // ->leftjoin('sizes','sizes.id','order_details.size_id')
        ->leftjoin('users','users.id','orders.user_id')
        ->get();

        return response()->json([

            'success' => true,

            'data' => $order,

            'msg' => "Data Retrived successfully.",

        ]);
    }

    public function orderstatus() {
        $data['orderstatus'] = [

            'Reject',

            'Take your order',

            'Order Complete',
        ];

        return response()->json([

            'success' => true,

            'data' => $data,

            'msg' => "Data Retrived successfully.",

        ]);

    }

    public function updatestatus(Request $request) {

        $status = $request->status;
        $ordeid = $request->orderid;
        
        $fileName = "";
        if ($request->hasFile('photo')) {

            $fileName = time() . '.' . $request->photo->extension();

            $request->photo->move(public_path('orderupdatestatus'), $fileName);
        }

        $getuser = Order::select('user_id','totalnet')->where('order_id',$ordeid)->first();
        $usertoken = User::select('notification_token')->where('id',$getuser->user_id)->first();

        if($status == 'Reject') {
            $status = 3;
            $message = 'Your Order ID '.$ordeid.' is rejected – RTP';
        } else if($status == 'Take your order') {
            $status = 4;
            $message = 'Kindly send '.$getuser->totalnet.' grams of gold for your order number '.$ordeid.' – RTP';
        } else if($status == 'Order Complete') {
            $status = 5;
            $message = 'Your Order ID '.$ordeid.' is completed. Kindly collect your order ASAP  – RTP';
            $order = Order::where('order_id',$ordeid)->update(['order_update_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')]);            
        }
        // dd($message);
        $this->sendmessage($usertoken->notification_token,$message,$getuser->user_id,'Update Status'.$request->status);

        $order = Order::where('order_id',$ordeid)->update(
            ['order_status' => $status,
            'order_status_update_by' => \Auth::user()->id,
            'photo' => $fileName
            ]);

        return response()->json([

            'success' => true,

            'data' => [],

            'msg' => "Status Updated successfully.",

        ]);
    }

    public function pendingOrderlist(Request $request) {

        $order = Order::where('orders.order_status',2)
        ->select(
            'orders.id',
            'orders.order_id as order_number',
            'orders.totalnet as totalnet',
            'orders.gross as totalgross',
            'orders.stone as totalstone',
            'orders.created_at',
            'users.name as customerName',
            \DB::raw("(CASE WHEN orders.order_status = 2 THEN 'order received' WHEN orders.order_status = 4 THEN 'take your order' WHEN orders.order_status = 5 THEN 'order complete' ELSE 'order received' END) AS status"),
        )
        ->leftjoin('users','users.id','orders.user_id')
        ->get();

        return response()->json([

            'success' => true,

            'data' => $order,

            'msg' => "Data Retrived successfully.",

        ]);
    }


    public function addtocartbyproductid(Request $request) {

        $product = Product::where('code',$request->code)->first();

        if(empty($product)) {

            return response()->json([

                'success' => true,

                'data' => [],

                'msg' => "Product Code is not found!",

            ]);
        }

        $order = Addtocart::where('product_id',$product->id)
            ->where('user_id',$request->user_id)
            ->first();

        if(!empty($order)) {

            return response()->json([

                'success' => true,

                'data' => [],

                'msg' => "Item exsting in cart.",

            ]);
            
        }
        $size = explode(",", $product->size_id);
        $karat = explode(",", $product->karat_id);

        $order = new Addtocart();
        $order->product_id = $product->id;
        $order->size_id = isset($size[0]) ? $size[0] : 0;
        $order->karat_id = isset($karat[0]) ? $karat[0] : 0;
        $order->qty = 1;
        $order->user_id = $request->user_id;
        $order->status = 0;
        $order->order_status = 0;
        $order->save();

        return response()->json([

            'success' => true,

            'data' => $order,

            'msg' => "Data Added successfully.",

        ]);

    }

    public function notificationlist(Request $request) {

        $notification = [];
        if(!empty($request->user_id)) {
            $notification = Notification::where('user_id',$request->user_id)->get();
        }

        return response()->json([

            'success' => true,

            'data' => $notification,

            'msg' => "Data Added successfully.",

        ]);
    }


    public function sendmessage($token,$message,$user,$type = '') {
        $tokenList = $token;
        $template_key = 'AAAAppC8lg0:APA91bFR2OFdI977xFCwa1vdXNg5GsIhTW76ulF0mG7MEr7J8-L0oNhHggdHzSJEA0UqTkNFWDLB8Ta8tZW088h2lb7IdELcumPH6vT5cbeIakKXPMAK2L1k6KJz7yHgCm27yEcDF30T';
        $imssss = '';
        $msg = $message;
        $title = $message;
        $user = $user;
        $sd = '{
                "to": "'.$tokenList.'",
                "data": {
                    "message": "'.$msg.'",
                    "title": "'.$title.'",
                    "users_id": "'.$user.'",
                    "ischat": 1,
                    "type": "'.$type.'",
                    "img": "'.$imssss.'"
                }
            }';
        
        // echo "<pre>"; print_r($sd);exit;
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$sd,
          CURLOPT_HTTPHEADER => array(
            'Authorization: key='.$template_key,
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);

        $newnotification = New Notification();
        $newnotification->title = $type;
        $newnotification->type = $type;
        $newnotification->img = '';
        $newnotification->message = $message;
        $newnotification->ischat = 0;
        $newnotification->user_id = $user;
        $newnotification->created_by = \Auth::id();
        $newnotification->save();
        // echo $response;
    }

}

