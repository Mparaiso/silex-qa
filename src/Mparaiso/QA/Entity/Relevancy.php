<?php

namespace Mparaiso\QA\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Relevancy
 *
 * @ORM\Table(name="Relevancy")
 * @ORM\Entity
 */
class Relevancy
{
    /**
     * @var integer
     *
     * @ORM\Columwn(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="score", type="integer")
     */
    private $score;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \Mparaiso\QA\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Mparaiso\QA\Entity\User", inversedBy="relevancies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Mparaiso\QA\Entity\Answer
     *
     * @ORM\ManyToOne(targetEntity="Mparaiso\QA\Entity\Answer", inversedBy="relevancies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="answer_id", referencedColumnName="id")
     * })
     */
    private $answer;

    function __toString()
    {
       return $this->getAnswer()."-".$this->getUser();
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
     * Set score
     *
     * @param integer $score
     * @return Relevancy
     */
    public function setScore($score)
    {
        $this->score = $score;
    
        return $this;
    }

    /**
     * Get score
     *
     * @return integer 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Relevancy
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
     * Set user
     *
     * @param \Mparaiso\QA\Entity\User $user
     * @return Relevancy
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

    /**
     * Set answer
     *
     * @param \Mparaiso\QA\Entity\Answer $answer
     * @return Relevancy
     */
    public function setAnswer(\Mparaiso\QA\Entity\Answer $answer = NULL)
    {
        $this->answer = $answer;
    
        return $this;
    }

    /**
     * Get answer
     *
     * @return \Mparaiso\QA\Entity\Answer 
     */
    public function getAnswer()
    {
        return $this->answer;
    }
}
