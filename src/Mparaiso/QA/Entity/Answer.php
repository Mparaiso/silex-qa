<?php

namespace Mparaiso\QA\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Answer
 *
 * @ORM\Table(name="Answer")
 * @ORM\Entity
 */
class Answer
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
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Mparaiso\QA\Entity\Relevancy", mappedBy="answer")
     */
    private $relevancies;

    /**
     * @var \Mparaiso\QA\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Mparaiso\QA\Entity\User", inversedBy="answers")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Mparaiso\QA\Entity\Question
     *
     * @ORM\ManyToOne(targetEntity="Mparaiso\QA\Entity\Question", inversedBy="answers")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     * })
     */
    private $question;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->relevancies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    function __toString()
    {
        return $this->getBody();
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
     * Set body
     *
     * @param string $body
     * @return Answer
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Answer
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Answer
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add relevancies
     *
     * @param \Mparaiso\QA\Entity\Relevancy $relevancies
     * @return Answer
     */
    public function addRelevancie(\Mparaiso\QA\Entity\Relevancy $relevancies)
    {
        $this->relevancies[] = $relevancies;

        return $this;
    }

    /**
     * Remove relevancies
     *
     * @param \Mparaiso\QA\Entity\Relevancy $relevancies
     */
    public function removeRelevancie(\Mparaiso\QA\Entity\Relevancy $relevancies)
    {
        $this->relevancies->removeElement($relevancies);
    }

    /**
     * Get relevancies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRelevancies()
    {
        return $this->relevancies;
    }

    /**
     * Set user
     *
     * @param \Mparaiso\QA\Entity\User $user
     * @return Answer
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
     * Set question
     *
     * @param \Mparaiso\QA\Entity\Question $question
     * @return Answer
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
     * FR : Faire la somme de toutes les relevancies
     */
    public function getRelevancy()
    {
        return array_reduce($this->getRelevancies()->toArray(), function ($total, Relevancy $relevancy) {
             $total += (int)$relevancy->getScore();
             return $total;
        },0);
    }
}
