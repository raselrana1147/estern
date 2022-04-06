<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Str;
use App\User;
use Image;
use App\Order;
use App\OrderDetail;
class ProfileController extends Controller
{
    
    public function get_user(Request $request)
    {
         $user=User::findOrFail($request->user_id);

         return response()->json([
             'user' => $user,
             'status_code' => 200
         ],Response::HTTP_OK);

    }

    public function update_user(Request $request)
    {
    	$user=User::findOrFail($request->user_id);

    	$this->validate($request,[
    		'name'=>'required',
    		'email'=>'nullable|unique:users,email,'.$user->id,
    		'image'=>'nullable',
    	]);

    	if ($request->isMethod("POST")) {
    		DB::beginTransaction();
    		try {
    			$user->name=$request->name;
    			$user->email=$request->email;
    			if($request->hasFile('image'))
    			{
                    if (File::exists(public_path().'/assets/users/'.$user->image)) {
                         File::delete(public_path().'/assets/users/'.$user->image);
                    }
    			        // upload new image
    			        $image=$request->image;
    			        $image_name=strtolower(Str::random(10)).time().".".$image->getClientOriginalExtension();
    			        $image_path = public_path().'/assets/users/'.$image_name;
    			        //Resize Image
    			        Image::make($image)->resize(465,465)->save($image_path);
    			        $user->image = $image_name;
    			    
    			}
    			$user->save();
    			  DB::commit();
    			return \response()->json([
    			    'message' => "Successfully updated",
    			    'status_code' => 200
    			], Response::HTTP_OK);
    			
    		} catch (QueryException $e) {
    			DB::rollback();
    			$error = $e->getMessage();

    			return \response()->json([
    			    'error' => $error,
    			    'status_code' => 500
    			], Response::HTTP_INTERNAL_SERVER_ERROR);
    		}
    	}
    }


    public function my_order(Request $request)
    {
         $orders=Order::where('user_id',$request->user_id)
         ->orderBy('id','DESC')
          ->paginate(10,['*'],"page",$request->page);

         return response()->json([
             'data' => $orders,
             'status' => 200],
             Response::HTTP_OK);
    }

    public function order_detail($id)
    {
       $datas=DB::table('order_details')
       ->where('order_id',$id)
       ->select('order_details.id','order_details.product_name','order_details.product_image','order_details.product_price','order_details.product_quantity')
       ->get();
       $total=0;
       foreach ($datas as  $data) 
       {
         $total+=$data->product_price*$data->product_quantity;
       }

       return response()->json([
           'data' => $datas,
           'status' => 200,
           'total'=>$total
         ],
           Response::HTTP_OK);
    }
}
