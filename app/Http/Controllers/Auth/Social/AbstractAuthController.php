<?php

namespace nataalam\Http\Controllers\Auth\Social;

use Auth;
use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use nataalam\Http\Controllers\Controller;
use nataalam\Http\Requests;
use nataalam\Models\User;

abstract class AbstractAuthController extends Controller
{
    /**
     * @var string The name of the social network
     */
    private $network;

    public function __construct($network)
    {
        $this->network = $network;
    }

    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToProvider()
    {
        return Socialite::driver($this->network)->redirect();
    }

    /**
     * Obtain the user information from Google.
     * @param Request $request HTTP request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver($this->network)->user();

        $userCollection = User::where('email', $user->email)->get();
        if ($userCollection->isEmpty()) {
            $request->session()->flash('error', 'noAccountMatching');
            return redirect()->back();
        }

        Auth::login($userCollection->get(0));
        return redirect()->back();
    }
}
