<?php

namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plateforme
 *
 * @ORM\Table(name="bddjv_plateforme")
 * @ORM\Entity(repositoryClass="CollectibleGames\DatabaseBundle\Entity\PlateformeRepository")
 */
class Plateforme
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_plateforme", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_plateforme", type="string", length=255)
     */
    private $name;
	
    /**
     * @var string
     *
     * @ORM\Column(name="description_plateforme", type="text")
     */
    private $description;
	
	 /**
     * @ORM\Column(name="plateforme_valide", type="boolean")
     */
	protected $valide;
	
	
    /**
     * @ORM\ManyToOne(targetEntity="Editeur", inversedBy="plateformes")
     * @ORM\JoinColumn(name="id_editeur", referencedColumnName="id_editeur")
     */
    protected $editeur;
	
	 /**
     * @ORM\Column(name="logo_plateforme", type="string", length=255)
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
	public function getEditeur()			
	{	
		return $this->editeur;	
	}
	public function setEditeur($e)		
	{
		$this->editeur = $e;	
	}
	public function getDescription()			
	{	
		return $this->description;	
	}
	public function setDescription($d)		
	{
		$this->description = $d;	
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
