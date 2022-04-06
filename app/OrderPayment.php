<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    protected $guarded=[];

     public function order(){
    		return $this->belongsTo('App\Order','order_id');
    }

    public function user(){
    		return $this->belongsTo('App\User','user_id');
    }

}
