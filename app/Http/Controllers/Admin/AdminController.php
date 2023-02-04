<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function __construct()
    {
    }

    public function landingPage(Request $request)
    {
        // $activeOffer = Offer::where('status', 'active')->first();

        // $plans = '';

        // if ($activeOffer)
        // {
        //     $plans = Plan::where('offer_id', $activeOffer->id)->get();
        // }
        // return view('landingpage')->with(compact('activeOffer', 'plans'));
    }

    public function dashboard(Request $request)
    {
        $data = User::where('status', 'active')->role('user')->count();
        return view('admin.dashboard')->with(compact('data'));
    }

    public function login(Request $request)
    {

        $data = [];

        if ($request->isMethod('post')) {

            $checkUser = User::webLogin($request->all());

            if (!isset($checkUser['user'])) {
                $message = $checkUser['message'];

                return redirect()->route('login')->with('error', $message);
            }

            if (!(Auth::user()->hasRole('admin'))) {
                return redirect()->route('login')->with('error', "Invalid credentials");
            }

            return redirect()->route('admin-dashboard');
        }

        return view('admin.login')->with(compact('data'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
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

        return redirect()->route('login');
    }

    public function updateProfile(Request $request)
    {
        try {
            $requestData = $request->all();
            $userObj = User::find($request->user()->id);
            $userObj->name = $requestData['name'] ?? $userObj->name;
            $userObj->email = $requestData['email'] ?? $userObj->email;
            $userObj->save();

            return redirect()->route('settings')->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function changePasswordAdmin(Request $request)
    {
        $rules = [
            'old_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
        ];

        try {
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errorResponse = validation_error_response($validator->errors()->toArray());
                return redirect()->back()->with('error', $errorResponse['message']);
            }

            $user = Auth::user();

            if (Hash::check($request->old_password, $user->password)) {
                $user->fill([
                    'password' => Hash::make($request->password)
                ])->save();

                $request->session()->flash('success', 'Password changed successfully');
                return redirect()->back();
            } else {
                $request->session()->flash('error', 'Old Password is wrong');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function settings(Request $request)
    {


        if ($request->isMethod('GET')) {

            $data = [];
            $data['page_title'] = 'Settings';
            $settingObj = Setting::first();
            $settings = $settingObj['settings'] ?? [];

            $smtpSetting = Setting::where('name', 'smtp')->first();
            $smtp = $smtpSetting->value ?? "[]";
            $smtp = json_decode($smtp, true);

            $appSetting = Setting::where('name', 'app')->first();
            $app = $appSetting->value ?? "[]";
            $app = json_decode($app, true);

            $push_notification_server_key_setting = Setting::where('name', 'push_notification_server_key')->first();
            $push_notification_server_key = $push_notification_server_key_setting->value ?? null;

            $push_notification_server_key = json_decode($push_notification_server_key, true);


            $stripeSetting = Setting::where('name', 'stripe')->first();
            $stripe = $stripeSetting->value ?? "[]";
            $stripe = json_decode($stripe, true);

            $distanceSetting = Setting::where('name', 'search_distance_limit')->first();
            $distance = $distanceSetting->value ?? "[]";
            $distance = json_decode($distance, true);

            $search_bugSetting = Setting::where('name', 'search_bug')->first();
            $search_bug = $search_bugSetting->value ?? "[]";
            $search_bug = json_decode($search_bug, true);

            $debug_mode_setting = Setting::where('name', 'debug_mode')->first();
            $debug_mode = $debug_mode_setting->value ?? null;
            $debug_mode = json_decode($debug_mode, true);

            $search_bug_keywords = Setting::where('name', 'search_bug_keywords')->first();
            $search_bug_keywords = $search_bug_keywords->value ?? null;
            $search_bug_keywords = json_decode($search_bug_keywords, true);
            return view('admin.setting')->with(compact('data', 'settings', 'smtp', 'push_notification_server_key', 'app', 'stripe', 'distance', 'debug_mode', 'search_bug', 'search_bug_keywords'));
        }

        try {
            $requestData = $request->all();

            $rules = [];
            $settingData = [];

            if ($requestData['request_type'] == 'change_password') {
                $rules['old_password'] = 'required|min:6';
                $rules['password'] = 'required|min:6|confirmed';

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    $errorResponse = validation_error_response($validator->errors()->toArray());
                    return redirect()->back()->with('error', $errorResponse['message']);
                }

                $user = Auth::user();

                if (Hash::check($request->old_password, $user->password)) {
                    $user->fill([
                        'password' => Hash::make($request->password)
                    ])->save();

                    $request->session()->flash('success', 'Password changed successfully');
                    return redirect()->back();
                } else {
                    $request->session()->flash('error', 'Old Password is wrong');
                    return redirect()->back();
                }
            }

            if ($requestData['request_type'] == 'smtp') {
                $smtp = [
                    'email' => $requestData['smtp_email'],
                    'password' => $requestData['smtp_password'],
                    'host' => $requestData['smtp_host'] ?? "",
                    'port' => $requestData['smtp_port'] ?? "",
                    'from_address' => $requestData['smtp_from_address'],
                    'from_name' => $requestData['smtp_from_name'],
                ];

                $jsonData = json_encode($smtp);

                $settingObj = Setting::where('name', 'smtp')->first();

                if (!$settingObj) {
                    $settingObj = new Setting;
                    $settingObj->name = 'smtp';
                    $settingObj->description = 'SMTP setting is using to setup the mail configuration';
                }

                $settingObj->value = $jsonData;
                $settingObj->save();

                $request->session()->flash('success', 'SMTP setting updated successfully');
                return redirect()->back();
            }

            if ($requestData['request_type'] == 'push_notification_server_key') {
                $push_notification_server_key = [
                    'push_notification_server_key' => $requestData['push_notification_server_key'] ?? null
                ];

                $jsonData = json_encode($push_notification_server_key);

                $settingObj = Setting::where('name', 'push_notification_server_key')->first();

                if (!$settingObj) {
                    $settingObj = new Setting;
                    $settingObj->name = 'push_notification_server_key';
                    $settingObj->description = 'Push notification server key';
                }

                $settingObj->value = $jsonData;
                $settingObj->save();

                $request->session()->flash('success', 'Push notification server key updated successfully');
                return redirect()->back();
            }

            if ($requestData['request_type'] == 'app') {
                $app = [];

                if (isset($requestData['app_name']) && !empty($requestData['app_name'])) {
                    $app['app_name'] = $requestData['app_name'];
                }
                if (isset($requestData['rate_on_apple_store']) && !empty($requestData['rate_on_apple_store'])) {
                    $app['rate_on_apple_store'] = $requestData['rate_on_apple_store'];
                }
                if (isset($requestData['rate_on_google_store']) && !empty($requestData['rate_on_google_store'])) {
                    $app['rate_on_google_store'] = $requestData['rate_on_google_store'];
                }
                if (isset($requestData['terms_conditions']) && !empty($requestData['terms_conditions'])) {
                    $app['terms_conditions'] = $requestData['terms_conditions'];
                }
                if (isset($requestData['privacy_policy']) && !empty($requestData['privacy_policy'])) {
                    $app['privacy_policy'] = $requestData['privacy_policy'];
                }

                $jsonData = json_encode($app);

                $settingObj = Setting::where('name', 'app')->first();

                if (!$settingObj) {
                    $settingObj = new Setting;
                    $settingObj->name = 'app';
                    $settingObj->description = 'APP setting is using to setup the Application Details';
                }
                $settingObj->value = $jsonData;
                $settingObj->save();

                $request->session()->flash('success', 'APP setting updated successfully');
                return redirect()->back();
            }

            if ($requestData['request_type'] == 'stripe') {
                $stripe = [
                    'public_key' => $requestData['public_key'],
                    'secret_key' => $requestData['secret_key'],
                ];

                $jsonData = json_encode($stripe);

                $settingObj = Setting::where('name', 'stripe')->first();

                if (!$settingObj) {
                    $settingObj = new Setting;
                    $settingObj->name = 'stripe';
                    $settingObj->description = 'Stripe setting is using to setup the payment gateway configuration';
                }

                $settingObj->value = $jsonData;
                $settingObj->save();

                $request->session()->flash('success', 'Stripe detail updated successfully');
                return redirect()->back();
            }

            if ($requestData['request_type'] == 'search_distance') {

                $distance = [
                    'search_distance_limit' => $requestData['search_distance_limit'],
                ];
                $jsonData = json_encode($distance);
                $settingObj = Setting::where('name', 'search_distance_limit')->first();

                if (!$settingObj) {
                    $settingObj = new Setting;
                    $settingObj->name = 'search_distance_limit';
                    $settingObj->description = 'APP setting is using to setup the Application Search distance limit';
                }
                $settingObj->value = $jsonData;
                $settingObj->save();

                $request->session()->flash('success', 'Search distance limit setting updated successfully');
                return redirect()->back();
            }

            if ($requestData['request_type'] == 'debug_mode') {
                $debug_mode = [
                    'debug_mode' => isset($requestData['debug_mode']) ? true : false,
                ];

                $jsonData = json_encode($debug_mode);

                $settingObj = Setting::where('name', 'debug_mode')->first();

                if (!$settingObj) {
                    $settingObj = new Setting;
                    $settingObj->name = 'debug_mode';
                    $settingObj->description = 'App debug mode on/off';
                }

                $settingObj->value = $jsonData;
                $settingObj->save();

                $request->session()->flash('success', 'Debug mode updated successfully');
                return redirect()->back();
            }

            if ($requestData['request_type'] == 'search_bug') {

                $app = [];

                if (isset($requestData['account_id']) && !empty($requestData['account_id'])) {
                    $app['account_id'] = $requestData['account_id'];
                }
                if (isset($requestData['password']) && !empty($requestData['password'])) {
                    $app['password'] = $requestData['password'];
                }

                $jsonData = json_encode($app);

                $settingObj = Setting::where('name', 'search_bug')->first();

                if (!$settingObj) {
                    $settingObj = new Setting;
                    $settingObj->name = 'search_bug';
                    $settingObj->description = 'Criminal check';
                }

                $settingObj->value = $jsonData;
                $settingObj->save();

                $request->session()->flash('success', 'Search Bug updated successfully');
                return redirect()->back();
            }

            if ($requestData['request_type'] == 'search_keyword') {

                $app = [];

                if (isset($requestData['keywords']) && !empty($requestData['keywords'])) {
                    $app['keywords'] = $requestData['keywords'];
                }


                $jsonData = json_encode($app);

                $settingObj = Setting::where('name', 'search_bug_keywords')->first();

                if (!$settingObj) {
                    $settingObj = new Setting;
                    $settingObj->name = 'search_bug_keywords';
                    $settingObj->description = 'Criminal Check Keywords';
                }

                $settingObj->value = $jsonData;
                $settingObj->save();

                $request->session()->flash('success', 'Keyword updated successfully');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function termsConditions(Request $request)
    {
        if ($request->isMethod('GET')) {
            $data = [];

            $termsConditions = Setting::where('name', 'terms_conditions')->first();
            $data['page_title'] = 'Terms & Conditions';
            $data = $termsConditions->value ?? "[]";
            $data = json_decode($data, true);

            return view('admin.terms_conditions.index')->with(compact('data'));
        }
        try {
            $requestData = $request->all();
            if (isset($requestData['terms_conditions']) && !empty($requestData['terms_conditions'])) {
                $termsConditions['terms_conditions'] = $requestData['terms_conditions'];
            }

            $jsonData = json_encode($termsConditions);

            $settingObj = Setting::where('name', 'terms_conditions')->first();

            if (!$settingObj) {
                $settingObj = new Setting;
                $settingObj->name = 'terms_conditions';
                $settingObj->description = 'Users terms & conditions';
            }

            $settingObj->value = $jsonData;
            $settingObj->save();

            $request->session()->flash('success', 'Terms Conditions updated successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function faq(Request $request)
    {
        if ($request->isMethod('GET')) {
            $data = Faq::latest()->paginate();

            return view('admin.faq.index')->with(compact('data'));
        }
        try {
            $requestData = $request->all();
            $request->validate([
                'question' => 'required|unique:faqs,question',
                'answer' => 'required',

            ]);

            if (isset($requestData['question']) && !empty($requestData['question'])) {
                $termsConditions['question'] = $requestData['question'];
            }

            $faq = new Faq();

            $faq->question = $request['question'];
            $faq->answer = $request['answer'];
            $faq->save();
            return redirect()->route('faq')->with('success', 'FAQ added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function addFaq()
    {
        return view(('admin.faq.add'));
    }

    public function editFaq($id)
    {
        $data = Faq::where('id', $id)->first();
        return view('admin.faq.edit')->with(compact('data'));
    }


    public function updateFaq(Request $request, $id)
    {
        try {
            $requestData = $request->all();
            $request->validate([
                'question' => 'required',
                'answer' => 'required',

            ]);

            if (isset($requestData['question']) && !empty($requestData['question'])) {
                $termsConditions['question'] = $requestData['question'];
            }

            $faq = Faq::where('id', $id)->first();

            $faq->question = $request['question'] ?? $faq->question;
            $faq->answer = $request['answer'] ?? $faq->answer;
            $faq->save();
            return redirect()->route('faq')->with('success', 'FAQ updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteFaq($id)
    {
        $data = Faq::where('id', $id)->first();

        if (!$data) {
            return redirect()->route('faq')->with('error', 'FAQ not found');
        }

        $data->delete();
        return redirect()->back()->with('success', 'FAQ deleted successfully');
    }

    public function changeStatus($id)
    {
        $faq = Faq::where('id', $id)->first();


        if ($faq->status == 'active') {
            $faq->status = 'in_active';
        } else {
            $faq->status = 'active';
        }

        $faq->save();

        return redirect()->back()->with('success', ' FAQ status changed successfully');
    }
}
