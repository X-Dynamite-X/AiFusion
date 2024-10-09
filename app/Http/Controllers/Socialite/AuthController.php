<?php

namespace App\Http\Controllers\Socialite;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    //

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
    }
    public function handleProviderCallback($provider)
    {
        $userGithubData = Socialite::driver($provider)->stateless()->user();
        $user = User::where('provider_id', $userGithubData->getId())
                    ->orWhere('provider', $provider)
                    ->first();
        if (!$user) {
            $user = User::create([
                'name' => $userGithubData->getName(),
                'email' => $userGithubData->getEmail(),
                'provider_id' => $userGithubData->getId(),
                'avatar' => $userGithubData->getAvatar(),
                'provider' => $provider,
                'password' => bcrypt(Str::password()),
            ]);
        }

        Auth::login($user, true);

        return response()->json(["user"=>$user,"userGithubData"=>$userGithubData]) ;
    }
}
