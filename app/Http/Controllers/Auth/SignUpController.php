<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpFormRequest;
use App\Models\User;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function index()
    {
        return view('auth.sign-up');
    }

    public function signUp(Request $request, RegisterNewUserContract $action)
    {
       $action(new NewUserDTO($request->get('name'),$request->get('email'), $request->get('password')));
       return redirect(route('home'));

    }
}
