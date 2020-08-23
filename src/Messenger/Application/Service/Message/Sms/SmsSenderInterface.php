<?php


namespace App\Messenger\Application\Service\Message\Sms;


use App\Messenger\Domain\Message\Sms\SmsMessage;

interface SmsSenderInterface
{
    public function send(SmsMessage $smsMessage): void;
}