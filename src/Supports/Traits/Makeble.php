<?php
declare(strict_types=1);

namespace Supports\Traits;

trait Makeble
{
public function make(mixed ...$argumets)
{
    return new static(...$argumets);
}
}
