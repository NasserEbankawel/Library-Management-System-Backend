<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;

class AuthController extends Controller
{
      // Login Method
      public function login(Request $request)
      {
          $credentials = $request->validate([
              'email' => ['required', 'email'],
              'password' => ['required'],
          ]);
  
          if (Auth::attempt($credentials)) {
              $user = Auth::user();
              $token = $user->createToken('API Token')->plainTextToken;
  
              return response()->json([
                  'message' => 'Login successful',
                  'token' => $token,
                  'user' => $user
              ]);
          }
  
          return response()->json(['message' => 'Invalid credentials'], 401);
      }
  
      // Logout Method
      public function logout(Request $request)
      {
          $request->user()->currentAccessToken()->delete();
  
          return response()->json(['message' => 'Logout successful']);
      }
      
}
