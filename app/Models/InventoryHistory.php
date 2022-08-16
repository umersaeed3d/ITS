<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryHistory extends Model
{
    use HasFactory;
    protected $fillable = ['inventory_id','initial_lab_id','issue_date','allocated_to'];

    public function inventory(){
        return $this->belongsTo(\App\Models\Inventory::class);
    }

    public function initialLab(){
        return $this->belongsTo(\App\Models\lab::class,'initial_lab_id','id');
    }

    public function finalLab(){
        return $this->belongsTo(\App\Models\lab::class,'final_lab_id','id');
    }


}
