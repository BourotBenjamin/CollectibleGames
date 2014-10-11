<?php

namespace CollectibleGames\ForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="forum__categorie")
 * @ORM\Entity
 */
class Categorie
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
     * @var integer
     *
     * @ORM\Column(name="place", type="integer")
     */
    private $place;
	
    /**
     * @ORM\OneToMany(targetEntity="Forum", mappedBy="categorie", cascade={"persist", "remove"})
     */
    protected $forums;


	public function __construct()
	{
        $this->forums = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Categorie
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
     * Set place
     *
     * @param integer $place
     * @return Categorie
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return integer 
     */
    public function getPlace()
    {
        return $this->place;
    }
	
	public function getForums()			
	{	
		return $this->forums;	
	}
	public function setForums($f)		
	{
		$this->forums = $f;	
	}
	public function addForums($f)		
	{
		$this->forums[] = $f;	
	}
	public function removeForums($f)		
	{
		$this->forums->removeElement($f);	
	}
}
