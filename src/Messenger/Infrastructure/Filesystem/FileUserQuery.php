<?php


namespace App\Messenger\Infrastructure\Filesystem;


use App\Messenger\Application\Query\Query;
use App\Messenger\Application\Query\User\UserQueryInterface;
use App\Messenger\Application\Query\User\UserView;
use App\Messenger\Database\Exception\UsersTableNotFoundException;
use App\Messenger\Database\Filebase;
use App\Messenger\Infrastructure\Filesystem\Exception\UserNotFoundException;
use JsonException;

class FileUserQuery extends Query implements UserQueryInterface
{
    private array $users;

    /**
     * @throws UsersTableNotFoundException|JsonException
     */
    public function __construct()
    {
        $this->users = (new Filebase())->getUsersTableContent();
    }

    /**
     * @return UserView[]
     */
    public function getAll(): array
    {
        return array_map(static function (array $userData) {
            return new UserView(
                $userData['login'],
                $userData['email'],
                $userData['contact_channels']
            );
        }, $this->users);
    }

    /**
     * @param array $userEmails
     * @return UserView[]
     * @throws UserNotFoundException
     */
    public function getByEmails(array $userEmails): array
    {
        $filteredUsers = $this->filterUsersByEmails($userEmails);

        if (!$filteredUsers) {
            throw new UserNotFoundException();
        }
        return array_map(static function (array $filteredUser) {
            return new UserView(
                $filteredUser['login'],
                $filteredUser['email'],
                $filteredUser['contact_channels']
            );
        }, $filteredUsers);
    }

    /**
     * @param array $userEmails
     * @return array
     */
    private function filterUsersByEmails(array $userEmails): array
    {
        $filteredUsers = [];
        foreach ($userEmails as $userEmail) {
            $filteredUsers[] = array_filter($this->users, fn($element) => isset($element['email']) && $element['email'] === $userEmail);
        }
        $filteredUsers = array_filter($filteredUsers, fn($element) => !empty($element));
        return array_merge(...$filteredUsers);
    }
}