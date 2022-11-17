<?php

namespace App\Repository;


use App\Model\Post;
use Core\Repository\AbstractRepository;

class PostRepository extends AbstractRepository
{

    function getModel(): string
    {
        return Post::class;
    }
}