<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OffersController;
use App\Http\Controllers\Admin\PlansController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\User\ForgotPasswordController;
use App\Http\Controllers\Merchant\ProductController;
use App\Http\Controllers\User\PaymentsController;
use App\Http\Controllers\User\WalletController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', function (Request $request) {
    $userId = $request->user()->id ?? null;
    if ($userId) {
        return redirect()->route('admin-dashboard');
    } else {
        return view('admin.login');
    }
})->name('/admin');



// Admin Routes
// Route::get('/', [AdminController::class, 'landingPage'])->name('/');
Route::match(['get', 'post'], '/admin/login', [AdminController::class, 'login'])->name('login');

// User Routes
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register-user');
Route::get('/', [UserController::class, 'loginForm'])->name('user-login');
Route::post('/login', [UserController::class, 'login'])->name('login-user');
Route::get('/forgot-password', [UserController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [UserController::class, 'sendForgotPasswordMail'])->name('send-forgot-password');
Route::get('/password-reset/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password');
Route::post('/password-reset-update', [ForgotPasswordController::class, 'updatePassword'])->name('password-reset-update');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'checkRole:admin']], function () {

    Route::get('/admin-logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');

    //Users routes
    Route::get('/users', [UsersController::class, 'users'])->name('users');
    Route::get('/add-user', [UsersController::class, 'addUserForm'])->name('add-user');
    Route::post('/add-user', [UsersController::class, 'addUser'])->name('save-user');
    Route::get('/edit-user/{id}', [UsersController::class, 'editUser'])->name('edit-user');
    Route::post('/edit-user/{id}', [UsersController::class, 'updateUser'])->name('update-user');
    Route::get('/search-user', [UsersController::class, 'searchUser'])->name('search-user');
    Route::get('/change-status/{id}', [UsersController::class, 'changeStatus'])->name('change-status');
    Route::post('/update-profile-admin', [AdminController::class, 'updateProfile'])->name('update.profile.admin');
    Route::post('/change-password-admin', [AdminController::class, 'changePasswordAdmin'])->name('change.password.admin');

    //Settings
    Route::match(['GET', 'POST'], 'terms-conditions', [AdminController::class, 'termsConditions'])->name('terms-conditions');
    Route::match(['GET', 'POST'], 'faq', [AdminController::class, 'faq'])->name('faq');
    Route::get('add-faq', [AdminController::class, 'addFaq'])->name('add-faq');
    Route::get('edit/faq/{id}', [AdminController::class, 'editFaq'])->name('edit-faq');
    Route::post('update/faq/{id}', [AdminController::class, 'updateFaq'])->name('update-faq');
    Route::delete('delete/faq/{id}', [AdminController::class, 'deleteFaq'])->name('delete-faq');
    Route::get('/change/status/{id}', [AdminController::class, 'changeStatus'])->name('change-faq-status');


    Route::match(['GET', 'POST'], '/settings', [AdminController::class, 'settings'])->name('settings');
});

Route::group(['prefix' => 'user', 'middleware' => ['auth', 'checkRole:user']], function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user-dashboard');
    Route::get('/logout', [UserController::class, 'logout'])->name('user-logout');

    //Payment Routes
    Route::get('/payments', [PaymentsController::class, 'payments'])->name('payments');

    //Wallet Routes
    Route::get('/wallet', [WalletController::class, 'wallet'])->name('wallet');
});
