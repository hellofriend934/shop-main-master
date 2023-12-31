<?php
declare(strict_types=1);

namespace App\Logging;

use Monolog\Logger;

class TelegramLoggerFactory
{
public function __invoke(array $config)
{
    $logger = new Logger('telegram');
    $logger->pushHandler(new TelegramLoggerHandler($config));
    return $logger;
}
}
