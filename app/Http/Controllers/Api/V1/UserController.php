<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class UserController extends Controller
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

        if ($user) {
            event(new Registered($user));
            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
                'status' => 201,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email
                ],
                'token' => $token,
                'Message' => 'Registration was successful. Check your email to verify'
            ];
            return response()->json($response);
        } else {
            $response = [
                'status' => 500,
                'Message' => 'Error registering user, Please try again.'
            ];
            return response()->json($response);
        }
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
        $response = [
            'status' => 201,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ],
            'token' => $token,
        ];
        return response()->json($response);
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

    public function logout(Request $request)
    {
        if (Auth::user()) {
            auth()->user()->tokens()->delete();
            $response = [
                'status' => 201,
                'message' => 'Logged Out'
            ];
            return response()->json($response);
        } else {
            $response = [
                'status' => 500,
                'message' => 'Error logging out'
            ];
            return response()->json($response);
        }
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' => 'verification email sent']);
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return response()->json(['message' => 'user verified successfully']);
    }

    public function check()
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'Success' => true,
                'Message' => 'Email address is verified'
            ]);
        } else {
            return response()->json([
                'Success' => false,
                'Message' => 'Email address is not verified'
            ]);
        }
    }

    public function profile(Request $request)
    {
        // fixme - check if user is authorize for all auth endpoint
        if(Auth::user()){
            return auth()->user()->only([
                'id', 'name', 'phone', 'email', 'address', 'city', 'state', 'country', 'postcode', 'avatar'
            ]);
        }else{
            return 'No user authenticated';
        }
    }

    public function updateProfile(Request $request)
    {
        $fields = $request->validate([
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            // 'current_location' => 'string',      //getting from geolocation api
            'state' => 'required|string',
            'country' => 'required|string',
            'postcode' => 'string',
        ]);

        $updated = Auth::user()->update([
            'phone' => $fields['phone'],
            'address' => $fields['address'],
            'city' => $fields['city'],
            'state' => $fields['state'],
            'country' => $fields['country'],
            'postcode' => $fields['postcode'],
        ]);

        if ($updated) {
            $response = [
                'status' => 201,
                'Message' => 'user details updated successfully'
            ];
            return response()->json($response);
        } else {

            $response = [
                'status' => 500,
                'Message' => 'Error updating user'
            ];
            return response()->json($response);
        }
    }
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image',
        ]);

        $avatarName = time() . '.' . $request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('avatars'), $avatarName);

        Auth::user()->update(['avatar' => $avatarName]);
        return response()->json([
            'avatar' => url('img/avatars/' . Auth::user()->avatar),         //fixme - check for the exact location
            'Message' => 'Avatar Updated Successfully'
        ]);
    }
    public function avatar()
    {
        return response()->json([
            'avatar' => url('img/avatars/' . Auth::user()->avatar)          //fixme - check for the exact location
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed',
        ]);

        Auth::user()->update(['password' => bcrypt($request->password)]);

        $response = [
            'status' => 201,
            'Message' => 'Password Updated.'
        ];
        return response()->json($response);
    }
}
