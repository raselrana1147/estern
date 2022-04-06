<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use Session;
class Cart extends Model
{
    protected $guarded = [];

    public function product(){
    	return $this->belongsTo(Product::class);
    }


    public static function totalitem(){
    	$item=0;
    	if (Session::has('CustomerSession')) {
    		$customer = Session::get('CustomerSession');
   	      	$cartItem=Cart::where('user_id',$customer->id)->count();
   	        return $cartItem;
    	}else{
    		return $item;
    	}


   }


    public static function totalprice(){
    	$price=0;
    	if (Session::has('CustomerSession')) {
    		$customer = Session::get('CustomerSession');
   	  	  $carts=Cart::where('user_id',$customer->id)->get();
   	    if (count($carts)>0){
   	  	 foreach($carts as $cart)
   	  	 {
   	  	 	$price+=$cart->product_price*$cart->quantity;
   	  	 }
   	     }
    	}

   	  return $price;
   }

    public static function cart(){

    if (Session::has('CustomerSession')) {
    	 $customer = Session::get('CustomerSession');
   	  	   $carts=Cart::where('user_id',$customer->id)->get();
	   	  if (count($carts)>0){
	   	  	 return $carts;
	   	  }
    	}
   }


    public static function totalitemapp(){
      $item=0;
      if (auth()->check()) {
        $user = auth()->user();
            $cartItem=Cart::where('user_id',$user->id)->count();
            return $cartItem;
      }else{
        return $item;
      }
   }


    public static function totalpriceapp(){
      $price=0;
      if (auth()->check()) {
         $user = auth()->user();
          $carts=Cart::where('user_id',$user->id)->get();
        if (count($carts)>0){
         foreach($carts as $cart)
         {
          $price+=$cart->product_price*$cart->quantity;
         }
         }
      }

      return $price;
   }

    public static function cartapp(){

    if (auth()->check()) {
        $user = auth()->user();
           $carts=Cart::where('user_id',$user->id)->get();
        if (count($carts)>0){
           return $carts;
        }
      }
   }

}
