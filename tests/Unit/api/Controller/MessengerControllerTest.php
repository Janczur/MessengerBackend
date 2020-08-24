<?php


namespace Test\Unit\api\Controller;


use Api\Controller\MessengerController;
use App\Messenger\Application\SystemInterface;
use App\Messenger\Infrastructure\Filesystem\FileUserQuery;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class MessengerControllerTest extends TestCase
{

    /** @test */
    public function it_correctly_orders_sending_message_to_given_users(): void
    {
        $system = $this->createMock(SystemInterface::class);
        $system->expects(self::once())
            ->method('query')
            ->willReturn(new FileUserQuery());
        $system->expects(self::once())
            ->method('handle');
        $messengerController = new MessengerController($system);
        $request = Request::create(
            '/api/vi/send/message',
            'POST',
            [],
            [],
            [],
            [],
            '{"message":"asdasd","userEmails":["andrzej.kowalski@test.pl","jan.kowalski@test.pl","test@test.pl"]}'
        );
        $response = $messengerController->sendMessageAction($request);
        self::assertEquals(200, $response->getStatusCode());
        self::assertJson('{"data":"Wiadomość została wysłana do wybranych użytkowników"}', $response->getContent());
    }

    /** @test */
    public function it_needs_valid_message_to_correctly_order_sending_message(): void
    {
        $system = $this->createMock(SystemInterface::class);
        $messengerController = new MessengerController($system);
        $request = Request::create(
            '/api/vi/send/message',
            'POST',
            [],
            [],
            [],
            [],
            '{"message":"","userEmails":["andrzej.kowalski@test.pl","jan.kowalski@test.pl","test@test.pl"]}'
        );
        $response = $messengerController->sendMessageAction($request);
        self::assertEquals(422, $response->getStatusCode());
        self::assertEquals('Error! Treść wiadomości nie przeszła walidacji', $response->getContent());
    }
}