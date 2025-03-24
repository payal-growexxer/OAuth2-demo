<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Jumbojett\OpenIDConnectClient;

class AuthController extends Controller
{
    // Google OAuth 2.0
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        dd($user);
    }

    // Twitter OAuth 1.0
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback()
    {
        $user = Socialite::driver('twitter')->user();
        dd($user);
    }

    // Auth0 OpenID
    public function redirectToAuth0()
    {
        $oidc = new OpenIDConnectClient(
            env('AUTH0_DOMAIN'),
            env('AUTH0_CLIENT_ID'),
            env('AUTH0_CLIENT_SECRET')
        );

        $oidc->setRedirectURL(env('AUTH0_REDIRECT_URI'));
        $oidc->authenticate();
        $userInfo = $oidc->getVerifiedClaims();
        dd($userInfo);
    }

    public function handleAuth0Callback()
    {
        return redirect('/');
    }
}
