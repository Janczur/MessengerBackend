<?php


namespace App\Messenger\Application\Command\Email;


use App\Messenger\Application\Command\Command;
use App\Messenger\Application\Query\User\UserView;

class SendEmailToUser extends Command
{
    private string $message;

    private UserView $user;

    /**
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