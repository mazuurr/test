<?php

namespace App\Core\User\Application\Query\GetUsersByStatus;

use App\Core\User\Domain\Repository\UserRepositoryInterface;
use App\Core\User\Application\DTO\UserDTO;
use App\Core\User\Domain\User;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetUsersByStatusHandler
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    public function __invoke(GetUsersByStatusQuery $query)
    {
        $users = $this->userRepository->getUsersByStatus($query->active);

        return array_map(function (User $user) {
            return new UserDTO(
                $user->getId(),
                $user->getEmail(),
                $user->isActive(),
            );
        }, $users);
    }
}