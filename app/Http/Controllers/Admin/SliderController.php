<?php



namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Slider;

use Validator;



class SliderController extends Controller

{

    function __construct()

    {

        $this->middleware('permission:slider-list|slider-create|slider-edit|slider-delete', ['only' => ['index', 'store']]);

        $this->middleware('permission:slider-create', ['only' => ['create', 'store']]);

        $this->middleware('permission:slider-edit', ['only' => ['edit', 'update']]);

        $this->middleware('permission:slider-delete', ['only' => ['destroy']]);

    }

    /**

     * Display a listing of the resource.

     */

    public function index()

    {

        $title = 'Manage Slider | ' . env('APP_NAME');

        $slider = Slider::all();

        return view('admin.slider.index', compact('title', 'slider'));

    }



    /**

     * Show the form for creating a new resource.

     */

    public function create()

    {

        $title = 'Create Slider | ' . env('APP_NAME');

        return view('admin.slider.create', compact('title'));

    }



    /**

     * Store a newly created resource in storage.

     */

    public function store(Request $request)

    {

        $validator = $request->validate([

            'name'   => 'required|unique:sliders,name',

            // 'description' => 'required',

            // 'img' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        $fileName = '';
        if ($request->hasFile('img')) {
            $fileName = time() . '.' . $request->img->extension();

            $request->img->move(public_path('slider'), $fileName);
        }



        $slider = new Slider();

        $slider->name = $request->name;

        $slider->img = $fileName;

        $slider->description = $request->description;

        $slider->status = '1';

        $slider->save();



        return redirect()->route('sliders.index')->with('success', 'Record created!.');;

    }



    /**

     * Show the form for editing the specified resource.

     */

    public function edit(string $id)

    {

        $title = 'Edit Slider | ' . env('APP_NAME');

        $slider = Slider::find($id);

        return view('admin.slider.edit', compact('slider', 'title'));

    }



    /**

     * Update the specified resource in storage.

     */

    public function update(Request $request, string $id)

    {

        $validator = $request->validate([

            'name'   => 'required|unique:categories,name,' . $id,

            // 'description' => 'required'

        ]);



        if ($request->hasFile('img')) {

            $fileName = time() . '.' . $request->img->extension();

            $request->img->move(public_path('slider'), $fileName);

        } else {

            $fileName = $request->old_img;

        }



        $slider = Slider::find($id);

        $slider->name = $request->name;

        $slider->img = $fileName;

        $slider->description = $request->description;

        $slider->status = '1';

        $slider->save();



        return redirect()->route('sliders.index')->with('success', 'Record updated!.');;

    }



    /**

     * Remove the specified resource from storage.

     */

    public function destroy(string $id)

    {

        $slider = Slider::find($id)->delete();

        return redirect()->route('sliders.index')->with('success', 'Record deleted!.');;

    }

}

