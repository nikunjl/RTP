<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\Material;

use App\Models\ProductImage;

use App\Models\Category;

use App\Models\Karat;

use App\Models\Size;

use Validator;



class ProductController extends Controller

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



        $title = 'Manage Product | ' . env('APP_NAME');

        $product = Product::select('products.*', 'categories.name as category_name')

            // ->leftjoin('product_images', 'product_images.product_id', 'products.id')

            ->leftjoin('categories', 'categories.id', 'products.category_id')

            ->get();

            // print_r($product);exit;

        return view('admin.product.index', compact('title', 'product'));

    }



    /**

     * Show the form for creating a new resource.

     */

    public function create()

    {

        $title = 'Create Product | ' . env('APP_NAME');

        $karat = Karat::where('status', '1')->get();

        $size = Size::where('status', '1')->get();

        $category = Category::wherenull('parent_category')->where('status', '1')->get();

        return view('admin.product.create', compact('title', 'size', 'karat', 'category'));

    }



    /**

     * Store a newly created resource in storage.

     */

    public function store(Request $request)

    {

        $validator = $request->validate([

            'name'   => 'required',

            // 'description' => 'required',

        ]);



        $product = new Product();

        $product->name = $request->name;

        $product->description = $request->description;

        $product->code = $request->code;

        $product->karat_id = !empty($request->karat_id) ? implode(",", $request->karat_id) : 0;

        $product->size_id = !empty($request->size_id) ? implode(",", $request->size_id) : 0;

        $product->pcs = $request->pcs ?? 0;

        $product->gross = $request->gross ?? 0;

        $product->category_id = $request->category_id ?? '';

        $product->sub_category_id = $request->sub_category_id ?? '';

        $product->net = $request->net ?? 0;

        $product->stone = $request->stone ?? 0;

        $product->gender = $request->gender ?? '';

        $product->normal_category = $request->normal_category ?? '';

        $product->show_actual_category = $request->show_actual_category ?? '';

        $product->status = $request->status;

        $product->save();



        $image = $request->image;

        for ($i = 0; $i < count($image); $i++) {

            $imageData = $image[$i];

            list($type, $imageData) = explode(';', $imageData);

            list(, $extension) = explode('/', $type);

            list(, $imageData)      = explode(',', $imageData);

            $imageData  = base64_decode($imageData);

            $filename     = uniqid() . "_" . rand() . ".png";

            $uploadPath = public_path() . "/product/" . $filename;



            if (file_put_contents($uploadPath, $imageData)) {

                echo "Success!";

            } else {

                echo "Unable to save the file.";

            }



            $new = new ProductImage();

            $new->name = $filename;

            $new->product_id = $product->id;

            $new->save();

        }



        $mat = !empty($request->matname) ? count($request->matname) : '';

        if (!empty($mat)) {

            for ($i = 0; $i < $mat; $i++) {

                $matproduct = new Material();

                $matproduct->product_id = $product->id;

                $matproduct->name = $request->matname[$i];

                $matproduct->weight = $request->matweight[$i];

                $matproduct->rs = $request->matrs[$i];

                $matproduct->save();

            }

        }



        return redirect()->route('products.index')->with('success', 'Record created!.');;

    }



    /**

     * Show the form for editing the specified resource.

     */

    public function edit(string $id)

    {

        $title = 'Edit Product | ' . env('APP_NAME');

        $product = Product::find($id);

        $product_images = ProductImage::where('product_id', $id)->get();

        $material = Material::where('product_id', $id)->get();

        $karat = Karat::where('status', '1')->get();

        $size = Size::where('status', '1')->get();

        $category = Category::wherenull('parent_category')->where('status', '1')->get();

        return view('admin.product.edit', compact('product', 'title', 'material', 'karat', 'size', 'product_images', 'category'));

    }



    /**

     * Update the specified resource in storage.

     */

    public function update(Request $request, string $id)

    {

        $validator = $request->validate([

            'name'   => 'required',

            // 'description' => 'required',

        ]);



        $image = $request->image;

        if (!empty($image)) {

            for ($i = 0; $i < count($image); $i++) {

                $imageData = $image[$i];

                list($type, $imageData) = explode(';', $imageData);

                list(, $extension) = explode('/', $type);

                list(, $imageData)      = explode(',', $imageData);

                $imageData  = base64_decode($imageData);

                $filename     = uniqid() . "_" . rand() . ".png";

                $uploadPath = public_path() . "/product/" . $filename;

                if (file_put_contents($uploadPath, $imageData)) {

                }

                $new = new ProductImage();

                $new->name = $filename;

                $new->product_id = $id;

                $new->save();

            }

        }



        $product = Product::find($id);

        $product->name = $request->name;

        $product->description = $request->description;

        $product->code = $request->code;

        $product->karat_id = isset($request->karat_id) && !empty($request->karat_id) ? implode(",", $request->karat_id) : 0;

        $product->size_id = isset($request->size_id) && !empty($request->size_id) ? implode(",", $request->size_id) : 0;

        $product->pcs = $request->pcs;

        $product->category_id = $request->category_id;

        $product->sub_category_id = $request->sub_category_id ?? '';

        $product->gross = $request->gross;

        $product->net = $request->net;

        $product->stone = $request->stone;

        $product->gender = $request->gender ?? '';

        $product->normal_category = $request->normal_category;

        $product->show_actual_category = $request->show_actual_category;

        $product->status = $request->status;

        $product->save();



        $mat = !empty($request->matname) ? count($request->matname) : '';

        if (!empty($mat)) {

            Material::where('product_id', $product->id)->delete();

            for ($i = 0; $i < $mat; $i++) {

                $matproduct = new Material();

                $matproduct->product_id = $product->id;

                $matproduct->name = $request->matname[$i];

                $matproduct->weight = $request->matweight[$i];

                $matproduct->rs = $request->matrs[$i];

                $matproduct->save();

            }

        }

        return redirect()->back()->with('success', 'Record updated!.');

        return redirect()->route('products.index')->with('success', 'Record updated!.');;

    }



    /**

     * Remove the specified resource from storage.

     */

    public function destroy(string $id)

    {

        $product = Product::find($id)->delete();

        Material::where('product_id', $id)->delete();

        return redirect()->route('products.index')->with('success', 'Record deleted!.');;

    }



    public function deleteImage(Request $request)

    {

        $data = ProductImage::where('id', $request->id)->delete();

        unlink(public_path() . "/product/" . $request->name);

        if ($data) {

            return true;

        }

    }

    public function getsubcate(Request $request) {
        $category = Category::where('parent_category',$request->id)->get();
        return $category;
    }



    public function gridview()

    {

        $category = Category::whereNull('parent_category')->get();

        $title = 'Grid View';

        return view('admin.product.gridview', compact('title', 'category'));

    }



    public function showSubCategory($id)

    {

        $category = Category::where('categories.parent_category', $id)

            ->select('categories.*','products.id as prod_id')

            ->leftjoin('products', 'products.category_id', 'categories.id')

            ->get();

// dd($category);

        $title = 'Sub product Grid View';

        return view('admin.product.subcate', compact('title', 'category'));

    }



    public function showproductByCategory($id, Request $request)

    {

        $type = $request->type;   
        $products = Product::select('products.*','categories.name as category_name')
            ->leftjoin('categories', 'categories.id', 'products.category_id')

            ->selectRaw('(select product_images.name from product_images where product_images.product_id = products.id order by product_images.id limit 1) as image_name');

            if($type == 1) {

                $products = $products->where('products.category_id',$id);
            } else {
                $products = $products->where('products.sub_category_id',$id);
            }

            $products = $products->get();

        $title = 'Product view';

        return view('admin.product.productgrid', compact('title', 'products'));

    }

}

