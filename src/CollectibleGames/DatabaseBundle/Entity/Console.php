<?php

namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Console
 *
 * @ORM\Table(name="bddjv_console")/
 * @ORM\Entity(repositoryClass="CollectibleGames\DatabaseBundle\Entity\ConsoleRepository")
 */
class Console
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_console", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
	 /**
     * @ORM\Column(name="nom_console",  type="string", length=255, nullable=true)
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
     * @ORM\Column(name="console_valide", type="boolean")
     */
	protected $valide;
	
	 /**
     * @ORM\Column(name="remarque_console",  type="string", length=255, nullable=true)
     */
	protected $remarque_console;
	
    /**
     * @ORM\OneToMany(targetEntity="VersionConsole", mappedBy="console", cascade={"persist", "remove"})
     */
    protected $versions;	

	public function __construct()
	{
        $this->versions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->valide = 0;
        $this->remarque_console = "";
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
	
	public function getVersions()			
	{	
		return $this->versions;	
	}
	public function setVersions($v)		
	{
		$this->versions = $v;	
	}
	
	public function getRemarqueConsole()			
	{	
		return $this->remarque_console;	
	}
	public function setRemarqueConsole($r)		
	{
		$this->remarque_console = $r;	
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
