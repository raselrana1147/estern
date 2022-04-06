<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catgeory;
use App\SubCategory;
use App\Brand;
use App\Product;
use App\Cart;
use Session;
use App\Order;
use App\OrderDetail;
use App\OrderPayment;
use App\Product_order;
use App\BillingInfo;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class OrderController extends Controller
{
    
    public function checkout_form(){

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

        return view('checkout',compact('category','brand','sub_category','feature_product','sale_product','top_product','cartItem'));
    	
    }

    public function checkout(Request $request){

    	$customer_name=$request->customer_name;
    	$customer_phone=$request->customer_phone;
    	$customer_address=$request->customer_address;
    	$order_note=$request->order_note;
    	$payment_method        =$request->payment_method;

    	$customer_account_number=$request->customer_account_number;
    	$transaction_number     =$request->transaction_number;
    	$order_number=rand(10000,99999);
    	$user = Session::get('CustomerSession');
    	$carts=Cart::cart();
    	$totalprice=Cart::totalprice();
    	$totalitem=Cart::totalitem();

    	//inser Order table
    	$order              =new Order();
    	$order->user_id     =$user->id;
    	$order->price       =$totalprice;
    	$order->quantity    =$totalitem;
    	$order->sub_total   =$totalprice;
    	$order->grand_total =$totalprice;
    	$order->order_number=$order_number;
    	if (!empty($request->order_note)) {
    		$order->order_note=$request->order_note;
    	}
    	 $order->save();
    	foreach ($carts as $cart) {
    		//insert into Order Details
    		$order_detail                  =new OrderDetail();
    		$order_detail->order_id        =$order->id;
    		$order_detail->product_id      =$cart->product_id;
    		$order_detail->user_id         =$user->id;
    		$order_detail->product_name    =$cart->product_name;
    	    $order_detail->product_image   =$cart->product->image;
    		$order_detail->product_price   =$cart->product_price;
    		$order_detail->product_quantity=$cart->quantity;
    		$order_detail->save();
    		//insert into product ordered
    		$pro_order=new Product_order();
    		$pro_order->order_id=$order->id;
    		$pro_order->product_id=$cart->product_id;
    		$pro_order->save();
    	}
    	// insert data into orderpayment table
    	$orderpayment=new OrderPayment();
    	$orderpayment->user_id=$user->id;
    	$orderpayment->order_id=$order->id;
    	if ($request->payment_method==="Cash On Delivery") {
    		$orderpayment->payment_type="Hand Cash";
    	}else{
    		$orderpayment->payment_type="Mobile Banking";
    	}
    	$orderpayment->payment_name=$request->payment_method;
    	if (!empty($request->transaction_number)) {
    		$orderpayment->transaction_number=$request->transaction_number;
    	}

    	if (!empty($request->customer_account_number)) {
    		$orderpayment->customer_number=$request->customer_account_number;
    	}
    	$orderpayment->payable_amount=$totalprice;
    	$orderpayment->save();
     // insert data into billing details table
    	$billingInfo=new BillingInfo();

    	$billingInfo->order_id=$order->id;
    	$billingInfo->customer_name=$customer_name;
    	$billingInfo->customer_phone=$customer_phone;
    	$billingInfo->customer_address=$customer_address;
    	
    	$billingInfo->save();
    	foreach (Cart::cart() as $c) {
    		$c->delete();
    	}
    	session()->flash('success_message','Your order Placed Successfully.Very Soon Our team will contact with you.Keep with us.Thank you');
    	return redirect(route('checkout.confirm'));

    }

    public function order_confirm(){
    	
            if (Session::has('CustomerSession')) {
    	   $customer = Session::get('CustomerSession');
   	  	   $carts=Cart::where('user_id',$customer->id)->get();
   	  	   if (Session::get('CustomerSession')=="" || is_null($carts)) {
   	  	   		return redirect(route('ecommerce'));
   	  	   }
    	}

    	$category        = Catgeory::latest()->get();
        $sub_category    = SubCategory::latest()->get();
        $brand           = Brand::latest()->get();
        $feature_product = Product::where('feature',1)->latest()->get()->random(3);
        $sale_product    = Product::where('new_arrival',1)->latest()->get()->random(3);
        $top_product     = Product::where('view_count','>=', 100)->latest()->get()->random(3);

    	return view('order_complete',compact('category','brand','sub_category','feature_product','sale_product','top_product'));
    }

    public function show_all_order(){
       return view('admin.order.index');
    }

   

   public function getData()
    {
        $order  = Order::latest()->get();

        return DataTables::of($order)
            ->addIndexColumn()
            ->addColumn('subtotal',function ($order){
                return '৳ '.$order->sub_total;
            })
             ->addColumn('grandtotal',function ($order){
                return '৳ '.$order->grand_total;
            })
            ->addColumn('totalproduct',function ($order){
                return $order->quantity;
            })
             ->addColumn('orderedat',function ($order){
                return $order->created_at->diffForHumans();
            })
              ->addColumn('paymentname',function ($order){
                return $order->payment->payment_name;
            })
                ->addColumn('paymenttype',function ($order){
                return $order->payment->payment_type;
            })
              ->addColumn('transactionid',function ($order){
                return ($order->payment->payment_name !='Cash On Delivery') ? $order->payment->transaction_number : 'null';
            })
                ->addColumn('paidfrom',function ($order){
                 return ($order->payment->payment_name !='Cash On Delivery') ? $order->payment->customer_number : 'null';
            })
            ->addColumn('status',function ($order){
               return '<select style="background:#ddd;" id="order_status" name="order_status" order_id="'.$order->id.'" data-action="'.route('chanage.order.status').'">
                            <option '.(($order->status==1) ? 'selected' : '').' value="1">Pending</option>
                            <option '.(($order->status==2) ? 'selected' : '').' value="2">Processing</option>
                            <option '.(($order->status==3) ? 'selected' : '').' value="3">Shipment</option>
                        </select>';
            })
            ->editColumn('action', function ($order) {
                        return '<a href="'.route('order.details',$order->id).'" title="View Order detail" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                                      <i class="fa fa-eye"></i>
                                </a> <a href="'.route('order.invoice',$order->id).'" title="Generate Invoice" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                                     <i class="fas fa-file-invoice"></i>
                               ';
            })
            ->rawColumns([
                'subtotal','grandtotal','quantity','orderedat','status','action'
            ])
            ->make(true);
    }

      public function change_status(Request $request){
               
                if($request->isMethod('post')){
                    $order=Order::findOrFail($request->order_id);
                    $order->update(['status'=>$request->status]);
                    $message=['status'=>'success','msg'=>'Successfully updated'];
                    
                }

            echo json_encode($message);
               
        }

        public function order_detail($id){
                $order_details=OrderDetail::where('order_id',$id)->get();
                return view('admin.order.order_detail',compact('order_details'));
        }

    

     public function invoice($id){
           $order_details=OrderDetail::where('order_id',$id)->get();
           $order=Order::findOrFail($id);
            $billing=BillingInfo::where('order_id',$id)->first();
              $payment=OrderPayment::where('order_id',$id)->first();
            return view('admin.order.invoice',compact('order_details','order','billing','payment'));
    }


    
}
