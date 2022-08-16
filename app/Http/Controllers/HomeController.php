<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\InventoryHistory;
use App\Models\lab;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $inventoryCount = Inventory::count();
        $userCount = User::count();
        $labCount = lab::count();

        $inventories = Inventory::all();
        $users = User::where('role_id',2)->get();
        $labs = lab::all();

        $history = InventoryHistory::join('users','users.id','inventory_histories.allocated_to')->with(['initialLab','finalLab','inventory'])->orderBy('id','desc')->limit(4)->get(['inventory_histories.*','users.full_name as username']);
        return view('home',compact('inventoryCount','userCount','labCount','inventories','users','labs','history'));
    }
}
