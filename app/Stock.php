<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    
  
	protected $guarded=[];
    
    public function stock_category(){
    	return $this->belongsTo('App\StockCategory','stock_category_id');
    }
}
