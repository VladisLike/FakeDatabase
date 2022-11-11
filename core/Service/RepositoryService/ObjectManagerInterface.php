<?php

namespace Core\Service\RepositoryService;

use Core\Common\Model;

interface ObjectManagerInterface
{
    public function getObject(array $item): Model;

}