<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function resetPassword(Request $request, $token)
    {
        // Check token is expired or noting happing

        $forgotPasswordEmailObj = ForgotPasswordMail::where('token', $token)->first();
         //
        if(!$forgotPasswordEmailObj) {
            ForgotPasswordMail::where('token', $token)->delete();
            return view('user.expired-mail');
        };
        $data['token'] = $token;
        $data['email'] = $request->get('email');
        
        return view('user.reset')->with(compact('data'));
    }

    public function updatePassword(Request $request)
    {
        $requestData = $request->all();

        $token = $requestData['token'];
        $tokenObj = ForgotPasswordMail::where('token', $token)->first();
        if(!$tokenObj) {
            return view('user.expired-mail');
        }

        $resourceObj = User::where('email', $requestData['email'])->first();

        if(!$resourceObj) {
            return redirect()->route('forgot-password')->with('error', 'Invalid request');
        }

        $userType = $resourceObj->user_type;

        $resourceObj->password = bcrypt($requestData['password']);
        if($resourceObj->save()) {
            ForgotPasswordMail::where('token', $token)->delete();
        }

        return redirect()->route("congratulation", ['email' => $requestData['email'], 'type' => $userType]);
    }

    public function congratulation(Request $request)
    {
        $data = [];
        $requestData = $request->all();

        return view('user.password-reset-thanks')->with('data');
    }
}
