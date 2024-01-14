<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);
        event(new Registered($user));
        $token = $user->createToken('myapptoken')->plainTextToken;
        $Response = [
            'status' => 201,
            'user' => $user,
            'token' => $token,
            'Message' => 'Registration was successful. Check your email to verify'
        ];
        return response()->json($Response);
    }
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'status' => 401,
                'message' => 'Bad Credentials'
            ]);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $Response = [
            'status' => 201,
            'user' => $user,
            'token' => $token,
        ];
        return response()->json($Response);
    }
        public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        $Response = [
            'status' => 201,
            'message' => 'Logged Out'
        ];
        return response()->json($Response);
    }
    public function forgot_password(Request $request)
    {
        //write a laravel controller that takes a email as the request and sends a password reset link to that email

        $request->validate(['email' => 'required|email']);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? response()->json(['status' => 'success'], 200)
            : response()->json(['status' => 'failed'], 400);
    }

    // public function broker()
    // {
    //     return Password::broker();
    // }
}
