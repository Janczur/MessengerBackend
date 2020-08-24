<?php


namespace App\Messenger\Application\Service\Message\Sms\Adapter;


use App\Messenger\Application\Service\Message\Sms\SmsSender;
use App\Messenger\Domain\Message\Sms\SmsMessage;
use Symfony\Component\Filesystem\Filesystem;

class ToFileSmsSenderAdapter extends SmsSender
{

    private Filesystem $filesystem;

    /**
     * ToFileSmsSenderAdapter constructor.
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }


    public function send(SmsMessage $smsMessage): void
    {
        $filename = $smsMessage->getPhone() . '_' . date('Y-m-d-H-i');
        $this->filesystem->dumpFile("{$_ENV['STORAGE_PATH']}/sms/{$filename}.txt", $smsMessage->getContent());
    }


}