<?php


namespace App\Messenger\Application\Service\Message\Sms;


use App\Messenger\Domain\Message\Sms\SmsMessage;

class SmsSender implements SmsSenderInterface
{

    public function send(SmsMessage $smsMessage): void
    {
        // @todo implement sms sending logic
    }
}