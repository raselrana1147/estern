<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Warranty;
use App\BranchOffice;
use App\HeadOffice;
use App\Product;
class WarrantyController extends Controller
{
    

    public function add_warranty(Request $request)
    {
    	$validate=$request->validate([
    		'mobile_number'=>'required',
    		'product_detail'=>'required',
    		'start_date'=>'required',
    		'end_date'=>'required',
    		'price'=>'required',
    	]);
    	if ($request->isMethod("post")) {
    		DB::beginTransaction();
    		try {
    			$warranty               =new Warranty();
    			$warranty->mobile_number =$request->mobile_number;
    			$warranty->product_detail=$request->product_detail;
    			$warranty->start_date    =$request->start_date;
    			$warranty->end_date      =$request->end_date;
    			$warranty->price         =$request->price;
    			$warranty->save();
    			DB::commit();
    			return \response()->json([
    			    'message' => "Successfully added",
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



    public function get_warranty(Request $request)
    {


    	$validate=$request->validate([
    		'mobile_number'=>'required',
       	]);
    	
    	$warranties=DB::table("warranties")
    	->where("mobile_number",$request->mobile_number)
    	->orderBy("id","DESC")
    	->get();
    	return \response()->json([
    	    'warranties' => $warranties,
    	    'status_code' => 200
    	], Response::HTTP_OK);
    }

    public function get_address()
    {
        $branch_offices=BranchOffice::latest()->get();
        $head=HeadOffice::first();
        $data=array(
                'place'=>$head->place,
                'email'=>$head->email,
                'website'=>$head->website,
                'facebook'=>$head->facebook,
                'youtube'=>$head->youtube,
                'status_code' => 200,
                'branch_offices'=>$branch_offices
            );

        return \response()->json([
            'data' => $data,
        ], Response::HTTP_OK);

    }

    public function search_product(Request $request)
    {

          // $this->validate($request,[
          //    'search_key'=>'required'
          //  ])

          if ($request->has('search_key')) {
             $product = Product::where('name','LIKE','%'.$request->search_key.'%')
                      ->paginate(1,['*'],"page",$request->page);
                    
                      return response()->json([
                         'data' => $product,
                         'status' => 200],
                         Response::HTTP_OK);
          }else{
            return response()->json([
               'data' => "Please Enter valid search key",
               'status' => 423],
               Response::HTTP_OK);
        }
        
           
        
          



            //$works=Advertisement::inRandomOrder()
               //   ->paginate(12,['*'],"page",$request->page);

          // $product=Product::where('name','LIKE','%'.$request->search_key.'%')
          //           ->offset($request['start'])
          //           ->limit($request['limit'])->orderBy('id','DESC')
          //           ->paginate(12);
    }
}