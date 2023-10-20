<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUser;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LogUserRequest;

class UserController extends Controller
{
    public function register(RegisterUser $request)
     {

        try {
            $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;

        $user->password = Hash::make($request->password, [
             'rounds' => 12
        ]);
        $user->save();

        return response()->json([
            'status-code' =>200,
            'status_message' =>'utilisateur enregistrer',
            'user' => $user
          
        ]);

        } catch (Exception $e) {
            return response()->json($e);
        }
        
    }

    public function login(LogUserRequest $request) {
        if(auth()->attempt($request->only(['email','password'])))
        { 
        $user = auth()->user();
   
        $token = $user->createToken('MA CLE_VISIBLE_BACKEND')
        ->plainTextToken;
        
        return response()->json([
           'status-code' =>200,
           'status_message' =>'utilisateur connecte', 
          'user'=>$user,
          'token'=>$token
        ]);
    }
    else {
        // si les  info ne correspondent a aucun utilisateur
        return response()->json([
            'status-code' =>403,
            'status_message' =>'information non valide',
            'user'=>$user,
            'token'=>$token 
           
        ]);
    
        }
    }
}
