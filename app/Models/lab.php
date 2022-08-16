<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lab extends Model
{
    use HasFactory;
    protected $fillable = ['name','code','incharge_id'];


    public function incharge(){
       return $this->belongsTo(\App\Models\User::class);
    }

    public function inventory(){
        return $this->belongsTo(\App\Models\Inventory::class);
     }

     public function inventoryHistory(){
        return $this->hasMany(\App\Models\InventoryHistory::class);
     }
}
