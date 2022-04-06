<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;


class LoginController extends Controller
{
    public function login(Request $request)
    {

        $loginField = request()->input('email');

        $credentials = null;

        if ($loginField !== null) {
            $loginType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

            request()->merge([$loginType => $loginField]);

            $user = User::where('email', $loginField)->orwhere('phone', $loginField)->first();

            if (!is_null($user)) {
                if ($user->user_role_id == 1 || $user->user_role_id == 2 || $user->user_role_id == 3 || $user->user_role_id == 4 || $user->user_role_id == 5){

                    if ($user->is_active == 1){
                        $credentials = request([$loginType, 'password']);

                        if (! $token = JWTAuth::attempt($credentials)) {
                            return response()->json(['result' => 'Unauthorized'], 401);
                        }
                    }else{
                        return response()->json([
                            'message' => 'You are not active'
                        ],401);
                    }


                }else{
                    return response()->json([
                        'message' => 'Invalid email and password'
                    ]);
                }
            }else{
                return response()->json([
                    'result' => 'No account is found',
                    
                ],401);

            }

            

        }else {
            return response()->json([
                'message' => 'SomeThing Went Wrong'
            ]);
        }

        return $this->respondWithToken($token);

    }

    public function refresh()
    {
        return $this->respondWithToken(JWTAuth()->refresh());
    }

    public function respondWithToken($token)
    {
        return response()->json([
            'user' => auth()->user(),
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
