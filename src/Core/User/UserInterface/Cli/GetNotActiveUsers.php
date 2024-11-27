<?php

namespace App\Core\User\UserInterface\Cli;


use App\Common\Bus\QueryBusInterface;
use App\Core\User\Application\DTO\UserDTO;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Core\User\Application\Query\GetUsersByStatus\GetUsersByStatusQuery;

#[AsCommand(
    name: 'app:user:get-not-active',
    description: 'Pobieranie identyfikatorów nieaktywnych użytkowników'
)]
class GetNotActiveUsers extends Command
{
    public function __construct(private readonly QueryBusInterface $bus)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $users = $this->bus->dispatch(new GetUsersByStatusQuery(
            false
        ));

        /** @var UserDTO $user */
        foreach ($users as $user){
            $output->writeln($user->id);
        }

        return Command::SUCCESS;
    }
}