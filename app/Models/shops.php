<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shops extends Model
{
    use HasFactory;
    protected $fillable = ["user_id","name","image","location","description"];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function delivers()
    {
        return $this->belongsToMany(Delivery::class);
    }
    public function StoreOrders()
    {
        return $this->hasMany(StoreOrders::class);
    }



}
