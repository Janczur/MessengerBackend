<?php


namespace App\Messenger\Application\Command\Sms;


use App\Messenger\Application\Command\Command;
use App\Messenger\Application\Query\User\UserView;

class SendSmsToUser extends Command
{
    private string $message;

    private UserView $user;

    /**
     * SendSmsToUser constructor.
     * @param string $message
     * @param UserView $user
     */
    public function __construct(string $message, UserView $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return UserView
     */
    public function getUser(): UserView
    {
        return $this->user;
    }

}