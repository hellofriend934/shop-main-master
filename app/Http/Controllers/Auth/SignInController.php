<?php

namespace App\Http\Controllers\Auth;

use App\Events\AfterSessionRegenerated;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignInFormRequest;
use Domain\Product\Models\Product;
use Illuminate\Http\Request;
use Supports\SessionRegenerator;


class SignInController extends Controller
{

    public function index()
    {
        $errors = '';
        $product = Product::all();
        return view('auth.index',compact('errors'));
    }

    public function signIn(SignInFormRequest $request)
    {
        $data =  $request->validated();
         if (auth()->attempt($data)){
            SessionRegenerator::run();

             return redirect()->intended(route('home'));
         }
        return back()->withErrors(['email'=>'данного пользователя не существует']);
    }

    public function logOut(Request $request)
    {
       SessionRegenerator::run(fn()=>auth()->logout());
        return redirect()->route('home');
    }

}
