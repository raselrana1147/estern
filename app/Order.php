<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function user(){
    		return $this->belongsTo('App\Customer','user_id');
    }
    public function payment(){
    		return $this->hasOne('App\OrderPayment');
    }
}
