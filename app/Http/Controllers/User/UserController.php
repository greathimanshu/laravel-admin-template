<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller{

    public function __construct()
    {
    }
    
    public function dashboard(Request $request)
    {
        $users = User::where('status','active')->role('user')->count();

        $data = [
            'users' => $users
        ];
        return view('user.dashboard')->with(compact('data'));
    }

    public function loginForm(Request $request)
    {
        $data = [];
        return view('user.login')->with(compact('data'));
    }

    public function login(Request $request)
    {
        
        $checkUser = User::webLogin($request->all());

        if (!isset($checkUser['user'])) {
            $message = $checkUser['message'];

            return redirect()->route('user-login')->with('error', $message);
        }

        if (!(Auth::user()->hasRole('user'))) {
            return redirect()->route('user-login')->with('error', "Invalid credentials");
        }

        return redirect()->route('user-dashboard');
    }

    public function register(Request $request)
    {

        return view('user.register');
    }

    public function store(Request $request)
    {

        $request->validate([
            'fullname' => 'required|max:100|string',
            'email' => 'email|required|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $user = new User();
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole('user');

        return redirect()->route('user-login');
    }

    public function forgotPassword(Request $request)
    {
        return view('user.forgotpassword');
    }

    public function generateRandomToken($length = 10, $string = 'xyz')
    {
        $characters = $string . '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' . time();
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function sendForgotPasswordMail(Request $request)
    {
        $userObj = User::where('email', $request->get('email'))->first();
        if (!$userObj) {
            return redirect()->route('forgot-password')->with('error', 'Please enter valid registered email.');
        }

        $token = $this->generateRandomToken(50, $request->get('email'));

        $tokenMailObj = ForgotPasswordMail::where('email', $request->get('email'))->first();
        if (!$tokenMailObj) {
            $tokenMailObj = new ForgotPasswordMail;
        }

        $tokenMailObj->email = $request->get('email');
        $tokenMailObj->token = $token;

        $currentTime = date("Y-m-d H:i:s");
        $mailExpireTime = date('Y-m-d H:i:s', strtotime('+60 minutes', strtotime($currentTime)));

        $tokenMailObj->expired_at = $mailExpireTime;
        $tokenMailObj->save();

        $mailData = [];
        if ($userObj) {
            $mailData['name'] = $userObj->name;
        } else {
            $mailData['username'] = $userObj->username;
        }

        $mailData['link'] = route('reset-password', [$token, 'email' => $request->get('email')]);

        Mail::to($request->get('email'))->send(new ForgotPassword($mailData));

        return redirect()->route('user-login')->with('success', 'Please check your email to reset password');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('user-login');
    }
    
    
}