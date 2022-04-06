<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Message;

class MessageController extends Controller
{
    


	public function datatable()
	{
		$message = Message::whereNull('parent_id')
		->where('type','message')
		->latest()->get();
		

		return DataTables::of($message)
		    ->addIndexColumn()
		    ->editColumn('sender',function($message){
		    	if ($message->user_id !=null) 
		    	{
		    		return $message->user->name;
		    	}
		    })
		    ->editColumn('action', function ($message) {
		        $return = '<a href="'.route('admin.reply_message',$message->id).'" class="btn btn-success btn-sm">Reply</a>';
		        return $return;
		    })
		    ->rawColumns([
		        'action','sender'
		    ])
		    ->make(true);
	}

    public function get_message()
    {
    	return view('admin.message.index');
    }

    public function reply_message($id)
    {
    	$data=Message::findOrFail($id);
    	return view('admin.message.reply_message',compact('data'));
    }

    public function reply_submit(Request $request)
    {
    	$data=Message::findOrFail($request->id);
    	$data->is_seen=1;
    	$data->save();
    	//====reply message======
        $message=new Message();
    	$message->content=$request->content;
    	$message->parent_id=$request->id;
    	$message->type="reply";
    	$message->is_seen=0;
    	$message->save();

    	return response()->json([
    	    'message' => 'Successfully replied',
    	    'status_code' => 200
    	], 200);

    }
}
