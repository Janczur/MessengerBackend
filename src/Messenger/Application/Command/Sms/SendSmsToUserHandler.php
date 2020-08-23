<?php


namespace App\Messenger\Application\Command\Sms;


use App\Messenger\Application\Service\Message\Sms\Adapter\ToFileSmsSenderAdapter;
use App\Messenger\Domain\Message\Sms\SmsMessage;
use Symfony\Component\Filesystem\Filesystem;

class SendSmsToUserHandler
{

    public function handle(SendSmsToUser $command): void
    {
        $smsMessage = (new SmsMessage())
            ->setPhone('+48123456789')
            ->setContent($command->getMessage());

        $adapter = new ToFileSmsSenderAdapter(new Filesystem());
        $adapter->send($smsMessage);
    }

}