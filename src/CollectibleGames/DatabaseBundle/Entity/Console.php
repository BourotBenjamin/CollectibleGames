<?php

namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Console
 *
 * @ORM\Table(name="bddjv_console")/
 * @ORM\Entity
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
	
    /**
	 * @ORM\ManyToMany(targetEntity="Jeu")
	 * @ORM\JoinTable(name="bddjv_console_inclus_jeu",
     *      joinColumns={@ORM\JoinColumn(name="id_console", referencedColumnName="id_console")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_jeu", referencedColumnName="id_jeu")}
     *      )
	 */
    protected $jeux;	
	
    /**
	 * @ORM\ManyToMany(targetEntity="Accessoire")
	 * @ORM\JoinTable(name="bddjv_console_inclus_accessoire",
     *      joinColumns={@ORM\JoinColumn(name="id_console", referencedColumnName="id_console")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_accessoire", referencedColumnName="id_accessoire")}
     *      )
	 */
    protected $accessoires;	

	public function __construct()
	{
        $this->versions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->jeux = new \Doctrine\Common\Collections\ArrayCollection();
        $this->valide = 0;
        $this->remarque_console = "";
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
	
	public function getJeux()			
	{	
		return $this->jeux;	
	}
	public function setJeux($j)		
	{
		$this->jeux = $j;	
	}
	public function addJeux($j)		
	{
		$this->jeux[] = $j;	
	}
	
	public function getAccessoires()			
	{	
		return $this->accessoires;	
	}
	public function setAccessoires($j)		
	{
		$this->accessoires = $j;	
	}
	public function addAccessoires($j)		
	{
		$this->accessoires[] = $j;	
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
