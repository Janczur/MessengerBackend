<?php


namespace App\Messenger\Application\Command;


use App\Messenger\Application\Query\User\UserView;

class SendMessageToUsers extends Command
{
    private string $message;

    /** @var UserView[] */
    private array $users;

    /**
     * SendMessageToUsers constructor.
     * @param string $message
     * @param UserView[] $users
     */
    public function __construct(string $message, array $users)
    {
        $this->message = $message;
        $this->users = $users;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return UserView[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }


}