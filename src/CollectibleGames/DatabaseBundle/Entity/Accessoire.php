<?php

namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accessoire
 *
 * @ORM\Table(name="bddjv_accessoire")/
 * @ORM\Entity
 */
class Accessoire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_accessoire", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
	 /**
     * @ORM\Column(name="nom_accessoire",  type="string", length=255, nullable=true)
     */
    protected $name;
	
    /**
     * @ORM\ManyToOne(targetEntity="Plateforme")
     * @ORM\JoinColumn(name="id_plateforme", referencedColumnName="id_plateforme")
     */
    protected $plateforme;
	
    /**
     * @ORM\ManyToOne(targetEntity="Editeur")
     * @ORM\JoinColumn(name="id_editeur", referencedColumnName="id_editeur")
     */
    protected $editeur;	
	
    /**
     * @ORM\ManyToOne(targetEntity="TypeAccessoire")
     * @ORM\JoinColumn(name="id_type_accessoire", referencedColumnName="id_type_accessoire")
     */
    protected $type;	
	
	 /**
     * @ORM\Column(name="accessoire_valide", type="boolean")
     */
	protected $valide;
	
	 /**
     * @ORM\Column(name="zone", type="boolean")
     */
	protected $zone;
	
	 /**
     * @ORM\Column(name="remarque_accessoire",  type="string", length=255, nullable=true)
     */
	protected $remarque_accessoire;
	
    /**
     * @ORM\OneToMany(targetEntity="VersionAccessoire", mappedBy="accessoire", cascade={"persist", "remove"})
     */
    protected $versions;	

	public function __construct()
	{
        $this->versions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->valide = 0;
        $this->zone = 0;
        $this->remarque_accessoire = "";
	}
	
    /**
     * Get id
     *
     * @return integer 
     */
    public function setId($id)
    {
		$this->id = $id;
        return $this;
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
	
	public function getZone()			
	{	
		return $this->zone;	
	}
	public function setZone($zone)		
	{
		$this->zone = $zone;	
	}
	
	public function getVersions()			
	{	
		return $this->versions;	
	}
	public function setVersions($v)		
	{
		$this->versions = $v;	
	}
	
	public function getRemarqueAccessoire()			
	{	
		return $this->remarque_accessoire;	
	}
	public function setRemarqueAccessoire($r)		
	{
		$this->remarque_accessoire = $r;	
	}
	
	public function getType()			
	{	
		return $this->type;	
	}
	public function setType($t)		
	{
		$this->type = $t;	
	}
	public function getEditeur()			
	{	
		return $this->editeur;	
	}
	public function setEditeur($e)		
	{
		$this->editeur = $e;	
	}
	public function getPlateforme()			
	{	
		return $this->plateforme;	
	}
	public function setPlateforme($p)		
	{
		$this->plateforme = $p;	
	}

}
