<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = ['name','desc','price','category_id'];

    public function category(){
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function history(){
        return $this->hasMany(\App\Models\InventoryHistory::class);
    }


}
