<?php

namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeAccessoire
 *
 * @ORM\Table(name="bddjv_type_accessoire")
 * @ORM\Entity
 */
class TypeAccessoire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_type_accessoire", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_type_accessoire", type="string", length=255)
     */
    private $name;
	
	 /**
     * @ORM\Column(name="type_accessoire_valide", type="boolean")
     */
	protected $valide;
	
	 /**
     * @ORM\Column(name="logo_type_accessoire", type="string", length=255)
     */
	protected $imageUrl;
	protected $image;


	function __construct()
	{
		$this->imageUrl = "img/inconnu.png";
		$this->description = "";
		$this->valide = false;
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
