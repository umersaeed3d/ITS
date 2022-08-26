<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryHistory;
use App\Models\Category;
use App\Models\User;
use App\Models\lab;
use Illuminate\Http\Request;
use App\Repositories\CrudInterface;
use Illuminate\Support\Facades\DB;
use Session;

class InventoryController extends Controller
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
        $data= $this->crud->all(Inventory::class);
        $categories = Category::where('is_active',"1")->get();
        $users = User::where('role_id',2)->get();
        $labs = lab::where('is_active',"1")->get();
        $inventories = [];
        if(in_array('inventory_view_specific',Session::get('permissions'))){
            $allocatedTo = InventoryHistory::latest()
            ->get()
            ->unique('inventory_id');

            $allocatedArray = [];
            foreach($allocatedTo as $a){
                if($a->allocated_to == auth()->user()->id){
                    $allocatedArray[] = $a->inventory_id;
                }
            }
            // dd($allocatedArray);
            foreach($data as $d){

                if(in_array($d->id,$allocatedArray)){
                    array_push($inventories,$d);
                }
            }
        }else{
            $inventories = $data;
        }

        return view('inventory/index',compact('inventories','categories','users','labs'));
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

    public function history($inventory_id)
    {
        $history = InventoryHistory::where('inventory_id',$inventory_id)->join('users','users.id','inventory_histories.allocated_to')->with(['initialLab','finalLab'])->get(['inventory_histories.*','users.full_name as username']);


        return view('inventory.history',compact('history'));

    }

    public function transfer(Request $request){

        try{
            $checkBeforeTransfer =  InventoryHistory::where('inventory_id',$request->inventory)->where('receive_date',null)->orderBy('id','desc')->first();
            if($checkBeforeTransfer !== null){
                InventoryHistory::where('inventory_id',$request->inventory)->update(['final_lab_id'=>$request->lab,'receive_date'=>date('Y-m-d'),'allocated_to'=>$request->user]);
            }else{
                $lastTransfer = InventoryHistory::where('inventory_id',$request->inventory)->orderBy('id','desc')->first();
                $data = $request->all();
                $data['inventory_id'] = $request->inventory;
                $data['initial_lab_id'] = $lastTransfer['final_lab_id'];
                $data['final_lab_id'] = $request->lab;
                $data['allocated_to'] = $request->user;
                $data['receive_date'] = date('Y-m-d');
                $data['issue_date'] = $lastTransfer['issue_date'];
                $this->crud->store(InventoryHistory::class,$data);

            }
            return redirect()->back()->with('success','Inventory Transferred Successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!in_array('inventory_add',Session::get('permissions'))){
            return redirect()->back()->with('error','You do not have permission for this action');
        }
        $request->validate([
            'name' => 'required|max:20',
            'desc' => 'required|max:400,min:10',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'lab_id' => 'required|integer',
            'user_id' => 'required|integer'
        ]);

        try{


            $inventory = $this->crud->store(Inventory::class,$request->all());
            $data = [];
            $data['inventory_id'] = $inventory->id;
            $data['initial_lab_id'] = $request->lab_id;
            $data['allocated_to'] = $request->user_id;
            $data['issue_date'] = date('Y-m-d');

            $this->crud->store(InventoryHistory::class,$data);
            return redirect()->back()->with('success','Inventory Added Successfully');

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
        if(!in_array('inventory_delete',Session::get('permissions'))){
            return redirect()->back()->with('error','You do not have permission for this action');
        }
        $this->crud->delete(Inventory::class,$id);
        return redirect()->back()->with('success','Inventory Deleted Successfully');
    }
}
