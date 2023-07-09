<?php
declare(strict_types=1);

namespace Supports;

use App\Events\AfterSessionRegenerated;

class SessionRegenerator
{

static public function run(\Closure $callback =null)
{
    $old = request()->session()->getId(); //записываем старый id
     request()->session()->regenerate(); //делаем его невалидным
    $new = request()->session()->getId();
     if (!is_null($callback)){
        $callback();
    }
    event(new AfterSessionRegenerated($old, $new));
}
}
