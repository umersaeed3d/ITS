<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','image'];

    public function inventory(){
        return $this->hasMany(\App\Models\Inventory::class);
    }
}
