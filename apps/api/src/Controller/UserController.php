<?php


namespace Api\Controller;


use App\Messenger\Application\SystemInterface;
use App\Messenger\Infrastructure\Filesystem\FileUserQuery;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UserController
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

    public function indexAction(): Response
    {
        $users = $this->serializer->serialize($this->system->query(FileUserQuery::class)->getAll(), 'json');
        $response = new Response($users);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}