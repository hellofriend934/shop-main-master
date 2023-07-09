<?php
declare(strict_types=1);

namespace App\Logging;

final class TelegramBotApi
{
    public const HOST ='https://api.telegram.org/bot';

    public static function sendMessage(string $token,int $chatId, string $text) :void
    {
        Http::get(self::HOST . $token . '/sendMessage',['chat_id'=>$chatId,'text'=>$text]);
    }
}
