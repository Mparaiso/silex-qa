<?php

namespace Mparaiso\QA\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="User")
 * @ORM\Entity
 */
class User
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
     * @ORM\Column(name="nickname", type="string")
     */
    private $nickname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string")
     */
    private $email;

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
     * @ORM\OneToMany(targetEntity="Mparaiso\QA\Entity\Interest", mappedBy="user")
     */
    private $interests;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Mparaiso\QA\Entity\Question", mappedBy="user")
     */
    private $questions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Mparaiso\QA\Entity\Answer", mappedBy="user")
     */
    private $answers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Mparaiso\QA\Entity\Relevancy", mappedBy="user")
     */
    private $relevancies;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->interests = new \Doctrine\Common\Collections\ArrayCollection();
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->answers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->relevancies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    function __toString()
    {
        return $this->getNickname();
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
     * Set nickname
     *
     * @param string $nickname
     * @return User
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
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
     * @return User
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
     * Add interests
     *
     * @param \Mparaiso\QA\Entity\Interest $interests
     * @return User
     */
    public function addInterest(\Mparaiso\QA\Entity\Interest $interests)
    {
        $this->interests[] = $interests;

        return $this;
    }

    /**
     * Remove interests
     *
     * @param \Mparaiso\QA\Entity\Interest $interests
     */
    public function removeInterest(\Mparaiso\QA\Entity\Interest $interests)
    {
        $this->interests->removeElement($interests);
    }

    /**
     * Get interests
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * Add questions
     *
     * @param \Mparaiso\QA\Entity\Question $questions
     * @return User
     */
    public function addQuestion(\Mparaiso\QA\Entity\Question $questions)
    {
        $this->questions[] = $questions;

        return $this;
    }

    /**
     * Remove questions
     *
     * @param \Mparaiso\QA\Entity\Question $questions
     */
    public function removeQuestion(\Mparaiso\QA\Entity\Question $questions)
    {
        $this->questions->removeElement($questions);
    }

    /**
     * Get questions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * Add answers
     *
     * @param \Mparaiso\QA\Entity\Answer $answers
     * @return User
     */
    public function addAnswer(\Mparaiso\QA\Entity\Answer $answers)
    {
        $this->answers[] = $answers;

        return $this;
    }

    /**
     * Remove answers
     *
     * @param \Mparaiso\QA\Entity\Answer $answers
     */
    public function removeAnswer(\Mparaiso\QA\Entity\Answer $answers)
    {
        $this->answers->removeElement($answers);
    }

    /**
     * Get answers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Add relevancies
     *
     * @param \Mparaiso\QA\Entity\Relevancy $relevancies
     * @return User
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
}
