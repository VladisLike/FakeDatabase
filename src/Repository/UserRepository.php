<?php

namespace App\Repository;

use App\Model\User;
use Core\Repository\AbstractRepository;

class UserRepository extends AbstractRepository
{
    function getModel(): string
    {
        return User::class;
    }
}