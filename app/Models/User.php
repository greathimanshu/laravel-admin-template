<?php

namespace App\Models;

use App\Traits\Uuids;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable
{

    use HasApiTokens, HasFactory, HasRoles, Notifiable, SoftDeletes, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $incrementing = false;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function webLogin($data)
    {
        $response = [];
        if (array_key_exists('email', $data)) {
            $userObj = User::where('email', strtolower($data['email']))->first();

            if (!$userObj) {
                $response['message'] = 'Please enter valid registered email.';
                return $response;
            }

            if ($userObj->status == 'in_active') {
                $response['message'] = 'Your account is Inactive.';
                return $response;
            }

            if (Auth::attempt(array('email' => strtolower($data['email']), 'password' => $data['password']))) {
                $user = User::where('email', strtolower($data['email']))->first();
                $response['user'] = $user;
            } else {
                $response['message'] = 'Incorrect password';
            }
        } else {
            $response['message'] = 'Email or username is required';
        }

        return $response;
    }
}
