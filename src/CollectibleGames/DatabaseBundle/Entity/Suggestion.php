<?php

namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Suggestion
 *
 * @ORM\Table(name="bugtracker")
 * @ORM\Entity
 */
class Suggestion
{
    /**
     * @ORM\Column(name="id_bugtracker", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="description_bug", type="string", length=255)
     */
    private $description;
	
    /**
     * @ORM\Column(name="type_bug", type="integer")
     */
    private $type;
	
    /**
     * @ORM\Column(name="priorite_bug", type="integer")
     */
    private $priorite;
	
    /**
     * @ORM\Column(name="resolu_bug", type="integer")
     */
    private $resolu;

	public function __construct()
	{
		$this->priorite = 0;
		$this->resolu = 0;
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

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setPriorite($priorite)
    {
        $this->priorite = $priorite;
        return $this;
    }

    public function getPriorite()
    {
        return $this->priorite;
    }

    public function setResolu($resolu)
    {
        $this->resolu = $resolu;
        return $this;
    }

    public function getResolu()
    {
        return $this->resolu;
    }
}
