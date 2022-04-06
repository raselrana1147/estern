<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use App\Message;

class MessageController extends Controller
{
    



    public function send_message(Request $request)
    {
    	$this->validate($request,[
    		'user_id'=>'required',
    		'content'=>'required',
    	]);
    	if ($request->isMethod('post')){
    		DB::beginTransaction();
    		try {
    			$data=DB::table('messages')->insert([
    				'user_id'=>$request->user_id,
    				'content'=>$request->content,
    				'type'=>"message",
    				'is_seen'=>0
    			]);
    			DB::commit();
    			return response()->json([
    			    'message' => "Your message send successfully",
    			    'status_code' => 200
    			],Response::HTTP_OK);
    			
    		} catch (QueryException $e) {
    			DB::rollBack();
    			return response()->json([
    			    'error' => $error,
    			    'status_code' => 500
    			],Response::HTTP_INTERNAL_SERVER_ERROR);
    		}
    		
    	}
     
    }

    public function get_message($user_id)
    {
    	$messages=Message::with('replies:id,content,parent_id')->where('user_id',$user_id)->orderBy('id','DESC')->get();
    	return response()->json([
    	    'message' => $messages,
    	    'status_code' => 200
    	],Response::HTTP_OK);
    }
    
}
