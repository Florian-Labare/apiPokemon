<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

class AuthController extends Controller
{    
    /**
     * register store
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function register(Request $request) : JsonResponse {
        
        $fields = $request->validate([
            'name'             => 'required|string',
            'email'            => 'required|string|unique:users',
            'password'         => 'required|string',
        ]);

        // Create User 
        $user = User::create([
            'name'     => $fields['name'],
            'email'    => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $response = [
            'user'  => $user,
            'message' => 'User registered with success'
        ];

        return response()->json($response, 201);
    }
    
    /**
     * login user
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function login(Request $request) : JsonResponse {

        $fields =  $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::findByemail((string) @$fields['email']);

        if (empty($user)) {

            return response()->json(['error' , 'message' => 'Unknowm user'], 401);
        }

        if(!Hash::check($fields['password'], $user->password)) {

            return response()->json(['error' , 'message' => 'Mismatched password'], 401);
        }

        $token = $user->createToken(uniqid())->plainTextToken;

        $response = [
            'status_code'  => 200,
            'access_token' => $token,
            'user'         => $user
        ];

        return response()->json($response);
    }
    
    /**
     * logout and delete all tokens user by given id
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    protected function logout(int $userId) : JsonResponse {

        $authUser = User::findById((int) $userId);
     
        if (!empty($authUser)) {

            $tokens =  $authUser->tokens()->get();
            $tokens->map->delete();

            return response()->json(['message' => 'logged out'], 204);
        }
       
        return response()->json(['error' => 'empty user'], 500);
       
    }

    
}
