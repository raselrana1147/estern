<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $guarded=[];
    public function order(){
    		return $this->belongsTo('App\Order','order_id');
    }

    public function user(){
    		return $this->belongsTo('App\User','user_id');
    }

     public function product(){
    		return $this->belongsTo('App\Product','product_id');
    }

}
