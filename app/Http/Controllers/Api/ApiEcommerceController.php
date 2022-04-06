<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use App\Cart;
use App\Catgeory;
use App\Cupon;
use App\Http\Controllers\Controller;
use App\Product;
use App\Quote;
use App\Service;
use App\ServiceType;
use App\Stock;
use App\StockBrand;
use App\StockCategory;
use App\StockModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\OrderDetail;
use App\Product_order;
use App\OrderPayment;
use App\BillingInfo;

class ApiEcommerceController extends Controller
{
    public function category()
    {
        $category = Catgeory::with('subcat')->latest()->get();

        return response()->json([
            'all_category' => $category,
            'status_code' => 200
        ], Response::HTTP_OK);
    }

    public function brand()
    {
         
        $brands = Brand::latest()->get();

        return response()->json([
            'brands' => $brands,
            'status_code' => 200
        ], Response::HTTP_OK);
    }

    public function product()
    {
        $products = Product::with('category','brand','subcategory')->latest()->get();

        return response()->json([
            'products' => $products,
            'status_code' => 200
        ], Response::HTTP_OK);
    }

    public function details($id)
    {
        $product = Product::with('category','brand','subcategory')->where('id',$id)->first();

        $product_image = DB::table('product_image')->where('product_image.product_id', $id)->get();

        $color = explode(',',$product->color);

        return response()->json([
            'product' => $product,
            'product_image' => $product_image,
            'color' => $color,
            'status_code' => 200
        ], Response::HTTP_OK);
    }

    public function productCategory($category_id)
    {
        $product_category = Product::with('category','brand','subcategory')->where('category_id',$category_id)->get();

        return response()->json([
            'productCategory' => $product_category,
            'status_code' => 200
        ], Response::HTTP_OK);
    }

    public function productSubCategory($sub_category_id)
    {
        $product_sub_category = Product::with('category','brand','subcategory')->where('sub_cat_id',$sub_category_id)->get();

        return response()->json([
            'productSubCategory' => $product_sub_category,
            'status_code' => 200
        ], Response::HTTP_OK);
    }

    public function productBrand($brand_id)
    {
        $product_brand = Product::with('category','brand','subcategory')->where('brand_id',$brand_id)->get();

        return response()->json([
            'productBrand' => $product_brand,
            'status_code' => 200
        ], Response::HTTP_OK);
    }

    public function userComplain(Request $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create complain
                DB::table('complain')->insert([
                    'user_id' => $request->user_id,
                    'details' => $request->details,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::commit();

                return response()->json([
                    'message' => 'Complain Submitted Successful',
                    'status_code' => 200
                ],Response::HTTP_OK);
            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function StockCategory()
    {
        $stockCategory = StockCategory::latest()->get();

        return response()->json([
            'stockCategory' => $stockCategory,
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function StockBrand()
    {
        $stockBrand = StockBrand::latest()->get();

        return response()->json([
            'stockBrand' => $stockBrand,
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function StockModel($brand_id)
    {
        $stockModel = StockModel::where('stock_brand_id',$brand_id)->latest()->get();

        return \response()->json([
            'stockModel' => $stockModel,
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function StockInventory(Request $request)
    {
        $category_id = $request->category_id;
        $brand_id = $request->brand_id;
        $model_id = $request->model_id;

        $user = User::findOrFail($request->id);

        $stock_inventory = [];

        if ($user->user_role_id == 1)
        {
            $stock_inventory = Stock::select('available','quality','color','variation','quantity','purchase_price','retail_price','whole_sale_price')
                ->where('stock_category_id',$category_id)
                ->orWhere('stock_brand_id', $brand_id)
                ->orWhere('stock_model_id',$model_id)
                ->first();

        }

        if ($user->user_role_id == 2)
        {
            $stock_inventory = Stock::select('available','quality','color','variation','quantity','purchase_price','retail_price','whole_sale_price')
                ->where('stock_category_id',$category_id)
                ->orWhere('stock_brand_id', $brand_id)
                ->orWhere('stock_model_id',$model_id)
                ->first();

        }

        if ($user->user_role_id == 4)
        {
            $stock_inventory = Stock::select('available','quality','color','variation','quantity','purchase_price','retail_price')
                ->where('stock_category_id',$category_id)
                ->orWhere('stock_brand_id', $brand_id)
                ->orWhere('stock_model_id',$model_id)
                ->first();

        }

        if ($user->user_role_id == 3)
        {
            $stock_inventory = Stock::select('available','quality','color','variation','quantity','purchase_price')
                ->where('stock_category_id',$category_id)
                ->orWhere('stock_brand_id', $brand_id)
                ->orWhere('stock_model_id',$model_id)
                ->first();
        }

           return response()->json([
               'stockInventory' => $stock_inventory,
               'status_code' => 200
           ]);
       
            
        
    }

    public function serviceType()
    {
        $service_type = ServiceType::latest()->get();

        return \response()->json([
            'serviceType' => $service_type,
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function service(Request $request)
    {
        $service_type_id = $request->service_type_id;
        $brand_id = $request->brand_id;
        $model_id = $request->model_id;

        $service = Service::where('service_type_id',$service_type_id)->orWhere('brand_id', $brand_id)->orWhere('model_id',$model_id)->first();

        return response()->json([
            'service' => $service,
            'status_code' => 200
        ], Response::HTTP_OK);
    }

    public function quote(Request $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create quote
                $quote = new Quote();

                $quote->user_id = $request->user_id;
                $quote->stock_category_id = $request->stock_category_id;
                $quote->stock_brand_id = $request->stock_brand_id;
                $quote->stock_model_id = $request->stock_model_id;
                $quote->problem_details = $request->problem_details;
                $quote->phone = $request->phone;
                $quote->coupon_code = $request->coupon_code;

                $quote->save();

                $quote_id = DB::getPdo()->lastInsertId();

                DB::table('customer_services')->insert([
                    'quote_id' => $quote_id,
                    'service_id' => '#'.rand(1111,9999),
                    'amount' => 0,
                    'total' => 0,
                    'sub_total' => 0,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);

                DB::commit();

                return response()->json([
                    'message' => 'Quote added successful',
                    'status_code' => 200
                ],Response::HTTP_OK);

            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function pickUp(Request $request)
    {
        $service_id = $request->service_id;

        $quote = DB::table('quotes')
                    ->select(
                        'quotes.id as id',
                        'stock_categories.stock_category_name as stock_category_name',
                        'stock_brands.stock_brand_name as stock_brand_name',
                        'stock_models.model_name as model_name',
                        'quotes.problem_details as problem_details',
                        'customer_services.amount as service_charge',
                        'customer_services.sub_total as sub_total',
                        'customer_services.service_id as service_id',
                        'cupons.coupon_amount as coupon_amount'
                    )
                    ->join('customer_services','quotes.id','=','customer_services.quote_id')
                    ->join('cupons','customer_services.coupon_code','=','cupons.coupon_code')
                    ->join('stock_categories','quotes.stock_category_id','=','stock_categories.id')
                    ->join('stock_brands','quotes.stock_brand_id','=','stock_brands.id')
                    ->join('stock_models','quotes.stock_model_id','=','stock_models.id')
                    ->where('customer_services.service_id', $service_id)
                    ->first();

        return response()->json([
            'service_info' => $quote,
            'pickup_cost' => 60,
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function servicePickUp(Request $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create pick up

                DB::table('pick_up')->insert([
                    'service_id' => $request->service_id,
                    'address' => $request->address,
                    'pick_up_cost' => $request->pickup_cost,
                    'sub_total' => $request->sub_total,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::commit();

                return response()->json([
                    'message' => 'Pick up request added successful',
                    'status_code' => 200
                ],Response::HTTP_OK);
            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function dropUp(Request $request)
    {
        $service_id = $request->service_id;

        $quote = DB::table('quotes')
            ->select(
                'quotes.id as id',
                'stock_categories.stock_category_name as stock_category_name',
                'stock_brands.stock_brand_name as stock_brand_name',
                'stock_models.model_name as model_name',
                'quotes.problem_details as problem_details',
                'customer_services.service_id as service_id'
            )
            ->join('customer_services','quotes.id','=','customer_services.quote_id')
            ->join('stock_categories','quotes.stock_category_id','=','stock_categories.id')
            ->join('stock_brands','quotes.stock_brand_id','=','stock_brands.id')
            ->join('stock_models','quotes.stock_model_id','=','stock_models.id')
            ->where('customer_services.service_id', $service_id)
            ->first();

        return response()->json([
            'service_info' => $quote,
            'dropUp_cost' => 250,
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function serviceDropUp(Request $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create drop up cost

                DB::table('drop_up')->insert([
                    'service_id' => $request->service_id,
                    'address' => $request->address,
                    'drop_up_cost' => $request->drop_up_cost,
                    'sub_total' => $request->sub_total,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::commit();

                return response()->json([
                    'message' => 'Drop up cost added successful',
                    'status_code' => 200
                ],Response::HTTP_OK);
            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function payment(Request $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create service payemnt

                DB::table('service_payment')->insert([
                    'service_id' => $request->service_id,
                    'customer_id' => $request->customer_id,
                    'payment_type' => $request->payment_type,
                    'payable_amount' => $request->payable_amount,
                    'mobile' => $request->mobile,
                    'transaction_id' => $request->transaction_id,
                    'payment_status' => 0,
                    'payment_date' => $request->payment_date,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                DB::commit();

                return response()->json([
                    'message' => 'Payment added successful',
                    'status_code' => 200
                ],Response::HTTP_OK);

            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function addToCart(Request $request)
    {
        $customer = User::findOrFail($request->user_id);
        $customer_id = $customer->id;
        $cart=Cart::where('user_id',$customer_id)
            ->where('product_id',$request->product_id)
            ->first();

        if (!is_null($cart)) {
            $product = Product::where('id',$cart->product_id)->first();
            if ($product->quantity <= $cart->quantity)
            {
                return response()->json([
                    'message' => 'Product quantity stock out',
                    'status' => 200
                ],Response::HTTP_OK);
            }else{
                $cart->increment('quantity');
                return response()->json([
                    'message' => 'Cart is updated',
                    'status' => 200
                ],Response::HTTP_OK);
            }

        }else{
            $product=Product::where('id',$request->product_id)->first();
            $cart=new Cart();
            $cart->product_id   =$product->id;
            if ($request->add_type==1) {
                $cart->quantity     =1;
            }else{
                $cart->quantity     =$request->quantity;
            }
            if ($request->has('color')) {
                $cart->color   =$request->color;
            }

            $cart->user_id      =$customer_id;
            $cart->user_email   =$customer->email;
            $cart->product_price=$product->price;
            $cart->product_name =$product->name;
            $cart->save();
        }

        return response()->json([
            'message' => 'Product successfully added to cart',
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function getCart(Request $request)
    {
        //$user = User::findOrFail($request->user_id);

        //$cart = Cart::with('product:id,image')->where('user_id',$request->user_id)->get();

        $carts=DB::table('carts')
        ->join('products','carts.product_id','=','products.id')
        ->select('carts.*','products.image')
        ->where('user_id',$request->user_id)
        ->get();


        $price=0;
        $totalitem=count($cart);
        if (count($cart)>0){
            foreach($cart as $c)
            {
                $price+=$c->product_price*$c->quantity;
            }
        }

        return response()->json([
            'cartItem' => $cart,
            'totalPrice' => $price,
            'totalItem' => $totalitem,
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function update_quantity(Request $request)
    {
        if ($request->isMethod('post'))
        {

            $carts = Cart::findOrFail($request->cart_id);

            $product = Product::findOrFail($carts->product_id);

            if ($product->quantity < $request->quantity)
            {
                return \response()->json([
                    'message' => 'Product stock is out',
                    'status_code' => 200
                ],Response::HTTP_OK);
            }else{
                $carts->update(['quantity' => $request->quantity]);

                $total = $carts->product_price * $carts->quantity;

                return response()->json([
                    'message' => 'Cart updated successful',
                    'cart_total' => $total,
                    'status_code' => 200
                ],Response::HTTP_OK);
            }
        }

    }

    public function removeCart(Request $request)
    {

        $cart = Cart::where('id',$request->cart_id);

        $cart->delete();

        return response()->json([
            'message' => 'Cart item remove successful',
            'status_code' => 200
        ],Response::HTTP_OK);

    }

    public function coupons(Request $request)
    {

       $current_date=Carbon::now()->format('Y-m-d');
        $user = User::findOrFail($request->user_id);

        if ($user->user_role_id == 2){

            $data = Cupon::
            where('start_date','<=',$current_date)
            ->where('end_date','>=',$current_date)
            ->latest()->get();
            
            if (count($data)>10) {
           
            $coupons=[];
            foreach ($data as  $coupon) {
                $check_coupon=DB::table('user_coupons')
                ->where('user_id',$request->user_id)
                ->where('coupon_id',$coupon->id)
                ->first();

                if (is_null($check_coupon)) {
                    $single_coupon=[
                        'id'=>$coupon->id,
                        'coupon_code'=>$coupon->coupon_code,
                        'coupon_amount'=>$coupon->coupon_amount,
                        'start_date'=>$coupon->start_date,
                        'end_date'=>$coupon->end_date,
                        'image'=>$coupon->image,
                        'created_at'=>$coupon->created_at,
                        'created_at'=>$coupon->created_at
                       
                    ];
                     array_push($coupons, $single_coupon);
                }
               
            }
            return response()->json([
                'coupons' => $coupons,
                'status_code' => 200
            ],Response::HTTP_OK);
        }else{
             return response()->json([
                 'coupons' => "No Coupon is available",
                 'status_code' => 401
             ],Response::HTTP_OK);     
        }

        }
    }

    public function getCoupon(Request $request)
    {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //user store coupon

                $check_coupon=DB::table('user_coupons')
                ->where('coupon_id',$request->coupon_id)
                ->where('user_id',$request->user_id)
                ->first();
                if (is_null($check_coupon)) 
                {
                    DB::table('user_coupons')->insert([
                        'coupon_id' => $request->coupon_id,
                        'user_id' => $request->user_id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);

                    DB::commit();

                    return \response()->json([
                        'message' => 'Coupon added successful',
                        'status_code' => 200
                    ],Response::HTTP_OK);
                }else{
                    return \response()->json([
                        'message' => 'You have already added',
                        'status_code' => 302
                    ],Response::HTTP_OK);
                }

               

            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ],Response::HTTP_OK);
            }
        }
    }


    public function get_my_coupon($id)
    {
        $coupons=DB::table('user_coupons')
         ->select( 'user_coupons.*','cupons.*'
                  , 'cupons.created_at as coupon_created_at',
                  'cupons.updated_at as coupon_updated_at')
         ->join( 'cupons', 'user_coupons.coupon_id', '=', 'cupons.id' )
         ->where('user_id',$id)->get();

        return \response()->json([
            'data' => $coupons,
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function order(Request $request)
    {

        $check_cart=Cart::cartapp();
        if (!is_null($check_cart)) {
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create order

                $customer_name=$request->customer_name;
                $customer_phone=$request->customer_phone;
                $customer_address=$request->customer_address;
                $order_note=$request->order_note;
                $payment_method=$request->payment_method;

                $customer_account_number=$request->customer_account_number;
                $transaction_number     =$request->transaction_number;
                $order_number=rand(10000,99999);
                $user = User::findOrFail($request->user_id);
                
                $carts=Cart::cartapp();
                $totalprice=Cart::totalpriceapp();
                $totalitem=Cart::totalitemapp();


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
                foreach (Cart::cartapp() as $c) {
                    $c->delete();
                }
                DB::commit();

                return response()->json([
                    'message' => 'Order added successful',
                    'status_code' => 200
                ],Response::HTTP_OK);

            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        }else{
            return response()->json([
                'message' =>"No Item in your cart",
                'status_code' => 403
            ],403);
        }
    }


    public function get_user(Request $request)
    {
         $user=User::findOrFail($request->user_id);

         return response()->json([
             'user' => $user,
             'status_code' => 200
         ],Response::HTTP_OK);

    }

    
}
