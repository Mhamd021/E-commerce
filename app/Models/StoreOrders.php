<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreOrders extends Model
{
    protected $guarded = [];
    use HasFactory;
    protected $fillable = ['shops_id','order_id','deliver_id','user_id','product_id','store_name','user_name','phone','name','image','price','status','quantity','time_to_deliver',];

    public function shops()
    {
        return $this->belongsTo('App\Models\shops');
    }
    public function delivers()
    {
        return $this->belongsTo('App\Models\Delivery');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
