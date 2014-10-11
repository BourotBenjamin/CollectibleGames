<?php

namespace CollectibleGames\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="forum__message")
 * @ORM\Entity
 */
class Message
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var 
     *
     * @ORM\ManyToOne(targetEntity="Topic")
     * @ORM\JoinColumn(name="topic", referencedColumnName="id")
     */
    private $topic;
	
    /**
     * @var 
     *
     * @ORM\ManyToOne(targetEntity="CollectibleGames\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     */
    private $createdBy;
	
    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


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
     * Set text
     *
     * @param string $text
     * @return Message
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set topic
     *
     * @param \stdClass $topic
     * @return Message
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return \stdClass 
     */
    public function getTopic()
    {
        return $this->topic;
    }
    /**
     * Set createdBy
     *
     * @param User $createdBy
     * @return Topic
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
    /**
     * Set createdAt
     *
     * @param Date $createdAt
     * @return Topic
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return Date 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
