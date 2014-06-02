<?php

namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupe
 *
 * @ORM\Table(name="bddjv_groupe")
 * @ORM\Entity
 */
class Groupe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_groupe", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_groupe", type="string", length=255)
     */
    private $name;
	
	 /**
     * @ORM\Column(name="groupe_valide", type="boolean")
     */
	protected $valide;
	
	
    /**
     * @ORM\ManyToOne(targetEntity="Groupe", inversedBy="childs")
     * @ORM\JoinColumn(name="id_groupe_parent", referencedColumnName="id_groupe")
     */
    protected $groupe_parent;
	
    /**
     * @ORM\OneToMany(targetEntity="Groupe", mappedBy="groupe_parent")
     */
    protected $childs;	
	
	
	 /**
     * @ORM\Column(name="logo_groupe", type="string", length=255)
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
	
	public function getParent()			
	{	
		return $this->groupe_parent;	
	}
	public function setParent($p)		
	{
		$this->groupe_parent = $p;	
	}
	
	public function getChilds()			
	{	
		return $this->valide;	
	}
	public function addChild($c)		
	{
		$this->childs[] = $c;	
	}
	public function setChilds($c)		
	{
		$this->childs = $c;	
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
