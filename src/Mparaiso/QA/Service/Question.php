<?php

namespace Mparaiso\QA\Service;

use Mparaiso\CodeGeneration\Service\CRUDService;

class Question extends CRUDService
{
    function getLatest($limit = 10, $offset = 0)
    {
        return $this->findBy(array(), array('createdAt' => "DESC"), $limit, $offset);
    }

    function getPopular($limit = NULL, $offset = NULL)
    {
        $questions = $this->findBy(array(), array(), $limit, $offset);
        uasort($questions, function ($Q1, $Q2) {
            $c1 = count($Q1->getInterests());
            $c2 = count($Q2->getInterests());
            return $c1 > $c2 ? -1 : $c1 < $c2 ? 1 : 0;
        });
        return $questions;
    }

    function findAnswers($question)
    {
    }
}

