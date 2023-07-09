<?php
declare(strict_types=1);

namespace Domain\Auth\Contracts;

use Domain\Auth\DTOs\NewUserDTO;

Interface RegisterNewUserContract
{
    public function __invoke(NewUserDTO $data);
}
