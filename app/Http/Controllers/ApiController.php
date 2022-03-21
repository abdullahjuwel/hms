<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
     public function __construct(){
        $this->middleware('jwt.verify', ['except' => ['login']]);
    }
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
    		'email' => 'required|email',
    		'password' => 'required|string|min:6',
    	]);

    	if ($validator->fails()) {
    		return response()->json($validator->errors(), 422);
    	}

    	// if (! $token = auth('api')->attempt($validator->validated())) {
    	// 	return response()->json(['error' => 'Unauthorized'], 401);
    	// }

     //    return $this->respondWithToken($token);

    	$credentials = $request->only('email', 'password');

    	if ($token = JWTAuth::attempt($credentials)) {
    		return $this->respondWithToken($token);
    	}
    	return response()->json(['error' => 'Username Or Password does not match!'], 401);
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token){
    	return response()->json([
    		'access_token' => $token,
    		'token_type' => 'bearer',
    		'expires_in' => auth('api')->factory()->getTTL() * 60,
    		'user' => auth()->user()
    	]);
    }
    public function userProfile(Request  $req) {
        return json_encode('fff');
    }
    public function postUserProfile(Request $req){
    	return json_encode('post user');
    }
    public function me(){
        return response()->json(auth('api')->user());
    }
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }


    // /**
    //  * Create a new AuthController instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('jwt.verify', ['except' => ['login']]);
    // }

    // /**
    //  * Get a JWT via given credentials.
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function login()
    // {
    //     $credentials = request(['email', 'password']);

    //     if (! $token = auth()->attempt($credentials)) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     return $this->respondWithToken($token);
    // }

    // /**
    //  * Get the authenticated User.
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function me()
    // {
    //     return response()->json(auth()->user());
    // }

    // *
    //  * Log the user out (Invalidate the token).
    //  *
    //  * @return \Illuminate\Http\JsonResponse
     
    // public function logout()
    // {
    //     auth()->logout();

    //     return response()->json(['message' => 'Successfully logged out']);
    // }

    // /**
    //  * Refresh a token.
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function refresh()
    // {
    //     return $this->respondWithToken(auth()->refresh());
    // }

    // /**
    //  * Get the token array structure.
    //  *
    //  * @param  string $token
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // protected function respondWithToken($token)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth()->factory()->getTTL() * 60
    //     ]);
    // }


}
