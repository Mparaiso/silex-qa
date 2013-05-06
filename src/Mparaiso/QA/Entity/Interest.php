<?php

namespace Mparaiso\QA\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Interest
 *
 * @ORM\Table(name="Interest")
 * @ORM\Entity
 */
class Interest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \Mparaiso\QA\Entity\Question
     *
     * @ORM\ManyToOne(targetEntity="Mparaiso\QA\Entity\Question", inversedBy="interests")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     * })
     */
    private $question;

    /**
     * @var \Mparaiso\QA\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Mparaiso\QA\Entity\User", inversedBy="interests")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    function __toString()
    {
        return $this->getQuestion() . "-" . $this->getUser();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Interest
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set question
     *
     * @param \Mparaiso\QA\Entity\Question $question
     * @return Interest
     */
    public function setQuestion(\Mparaiso\QA\Entity\Question $question = NULL)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Mparaiso\QA\Entity\Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set user
     *
     * @param \Mparaiso\QA\Entity\User $user
     * @return Interest
     */
    public function setUser(\Mparaiso\QA\Entity\User $user = NULL)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Mparaiso\QA\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
