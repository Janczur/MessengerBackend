<?php


namespace App\Messenger\Database;


use App\Messenger\Database\Exception\UsersTableNotFoundException;
use JsonException;
use Symfony\Component\Finder\Finder;

class Filebase
{

    /** @var Finder */
    private Finder $finder;

    private string $tablesPath = __DIR__ . '/Tables';

    /**
     * FileUserQueryInterface constructor.
     */
    public function __construct()
    {
        $this->finder = new Finder();
    }

    /**
     * @return array
     * @throws UsersTableNotFoundException|JsonException
     */
    public function getUsersTableContent(): array
    {
        $files = $this->finder->in($this->tablesPath)->files()->name('users.json');
        if (count($files) <= 0) {
            throw new UsersTableNotFoundException();
        }
        foreach ($files as $file) {
            return json_decode($file->getContents(), true, 512, JSON_THROW_ON_ERROR);
        }
    }

}