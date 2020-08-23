<?php


namespace App\Messenger\Application\Command;


use App\Messenger\Application\Command\Email\SendEmailToUser;
use App\Messenger\Application\Command\Sms\SendSmsToUser;
use App\Messenger\Application\CommandBus\CommandBus;
use App\Messenger\Application\Query\User\UserView;
use App\Messenger\Application\System;
use App\Messenger\Application\SystemInterface;
use App\Messenger\Domain\User\Helpers\UserContactChannelsConverter;

class SendMessageToUsersHandler
{
    private SystemInterface $system;

    public function __construct()
    {
        $this->system = new System(new CommandBus());
    }

    public function handle(SendMessageToUsers $command): void
    {
        foreach ($command->getUsers() as $user){
            if (!$user->getContactChannels()){
                $this->sendEmailToUser($command->getMessage(), $user);
                continue;
            }
            $contactChannels = UserContactChannelsConverter::toArray($user->getContactChannels());
            foreach ($contactChannels as $contactChannel){
                if ($this->shouldSendEmail($contactChannel)){
                    $this->sendEmailToUser($command->getMessage(), $user);
                }

                if ($this->shouldSendSms($contactChannel)){
                    $this->sendSmsToUser($command->getMessage(), $user);
                }
            }
        }
    }

    private function shouldSendEmail(string $contactChannel): bool
    {
        return $contactChannel === 'email';
    }

    private function shouldSendSms(string $contactChannel): bool
    {
        return $contactChannel === 'sms';
    }

    private function sendEmailToUser(string $message, UserView $user): void
    {
        $this->system->handle(new SendEmailToUser($message, $user));
    }

    private function sendSmsToUser(string $message, UserView $user): void
    {
        $this->system->handle(new SendSmsToUser($message, $user));
    }

}