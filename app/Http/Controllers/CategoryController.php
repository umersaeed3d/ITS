<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\CrudInterface;

class CategoryController extends Controller
{
    protected $crud;

    public function __construct(CrudInterface $crud)
    {
        $this->crud = $crud;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= $this->crud->all(Category::class);
        return view('category/index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        try{
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image_path = '/dashboard/images/'.$imageName;
            $image->move('dashboard/images/',$imageName);

            $data = $request->all();
            $data['image'] = $image_path;

            $this->crud->store(Category::class,$data);
            return redirect()->back()->with('success','Category Added Successfully');

        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->crud->delete(Category::class,$id);
        return redirect()->back()->with('success','Category Deleted Successfully');
    }
}
