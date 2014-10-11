<?php

namespace CollectibleGames\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 *
 * @ORM\Table(name="forum__topic")
 * @ORM\Entity
 */
class Topic
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="CollectibleGames\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     */
    private $createdBy;

    /**
     * @var boolean
     *
     * @ORM\Column(name="locked", type="boolean")
     */
    private $locked;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="Forum")
     * @ORM\JoinColumn(name="forum", referencedColumnName="id")
     */
    private $forum;

    /**
     * @var boolean
     *
     * @ORM\Column(name="type", type="boolean")
     */
    private $type;
	
    /**
     * @ORM\OneToMany(targetEntity="Message", mappedBy="topic", cascade={"persist", "remove"})
     */
    protected $messages;
	
    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;
	
    /**
     * @var string
     *
     * @ORM\Column(name="replied_at", type="datetime")
     */
    private $repliedAt;
	
    /**
	* @ORM\OneToOne(targetEntity="Message")
	* @ORM\JoinColumn(name="lastMessage", referencedColumnName="id")
     */
    protected $lastMessage;


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
     * Set name
     *
     * @param string $name
     * @return Topic
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Topic
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
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
     * Set locked
     *
     * @param boolean $locked
     * @return Topic
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

    /**
     * Get locked
     *
     * @return boolean 
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set forum
     *
     * @param \stdClass $forum
     * @return Topic
     */
    public function setForum($forum)
    {
        $this->forum = $forum;

        return $this;
    }

    /**
     * Get forum
     *
     * @return \stdClass 
     */
    public function getForum()
    {
        return $this->forum;
    }

    /**
     * Set type
     *
     * @param boolean $type
     * @return Topic
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean 
     */
    public function getType()
    {
        return $this->type;
    }
	
	public function getMessages()			
	{	
		return $this->messages;	
	}
	public function setMessages($f)		
	{
		$this->messages = $f;	
	}
	public function addMessages($f)		
	{
		$this->messages[] = $f;	
		$this->lastMessage = $f;
	}
	public function removeMessages($f)		
	{
		$this->messages->removeElement($f);	
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
    /**
     * Set repliedAt
     *
     * @param Date $createdAt
     * @return Topic
     */
    public function setRepliedAt($repliedAt)
    {
        $this->repliedAt = $repliedAt;

        return $this;
    }

    /**
     * Get repliedAt
     *
     * @return Date 
     */
    public function getRepliedAt()
    {
        return $this->repliedAt;
    }
	
    public function getLastMessage()
    {
        return $this->lastMessage;
    }
}
