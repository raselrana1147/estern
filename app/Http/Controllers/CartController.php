<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Auth;
use Session;
use App\Brand;
use App\Catgeory;
use App\Product;
use App\SubCategory;

class CartController extends Controller
{
    

    public function add_to_cart(Request $request)
    {

       $product=Product::where('id',$request->product_id)->first();
         
    		$customer = Session::get('CustomerSession');
            $customer_id=$customer->id;
    		$cart=Cart::where('user_id',$customer_id)
			    ->where('product_id',$request->product_id)
			    ->first();

			if (!is_null($cart)) {
        if ($cart->quantity > $product->quantity) {
            $message=['status'=>'error','msg'=>'Product out of stock'];
        }else{
              $cart->increment('quantity');
              $message=['status'=>'success','msg'=>'Cart is updated'];
        }
			

		}else{
			  $cart=new Cart();
			  $cart->product_id   =$product->id;

       // if ($request->quantity > $product->quantity ) {
         // $message=['status'=>'error','msg'=>'Product out of stock'];
      //  }else{
            if ($request->add_type==1) {
               $cart->quantity     =1;
          }else{
            $cart->quantity     =$request->quantity;
           }
       // }

        if ($request->has('color')) {
           $cart->color   =$request->color;
        }
			  
			  $cart->user_id      =$customer_id;
			  $cart->user_email   =$customer->email;
			  $cart->product_price=$product->price;
			  $cart->product_name =$product->name;
			  $cart->save();
			  $message=['status'=>'success','msg'=>'Product successfully added'];
		}

		return json_encode($message);	
    }

    public function get_all_cart_data(){
    	$customer  = Session::get('CustomerSession');
    	$carts = Cart::where('user_id', $customer->id)->get();
    	$price=0;
    	$totalitem=count($carts);
        if (count($carts)>0){
         foreach($carts as $cart) 
         {
          $price+=$cart->product_price*$cart->quantity;
         }
      }
    	$message=['status'=>'success', 'carts'=>$carts,'totalprice'=>$price,'totalitem'=>$totalitem];

    	return json_encode($message);	
    }

    public function cart_item(){
       
       if (Session::get('CustomerSession') =="") {
           return redirect(route('customer.login'));
        }  


        $category     = Catgeory::latest()->get();
        $sub_category = SubCategory::latest()->get();
        $brand        = Brand::latest()->get();

        $feature_product = Product::where('feature',1)->latest()->get()->random(3);

        $sale_product = Product::where('new_arrival',1)->latest()->get()->random(3);

        $top_product = Product::where('view_count','>=', 100)->latest()->get()->random(3);
        if (Session::has('CustomerSession')) {
             $customer = Session::get('CustomerSession');
             $cartItem=Cart::where('user_id',$customer->id)->get();
        }

        return view('cart',compact('category','brand','sub_category','feature_product','sale_product','top_product','cartItem'));
      }

      public function cart_update(Request $request){
               if ($request->isMethod('post')) {
                  $cart=Cart::findOrFail($request->cart_id);
                  $cart->update(['quantity'=>$request->quantity]);
                  $sub_price=$cart->quantity*$cart->product_price;
                  $message=['status'=>'success','msg'=>'Cart Item update','sub_price'=>$sub_price,'status_code'=>200]; 
               }
             echo json_encode($message);
        }

      public function cart_remove(Request $request){
          if ($request->isMethod("POST")) {
              $cart = Cart::findOrFail($request->cart_id);
              $cart->delete();
              $message=['status'=>'success','msg'=>'Cart Item Deleted','status_code'=>200]; 
          }

          echo json_encode($message);
      }
}
