<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    // public function resend_verification_email(){
    //     Auth::user()->sendEmailVerificationNotification();
    //     return response()->json([
    //         'Message'=>'Email Verification link resend to '.Auth::user()->email
    //     ]);
    // }   

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' =>'verification email sent']);
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return response()->json(['message' =>'user verified successfully']);
    }

    public function check(){
        $user = Auth::user();

        if($user->hasVerifiedEmail()){
            return response()->json([
                'Success'=>true,
                'Message'=>'Email address is verified'
            ]);
        }
        else{
            return response()->json([
                'Success'=>false,
                'Message'=>'Email address is not verified'
            ]); 
        }
    }

    public function profile(Request $request){
        $someData = [
            'name' => 'Ahmed',
            'status' => 'coding'
        ];

        return $someData;
    }
}
