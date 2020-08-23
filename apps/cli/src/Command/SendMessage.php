<?php


namespace Cli\Command;


use App\Messenger\Application\Command\SendMessageToUsers;
use App\Messenger\Application\SystemInterface;
use App\Messenger\Infrastructure\Filesystem\FileUserQuery;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class SendMessage extends Command
{
    private SystemInterface $system;

    public function __construct(SystemInterface $system)
    {
        $this->system = $system;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('send-message')
            ->setDescription('Wysyła podaną wiadomość do wybranych użytkowników')
            ->addArgument('message', InputArgument::REQUIRED, 'Treść wiadomości')
            ->addArgument(
                'userEmails',
                InputArgument::IS_ARRAY | InputArgument::OPTIONAL,
                'Emaile użytkowników, do których chcesz wysłać wiadomość (kolejne adresy email oddzielaj spacjami. Pozostaw pole puste jeśli chcesz wysłać wiadomość do wszystkich użytkowników w systemie');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $message = $input->getArgument('message');
        $userEmails = $input->getArgument('userEmails');
        if (empty($userEmails)) {
            $users = $this->system->query(FileUserQuery::class)->getAll();
        } else {
            $users = $this->system->query(FileUserQuery::class)->getByEmails($userEmails);
        }
        $helper = new QuestionHelper();
        $question = new ConfirmationQuestion(
            'Zamierzasz wysłać wiadomość do ' . count($users) . ' użytkowników, na ustawione u nich kanały kontaktowe.' . PHP_EOL
            . 'Chcesz kontynuować? (y/n)' . PHP_EOL
            , false
        );
        if (!$helper->ask($input, $output, $question)) {
            $output->writeln('Aborcja!');
            return Command::FAILURE;
        }
        $this->system->handle(new SendMessageToUsers($message, $users));
        $output->writeln('Sukces!');
        return Command::SUCCESS;
    }

}