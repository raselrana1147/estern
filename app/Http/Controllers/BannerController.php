<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Banner;
use Illuminate\Support\Facades\File;
use Image;


class BannerController extends Controller
{
    

    public function show_logo()
    {
    	 $banner=DB::table('banners')->first();
    	 return view('admin.banner.show_banner', compact('banner'));
    }


    public function update(Request $request)
    {
    	if ($request->isMethod('post'))
    	{
    	    DB::beginTransaction();

    	    try{

    	        //update banner

    	        $banner =Banner::findOrFail(1);
    	     
    	        if($request->hasFile('image')){

    	            $image = $request->file('image');
    	            if($image->isValid()){

    	            	if (File::exists(public_path().'/assets/banner/'.$banner->image)) 
    	            	{
    	            		File::delete(public_path().'/assets/banner/'.$banner->image);
    	            	}

    	                $extension = $image->getClientOriginalExtension();
    	                $filename = rand(111,99999).'.'.$extension;

    	                $image_path = public_path().'/assets/banner/'.$filename;

    	                //Resize Image
    	                Image::make($image)->save($image_path);

    	            }
    	        }

    	        $banner->image=$filename;
    	        $banner->save();

    	        DB::commit();

    	        return response()->json([
    	            'message' => 'Banner Updated Successful',
    	            'filename'=>$filename,
    	            'status_code' => 200
    	        ],200);
    	    }catch (QueryException $e){
    	        DB::rollBack();

    	        $error = $e->getMessage();

    	        return response()->json([
    	            'error' => $error,
    	            'status_code' => 500
    	        ], 500);
    	    }
    	}

    }
}
