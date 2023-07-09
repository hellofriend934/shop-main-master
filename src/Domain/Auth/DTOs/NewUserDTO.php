<?php
declare(strict_types=1);

namespace Domain\Auth\DTOs;

use Illuminate\Http\Request;
use Supports\Traits\Makeble;
class NewUserDTO
{
public function __construct(
    public readonly string $name,
    public readonly string $email,
    public readonly string $password,
)
{

}


    public static function formRequest(Request $request)
    {
        return new self(
            $request->get('name'),
            $request->get('email'),
            $request->get('password'),
        );
    }
}
