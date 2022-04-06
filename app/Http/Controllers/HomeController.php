<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use DB;
use Image;
use File;
use DataTables;
class HomeController extends Controller
{

    public function index()
    {
        return view('admin.dashboard');
    }

    public function show_password_form(){

   			return view('admin.profile.password');
    }

    public function password_update(Request $request,$id){
    	
    	 $request->validate([
            'password' => 'required|confirmed',
        ]);

        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                $user = User::findOrFail($id);

                $user->password = bcrypt($request->password);

                $user->save();

                DB::commit();

                return response()->json([
                    'message' => 'User password Change Successful',
                    'status_code' => 200
                ], 200);
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


    public function show_profile_form(){
   		return view('admin.profile.profile');
    }

    

     public function update(Request $request, $id)
    {

    	//dd($request->all());
        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{
                //create rider
                $user = User::findOrFail($id);
                $user->name = $request->name;
                $user->email = $request->email;
                if($request->hasFile('image')){
                    $image_tmp = $request->file('image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = rand(111,99999).'.'.$extension;                     
                        $image_path = public_path().'/assets/users/'.$filename;
                        //Resize Image
                        if (File::exists('/assets/users/'.$user->image)) {
                        	unlink('/assets/users/'.$user->image);
                        }
                        Image::make($image_tmp)->resize(100,75)->save($image_path);
                    }
                }else{
                    $filename = $request->current_image;
                }

                $user->image = $filename;
                $user->phone = $request->phone;
               
                $user->save();

                DB::commit();

                return response()->json([
                    'message' => 'User Updated Successful',
                    'status_code' => 200
                ]);
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

    public function create_user(){
    	return view('admin.profile.create_user');
    }

     public function user_store(Request $request)
    {

    	//dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'phone' => 'required'
        ]);

        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{
                //create rider

                $user = new User();

                $user->name = $request->name;
                $user->email = $request->email;


                if($request->hasFile('image')){

                    $image_tmp = $request->file('image');
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = rand(111,99999).'.'.$extension;

                        $image_path = public_path().'/assets/users/'.$filename;

                        //Resize Image
                      
                        Image::make($image_tmp)->resize(100,75)->save($image_path);
                        $user->image = $filename;

                    }
                }

                $user->phone = $request->phone;
                $user->user_role_id = 1;
                $user->password = bcrypt($request->password);

                $user->save();

                $last_id = DB::getPdo()->lastInsertId();

                DB::commit();

                return response()->json([
                    'message' => 'User Added Successful',
                    'status_code' => 200
                ]);
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


    public function all_user(){
    	return view('admin.profile.index');
    }


     public function getData()
    {
       $user=User::where('user_role_id',1)->latest()->get();

        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('image',function ($user){
                if ($user->image)
                {
                    $url=asset("assets/users/$user->image");
                    return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';
                }

            })
            ->addColumn('name',function ($user){
                return $user->name;

            })

            ->addColumn('email',function ($user){
               
            	 return $user->email;
            })
             ->addColumn('phone',function ($user){
               
            	 return $user->phone;
            })
            ->editColumn('action', function ($user) {
            	if ($user->id===auth()->user()->id) {
            		return '<span class="badge badge-danger">My Profile Info</span>';
            	}else{
                return '<a href="'.route('user.edit',$user->id).'" title="View Order detail" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                                      <i class="fa fa-edit"></i></a> 
                                      <a href="javascript:;" data-action="'.route('user.destroy').'"title="View Order detail" rel="'.$user->id.'" class="btn btn-sm btn-clean btn-icon btn-icon-md deleteRecord" title="View">
                                      <i class="fa fa-trash"></i></a>';
                                   }
            })
            ->rawColumns([
                'action','image','name','email','phone'
            ])
            ->make(true);
    }


    public function edit_form($id){
    		$user=User::findOrFail($id);

    		return view('admin.profile.edit',compact('user'));

    }

    public function user_edit(Request $request, $id){

    	if ($request->isMethod('post'))
    	{
    	    DB::beginTransaction();

    	    try{
    	       
    	        $user = User::findOrFail($id);

    	        $user->name = $request->name;
    	        $user->email = $request->email;


    	        if($request->hasFile('image')){

    	            $image_tmp = $request->file('image');
    	            if($image_tmp->isValid()){
    	                $extension = $image_tmp->getClientOriginalExtension();
    	                $filename = rand(111,99999).'.'.$extension;

    	              
    	                $image_path = public_path().'/assets/users/'.$filename;
    	                if (File::exists('/assets/users/'.$user->image)) {
    	                	unlink('/assets/users/'.$user->image);
    	                }

    	                Image::make($image_tmp)->resize(100,75)->save($image_path);

    	            }
    	        }else{
    	            $filename = $request->current_image;
    	        }

    	        $user->image = $filename;
    	        $user->phone = $request->phone;
    	      
    	        $user->save();

    	        DB::commit();

    	        return response()->json([
    	            'message' => 'User Updated Successful',
    	            'status_code' => 200
    	        ]);
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

    public function destroy(Request $request){
    		
    		$user = User::where('id',$request->id)->first();

    		if ($user->image != null)
    		{
    		    
    		    $small = public_path().'/assets/users/'.$user->image;

    		    unlink($small);
    		}
    		$user->delete();

    		return response()->json([
    		    'message' => 'Rider Deleted Successful',
    		    'status_code' => 200
    		], 200);
    }


      public function delete_image(Request $request)
    {
         
         
        $user = User::findOrFail($request->id);

        if ($user->image != null)
        {
            $small = public_path().'/assets/users/'.$user->image;
            unlink($small);
        }

         $user->update(['image' => null]);

        return response()->json([
            'message' => 'User Image Destroy Successful',
            'status_code' => 200
        ], 200);
    }

    public function user_image_profile(Request $request){

                    $user = User::findOrFail($request->id);

                    if ($user->image != null)
                    {
                        $small = public_path().'/assets/users/'.$user->image;
                        unlink($small);
                    }

                     $user->update(['image' => null]);

                    return response()->json([
                        'message' => 'User Image Destroy Successful',
                        'status_code' => 200
                    ], 200);
        }




}
