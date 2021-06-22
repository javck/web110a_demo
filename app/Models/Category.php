<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //Mass Assignment 白名單
    protected $fillable = ['name','parent_id','enabled','sort'];
    //protected $guarded = [];

    //這兩個欄位的呈現只要有年月日即可
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];

    public function products()
    {
       return $this->hasMany(Product::class);
    }
}
