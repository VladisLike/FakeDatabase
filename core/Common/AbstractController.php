<?php

namespace Core\Common;

abstract class AbstractController
{

    abstract public function showAll();
    abstract public function get(int $id);
    abstract public function getBy(array $criteria);

}