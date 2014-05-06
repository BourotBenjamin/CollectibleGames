<?php

namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Editeur
 *
 * @ORM\Table(name="bddjv_editeur")
 * @ORM\Entity(repositoryClass="CollectibleGames\DatabaseBundle\Entity\EditeurRepository")
 */
class Editeur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_editeur", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_editeur", type="string", length=255)
     */
    private $name;
	
    /**
     * @var string
     *
     * @ORM\Column(name="description_editeur", type="text")
     */
    private $description;
	
	 /**
     * @ORM\Column(name="editeur_valide", type="boolean")
     */
	protected $valide;
	
	 /**
     * @ORM\Column(name="logo_editeur", type="string", length=255)
     */
	protected $imageUrl;
	protected $image;

    /**
     * @ORM\OneToMany(targetEntity="Plateforme", mappedBy="editeur")
     */
    protected $plateformes;	

	function __construct()
	{
		$plateformes = new \Doctrine\Common\Collections\ArrayCollection();
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
    /**
     * Set description
     *
     * @param string $description
     * @return NomJeu
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
	
	public function getValide()			
	{	
		return $this->valide;	
	}
	public function setValide($v)		
	{
		$this->valide = $v;	
	}
	
	public function getPlateformes()			
	{	
		return $this->plateformes;	
	}
	public function setPlateformes($p)		
	{
		$this->plateformes = $p;	
	}
	public function addPlateforme($p)		
	{
		$this->plateformes[] = $p;	
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
