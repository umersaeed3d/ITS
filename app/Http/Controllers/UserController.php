<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\CrudInterface;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends Controller
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
        $data= $this->crud->all(User::class);
        $roles = Role::all();
        return view('user/index',compact('data','roles'));
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
        dd(1);
        if(!in_array('user_add',Session::get('permissions'))){
            return redirect()->back()->with('error','You do not have permission for this action');
        }
        $request->validate([
            'full_name' => 'required|max:20',
            'user_name' => 'required|max:10',
            'password' => 'required|min:6',
            'email' => 'required|email',
            'role_id' => 'required|integer',
        ]);

        try{

            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            $this->crud->store(User::class,$data);

            return redirect()->back()->with('success','User Added Successfully');

        }catch(\Illuminate\Database\QueryException $e){
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
        if(!in_array('user_delete',Session::get('permissions'))){
            return redirect()->back()->with('error','You do not have permission for this action');
        }
        $this->crud->delete(User::class,$id);
        return redirect()->back()->with('success','User Deleted Successfully');
    }
}
