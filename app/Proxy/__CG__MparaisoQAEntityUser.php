<?php

namespace DoctrineProxies\__CG__\Mparaiso\QA\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class User extends \Mparaiso\QA\Entity\User implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function __toString()
    {
        $this->__load();
        return parent::__toString();
    }

    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function setNickname($nickname)
    {
        $this->__load();
        return parent::setNickname($nickname);
    }

    public function getNickname()
    {
        $this->__load();
        return parent::getNickname();
    }

    public function setEmail($email)
    {
        $this->__load();
        return parent::setEmail($email);
    }

    public function getEmail()
    {
        $this->__load();
        return parent::getEmail();
    }

    public function setCreatedAt($createdAt)
    {
        $this->__load();
        return parent::setCreatedAt($createdAt);
    }

    public function getCreatedAt()
    {
        $this->__load();
        return parent::getCreatedAt();
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->__load();
        return parent::setUpdatedAt($updatedAt);
    }

    public function getUpdatedAt()
    {
        $this->__load();
        return parent::getUpdatedAt();
    }

    public function addInterest(\Mparaiso\QA\Entity\Interest $interests)
    {
        $this->__load();
        return parent::addInterest($interests);
    }

    public function removeInterest(\Mparaiso\QA\Entity\Interest $interests)
    {
        $this->__load();
        return parent::removeInterest($interests);
    }

    public function getInterests()
    {
        $this->__load();
        return parent::getInterests();
    }

    public function addQuestion(\Mparaiso\QA\Entity\Question $questions)
    {
        $this->__load();
        return parent::addQuestion($questions);
    }

    public function removeQuestion(\Mparaiso\QA\Entity\Question $questions)
    {
        $this->__load();
        return parent::removeQuestion($questions);
    }

    public function getQuestions()
    {
        $this->__load();
        return parent::getQuestions();
    }

    public function addAnswer(\Mparaiso\QA\Entity\Answer $answers)
    {
        $this->__load();
        return parent::addAnswer($answers);
    }

    public function removeAnswer(\Mparaiso\QA\Entity\Answer $answers)
    {
        $this->__load();
        return parent::removeAnswer($answers);
    }

    public function getAnswers()
    {
        $this->__load();
        return parent::getAnswers();
    }

    public function addRelevancie(\Mparaiso\QA\Entity\Relevancy $relevancies)
    {
        $this->__load();
        return parent::addRelevancie($relevancies);
    }

    public function removeRelevancie(\Mparaiso\QA\Entity\Relevancy $relevancies)
    {
        $this->__load();
        return parent::removeRelevancie($relevancies);
    }

    public function getRelevancies()
    {
        $this->__load();
        return parent::getRelevancies();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'nickname', 'email', 'createdAt', 'updatedAt', 'interests', 'questions', 'answers', 'relevancies');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}