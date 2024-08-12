<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ["user_id","deliver_id","cart","lat","lng","time_to_deliver","phone","status"];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }


}
