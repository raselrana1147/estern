<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JWTAuth;
use Session;

class LogOutController extends Controller
{
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
    	
        auth()->logout();

        return response()->json([
            'message' => 'Logout Successful',
            'status_code' => 200
        ], Response::HTTP_OK);
     }
}
