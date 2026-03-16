<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request){

        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        $user = user::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => hash::make($validated['password'])
        ]);

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'message' => 'user cree avec succes',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($validated)) {
            return response()->json([
                'message' => 'email or password invalid',
            ]);
        }

        $user = user::where('email', $validated['email'])->first();

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'message' => 'connexion reussie',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request){
       $request->user()->currentAccessToken()->delete();

       return response()->json([
          'message' => "Deconnexion reussie",
       ]);
    }

    public function user(Request $request){
        return response()->json([
            'user'=>$request->user(),
        ]);
    }
}


