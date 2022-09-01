<?php

namespace nataalam\Http\Controllers\Auth;

use nataalam\Models\User;
use Validator;
use nataalam\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = "/";
    protected $loginPath = "/login";
    /**
     * Create a new authentication controller instance.
     *
     * @return \nataalam\Http\Controllers\Auth\AuthController
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data, [
                'firstName' => 'required|max:35|alpha',
                'lastName' => 'required|max:35|alpha',
                'username' => 'required|max:14|alpha_num',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:8',
                'g-recaptcha-response' => 'required|recaptcha',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verification_code' => str_random(30),
        ]);
    }

}
