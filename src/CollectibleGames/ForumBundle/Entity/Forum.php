<?php

namespace CollectibleGames\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Forum
 *
 * @ORM\Table(name="forum__forum")
 * @ORM\Entity
 */
class Forum
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
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=255)
     */
    private $icon;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="Forum")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(name="categorie", referencedColumnName="id")
     */
    private $categorie;
	
    /**
     * @ORM\OneToMany(targetEntity="Topic", mappedBy="forum", cascade={"persist", "remove"})
     */
    protected $topics;
	
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
     * @return Forum
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
     * @return Forum
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
     * Set icon
     *
     * @param string $icon
     * @return Forum
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string 
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set parent
     *
     * @param \stdClass $parent
     * @return Forum
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \stdClass 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set categorie
     *
     * @param \stdClass $categorie
     * @return Forum
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \stdClass 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
	
	public function getTopics()			
	{	
		return $this->topics;	
	}
	public function setTopics($f)		
	{
		$this->topics = $f;	
	}
	public function addTopics($f)		
	{
		$this->topics[] = $f;	
	}
	public function removeTopics($f)		
	{
		$this->topics->removeElement($f);	
	}
	
    public function setLastMessage($lastMessage)
    {
        $this->lastMessage = $lastMessage;
        return $this;
    }
    public function getLastMessage()
    {
        return $this->lastMessage;
    }
}
