<?php

namespace Mparaiso\QA\Service;


use Mparaiso\CodeGeneration\Service\CRUDService;

class Answer extends CRUDService
{
    function getRecent($limit = NULL, $offset = NULL)
    {
        return $this->findBy(array(),
            array('createdAt' => "DESC"), $limit, $offset);
    }

    function findByQuestion($question)
    {
        return $this->em->getRepository($this->class)->findByQuestion($question);
    }

}