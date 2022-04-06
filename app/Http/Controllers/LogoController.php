<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Image;
use App\Logo;

class LogoController extends Controller
{
    


    public function show_logo()
    {
    	 $logo=DB::table('logos')->first();
    	 return view('admin.logo.show_logo', compact('logo'));
    }


    public function update(Request $request)
    {
    	if ($request->isMethod('post'))
    	{
    	    DB::beginTransaction();

    	    try{

    	        

    	        //cretae brand

    	        $logos =Logo::findOrFail(1);
    	      

    	        if($request->hasFile('logo')){

    	            $logo = $request->file('logo');
    	            if($logo->isValid()){

    	            	if (File::exists(public_path().'/assets/logo/'.$logos->logo)) 
    	            	{
    	            		File::delete(public_path().'/assets/logo/'.$logos->logo);
    	            	}

    	                $extension = $logo->getClientOriginalExtension();
    	                $filename = rand(111,99999).'.'.$extension;

    	                $image_path = public_path().'/assets/logo/'.$filename;

    	                //Resize Image
    	                Image::make($logo)->save($image_path);

    	            }
    	        }

    	        $logos->logo=$filename;
    	        $logos->save();

    	        DB::commit();

    	        return response()->json([
    	            'message' => 'Logo Updated Successful',
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
