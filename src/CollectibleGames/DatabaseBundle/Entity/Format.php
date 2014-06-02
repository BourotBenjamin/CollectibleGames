<?php

namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Format
 *
 * @ORM\Table(name="bddjv_format")
 * @ORM\Entity
 */
class Format
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_format", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_format", type="string", length=255)
     */
    private $name;
	
	 /**
     * @ORM\Column(name="format_valide", type="boolean")
     */
	protected $valide;
	
	 /**
     * @ORM\Column(name="logo_format", type="string", length=255)
     */
	protected $imageUrl;
	protected $image;

	function __construct()
	{
		$this->imageUrl = "img/inconnu.png";
		$this->description = "";
		$this->valide = false;
	}

    public function __toString()
    {
        return $this->name;
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
     * @return NomJeu
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
	
	public function getValide()			
	{	
		return $this->valide;	
	}
	public function setValide($v)		
	{
		$this->valide = $v;	
	}
	
	public function getImage()			
	{	
		return $this->image;	
	}
	public function setImage($i)		
	{
		$this->image = $i;	
	}
	public function getImageUrl()		
	{	
		return $this->imageUrl;	
	}
	public function setImageUrl($i)		
	{	
		$this->imageUrl = $i;	
	}
}
