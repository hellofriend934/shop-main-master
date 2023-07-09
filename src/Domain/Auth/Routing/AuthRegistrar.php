<?php
declare(strict_types=1);

namespace Domain\Auth\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\SocialAuthController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;


class AuthRegistrar implements RouteRegistrar
{
public function map(Registrar $registrar):void
{


    Route::middleware('web')->group(function () {
        Route::get('/signIn', 'App\Http\Controllers\Auth\SignInController@index');
        Route::post('/signIn', 'App\Http\Controllers\Auth\SignInController@signIn')->name('signIn');

        Route::get('/signUp', 'App\Http\Controllers\Auth\SignUpController@index');
        Route::DELETE('/logOut', 'App\Http\Controllers\Auth\SignInController@logOut')->name('logOut');
        Route::post('/signUp', 'App\Http\Controllers\Auth\SignUpController@signUp')->name('signUp');;

        Route::get('/forgot-password', 'App\Http\Controllers\Auth\ForgotPasswordController@index')->middleware('guest')->name('password.request');
        Route::post('/forgot-password', 'App\Http\Controllers\Auth\ForgotPasswordController@forgotPassword')->middleware('guest')->name('password.email');
        Route::get('/reset-password/{token}', function ($token) {
            return view('auth.reset-password', ['token' => $token]);
        })->middleware('guest')->name('password.reset');

        Route::post('/reset-password', 'App\Http\Controllers\Auth\ForgotPasswordController@update')->name('password.update');



        Route::get('/github/redirect', 'App\Http\Controllers\Auth\SocialAuthController@redirect')->name('socialite.redirect');

        Route::get('/github/callback', 'App\Http\Controllers\Auth\SocialAuthController@handle')->name('socialite.github')->middleware('web');;
    });

}
}
