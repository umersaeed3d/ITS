<?php

namespace App\Http\Controllers;

use App\Models\lab;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\CrudInterface;
use Session;

class LabController extends Controller
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
        $data= $this->crud->all(lab::class);
        $labIncharge = User::where('role_id',2)->get();
        return view('lab/index',compact('data','labIncharge'));
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
        if(!in_array('lab_add',Session::get('permissions'))){
            return redirect()->back()->with('error','You do not have permission for this action');
        }
        $request->validate([
            'name' => 'required|max:20',
            'code' => 'required|max:10',
            'incharge_id' => 'required',
        ]);

        try{


            $this->crud->store(lab::class,$request->all());
            return redirect()->back()->with('success','Lab Added Successfully');

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
        if(!in_array('lab_delete',Session::get('permissions'))){
            return redirect()->back()->with('error','You do not have permission for this action');
        }
        $this->crud->delete(lab::class,$id);
        return redirect()->back()->with('success','Lab Deleted Successfully');
    }
}
