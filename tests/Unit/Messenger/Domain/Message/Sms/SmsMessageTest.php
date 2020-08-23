<?php


namespace Test\Unit\Messenger\Domain\Message\Sms;


use App\Messenger\Domain\Message\Sms\SmsMessage;
use PHPUnit\Framework\TestCase;

class SmsMessageTest extends TestCase
{
    /** @test */
    public function that_we_can_get_phone_number(): void
    {
        $smsMessage = new SmsMessage();
        $phone = '+48123456789';
        $smsMessage->setPhone($phone);
        self::assertEquals($smsMessage->getPhone(), $phone);
    }

    /** @test */
    public function that_we_can_get_content(): void
    {
        $smsMessage = new SmsMessage();
        $content = 'Testowa wiadomość';
        $smsMessage->setContent($content);
        self::assertEquals($smsMessage->getContent(), $content);
    }

}