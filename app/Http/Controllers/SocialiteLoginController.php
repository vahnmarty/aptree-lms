<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteLoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::firstOrCreate(
            [
                'provider_id' => $socialUser->getId(),
            ],
            [
                'email' => $socialUser->getEmail(),
                'name' => $socialUser->getName()
            ]
        );

        auth()->login($user, true);

        return redirect('dashboard');
    }
}
