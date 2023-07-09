<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInFormRequest;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Supports\SessionRegenerator;

class  SocialAuthController extends Controller
{
    public function redirect()
    {

        return Socialite::driver('github')->redirect();

    }

    public function handle(SignInFormRequest $request):RedirectResponse
    {
dd(1);
        $githubUser = Socialite::driver('github')->user();

        $user = User::where('github_id', $githubUser->id)->first();

        //todo 3rd lesson move to custom table
        if ($user) {
            $user->update([
                'github' . "_id" => $githubUser->id,
            ]);
        } else {
            $user = User::create([
                'name' => $githubUser->name ?? 'user',
                'email' => $githubUser->email,
                'github_id' => $githubUser->id,
            ]);
        }


        SessionRegenerator::run(auth()->login($user));
        return redirect('/authenticate/signIn');
    }

}

