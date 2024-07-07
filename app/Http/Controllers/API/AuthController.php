<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191|regex:/^[A-Za-z0-9]{2,10}$/',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
            'password_confirmation' => 'required|same:password',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        $token = $user->createToken($user->email.'_Token')->plainTextToken;
    
        return response()->json([
            'status' => 200,
            'userName' => $user->name,
            'token' => $token,
            'message' => 'Registered Successfully',
        ]);
    }
    

public function login( Request $request)
{
$validator = Validator::make($request->all(),[
    'email'=>'required|max:191',
    'password' => 'required|min:8',

]);
if ($validator->fails()){
    return response()->json([
        'validation_errors'=>$validator->messages(),
    ]);
}
else{
$user = User::where('email',$request->email)->first();

if(! $user || ! Hash::check($request->password,$user->password))
{
    return response()->json([
        'status' => 401,
        'messages' => 'invalid Credentials ',
    ], 401);
}
else{
    $token = $user->createToken($user->email.'_Token')->plainTextToken;

    return response()->json([
        'status' => 200,
        'userName' => $user->name,
        'token' => $token,
        'message' => 'Loggedin Successfully',
    ]);
}

}
}

public function logout(Request $request)
{
    $user = $request->user();
    $user->tokens()->delete();

    return response()->json([
        'status' => 200,
        'message' => 'Logged out successfully',
    ]);
}

}
