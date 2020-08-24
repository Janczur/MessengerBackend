<?php


namespace Test\Unit\Messenger\Domain\Message\Sms\Adapter;


use App\Messenger\Application\Service\Message\Sms\Adapter\ToFileSmsSenderAdapter;
use App\Messenger\Domain\Message\Sms\SmsMessage;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

class ToFileSmsSenderAdapterTest extends TestCase
{

    /** @test */
    public function it_saves_sms_message_to_file(): void
    {
        $testPhone = '+48123456789';
        $testContent = 'Testowa wiadomość';

        $smsMessage = (new SmsMessage())
            ->setPhone($testPhone)
            ->setContent($testContent);
        $adapter = new ToFileSmsSenderAdapter(new Filesystem());
        $adapter->send($smsMessage);

        $filename = '+48123456789_' . date('Y-m-d-H-i') . '.txt';
        $smsStoragePath = $_ENV['STORAGE_PATH'] . '/sms/';
        self::assertFileExists($smsStoragePath . $filename);
        self::assertEquals($testContent, file_get_contents($smsStoragePath . $filename));
        unlink($smsStoragePath . $filename);
    }
}