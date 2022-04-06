<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

        
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        if ($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                //create user

                $user = new User();

                $user->name = $request->name;
                $user->email = $request->email;
                $user->user_role_id = $request->user_role_id;
                $user->phone = $request->phone;
                $user->password = bcrypt($request->password);

                if (!empty($request->is_active))
                {
                    $user->is_active = 1;
                }else{
                    $user->is_active = 0;
                }

                $user->save();

                DB::commit();

                return response()->json([
                    'message' => 'Register Successful',
                    'status_code' => 200
                ], Response::HTTP_OK);
            }catch (QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return \response()->json([
                    'error' => $error,
                    'status_code' => 500
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }
}
