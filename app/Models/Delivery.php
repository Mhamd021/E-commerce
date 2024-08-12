<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = ["user_id","name","city","image","description","delivery_charg","start_time","end_time"];

    //image and description nullable
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function shops()
    {
        return $this->belongsToMany(shops::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function Readyorders()
    {
        return $this->hasMany(StoreOrders::class);
    }
}
