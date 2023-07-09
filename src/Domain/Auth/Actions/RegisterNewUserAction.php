<?php
declare(strict_types=1);

namespace Domain\Auth\Actions;


use App\Http\Requests\SignUpFormRequest;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Auth\Models\User;
use Illuminate\Http\Request;

class RegisterNewUserAction implements RegisterNewUserContract
{
    public function __invoke(NewUserDTO $data)
    {
        $user =   User::create([
            'name'=>$data->name,
            'email'=>$data->email,
            'password'=>bcrypt($data->password)
        ]);
//        event(new Registered($user));
        auth()->login($user);
        return redirect(route('home'));
    }
}
