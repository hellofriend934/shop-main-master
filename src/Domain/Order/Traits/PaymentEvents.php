<?php
declare(strict_types=1);

namespace Domain\Order\Traits;

trait PaymentEvents
{
protected static \Closure $onCreating;
protected static \Closure $onSucces;
protected static \Closure $onValidation;
protected static \Closure $onError;

protected static function onCreating(\Closure $event){
self::$onCreating = $event;
}

    protected static function onSuccess(\Closure $event){
        self::$onSucces = $event;
    }

    protected static function onValidation(\Closure $event){
        self::$onValidation = $event;
}

protected static function onError(\Closure $event){
        self::$onError = $event;
}
}
