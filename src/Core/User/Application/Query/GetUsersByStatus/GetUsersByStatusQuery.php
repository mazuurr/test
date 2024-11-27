<?php

namespace App\Core\User\Application\Query\GetUsersByStatus;

class GetUsersByStatusQuery
{
    public function __construct(public readonly bool $active)
    {
    }
}