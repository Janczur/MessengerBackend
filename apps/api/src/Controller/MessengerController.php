<?php


namespace Api\Controller;


use App\Messenger\Application\Command\SendMessageToUsers;
use App\Messenger\Application\SystemInterface;
use App\Messenger\Infrastructure\Filesystem\FileUserQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

class MessengerController
{
    private SystemInterface $system;

    private Serializer $serializer;

    /**
     * @param SystemInterface $system
     */
    public function __construct(SystemInterface $system)
    {
        $this->system = $system;
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \JsonException
     */
    public function sendMessageAction(Request $request): Response
    {
        $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        if (!$this->validateMessage($data['message'])){
            return new Response('Error! Treść wiadomości nie przeszła walidacji', 422);
        }

        $users = $this->system->query(FileUserQuery::class)->getByEmails($data['userEmails']);
        $this->system->handle(new SendMessageToUsers($data['message'], $users));

        $response = new Response('Wiadomość została wysłana do wybranych użytkowników');
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    private function validateMessage(string $message): bool
    {
        $validator = Validation::createValidator();
        $errors = $validator->validate($message, [
            new Length(['min'=> 1, 'max' => 255]),
            new NotBlank(),
        ]);
        return !(count($errors) !== 0);
    }

}