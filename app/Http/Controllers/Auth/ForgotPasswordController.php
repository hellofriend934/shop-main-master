<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordFromRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(ForgotPasswordFromRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
     }

     public function update(ResetPasswordRequest $request)
     {
         $data = $request->validated();
         $status = Password::reset(
             $request->only('email', 'password', 'password_confirmation', 'token'),
             function ($user, $password) {
                 $user->forceFill([
                     'password' => Hash::make($password)
                 ])->setRememberToken(Str::random(60));

                 $user->save();

                 event(new PasswordReset($user));
             });
               return $status === Password::PASSWORD_RESET
                   ? redirect()->route('login')->with('status', __($status))
                   : back()->withErrors(['email' => [__($status)]]);
     }
}
