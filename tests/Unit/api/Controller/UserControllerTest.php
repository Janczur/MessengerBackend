<?php


namespace Test\Unit\api\Controller;


use Api\Controller\UserController;
use App\Messenger\Application\CommandBus\CommandBus;
use App\Messenger\Application\System;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{

    /** @test */
    public function it_correctly_lists_all_users_in_json_format(): void
    {
        $system = new System(new CommandBus());
        $userController = new UserController($system);
        $response = $userController->indexAction();
        self::assertEquals(200, $response->getStatusCode());
        self::assertJson('[{"login":"jan.kowalski","email":"jan.kowalski@test.pl","contactChannels":"email"},{"login":"andrzej.kowalski","email":"andrzej.kowalski@test.pl","contactChannels":"email,sms"},{"login":"marek.kowalski","email":"marek.kowalski@test.pl","contactChannels":null}]', $response->getContent());
    }
}