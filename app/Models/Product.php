<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{

    use HasFactory;
    protected $fillable = ["shops_id","name","price","category","detail","quantity","trending","image"];

    public function shops()
    {
        return $this->belongsTo('App\Models\shops','shops_id','id');
    }
    public function ProductRating()
    {
        return $this->hasMany(ProductRating::class);
    }
}
