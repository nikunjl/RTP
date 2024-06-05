<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Product;

use Validator;



class CategoryController extends Controller

{

    function __construct()

    {

        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index', 'store']]);

        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);

        $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);

        $this->middleware('permission:category-delete', ['only' => ['destroy']]);

    }

    /**

     * Display a listing of the resource.

     */

    public function index()

    {



        $title = 'Manage Category | ' . env('APP_NAME');

        $category = Category::select('categories.*', 'parent.name as parent_name')

            ->leftjoin('categories as parent', 'parent.id', 'categories.parent_category')
            ->wherenull('categories.parent_category')
            ->get();

        return view('admin.category.index', compact('title', 'category'));

    }



    /**

     * Show the form for creating a new resource.

     */

    public function create()

    {

        $title = 'Create Category | ' . env('APP_NAME');

        $getcat = Category::where('status', '1')->get();

        $catArray = array();

        foreach ($getcat as $cat) {

            $catArray[$cat->id] = array(

                'id' => $cat->id,

                'name' => $cat->name,

                'parent_category' => $cat->parent_category,

            );

        }

        return view('admin.category.create', compact('title', 'catArray'));

    }



    /**

     * Store a newly created resource in storage.

     */

    public function store(Request $request)

    {

        $validator = $request->validate([

            'name'   => 'required|unique:categories,name',

            // 'description' => 'required',

            // 'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
        
        $fileName = "";
        if ($request->hasFile('image')) {

            $fileName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('category'), $fileName);
        }




        $category = new Category();

        $category->name = $request->name;

        $category->img = $fileName;

        $category->description = $request->description;

        $category->parent_category = $request->parent_category;

        $category->status = $request->status;

        $category->save();



        return redirect()->route('categorys.index')->with('success', 'Record created!.');;

    }



    /**

     * Show the form for editing the specified resource.

     */

    public function edit(string $id)

    {

        $title = 'Edit Category | ' . env('APP_NAME');

        $category = Category::find($id);

        $getcat = Category::where('status', '1')->get();

        $catArray = array();

        foreach ($getcat as $cat) {

            $catArray[$cat->id] = array(

                'id' => $cat->id,

                'name' => $cat->name,

                'parent_category' => $cat->parent_category,

            );

        }

        return view('admin.category.edit', compact('category', 'title', 'catArray'));

    }



    /**

     * Update the specified resource in storage.

     */

    public function update(Request $request, string $id)

    {

        $validator = $request->validate([

            'name'   => 'required|unique:categories,name,' . $id,

            // 'description' => 'required',

            // 'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        if ($request->hasFile('image')) {

            $fileName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('category'), $fileName);

        } else {

            $fileName = $request->old_img;

        }



        $category = Category::find($id);

        $category->name = $request->name;

        $category->img = $fileName;

        $category->description = $request->description;

        $category->parent_category = $request->parent_category;

        $category->status = $request->status;

        $category->save();



        return redirect()->route('categorys.index')->with('success', 'Record updated!.');;

    }



    /**

     * Remove the specified resource from storage.

     */

    public function destroy(string $id)

    {

        $category = Category::find($id)->delete();

        Product::where('category_id',$id)->delete();

        return redirect()->route('categorys.index')->with('success', 'Record deleted!.');;

    }

}

