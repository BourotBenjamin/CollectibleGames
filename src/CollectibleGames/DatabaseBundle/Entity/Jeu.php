<?php

namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jeu
 *
 * @ORM\Table(name="bddjv_jeu")/
 * @ORM\Entity(repositoryClass="CollectibleGames\DatabaseBundle\Entity\JeuRepository")
 */
class Jeu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_jeu", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
	 /**
     * @ORM\Column(name="nom_jeu",  type="string", length=255, nullable=false)
     */
    protected $name;
	
    /**
     * @ORM\ManyToOne(targetEntity="Plateforme")
     * @ORM\JoinColumn(name="id_plateforme", referencedColumnName="id_plateforme")
     */
    protected $plateforme;
	
    /**
     * @ORM\ManyToOne(targetEntity="TypeJeu")
     * @ORM\JoinColumn(name="id_type_jeu", referencedColumnName="id_type_jeu")
     */
    protected $type;
	
    /**
     * @ORM\ManyToOne(targetEntity="Groupe")
     * @ORM\JoinColumn(name="id_groupe", referencedColumnName="id_groupe")
     */
    protected $groupe;
	
    /**
     * @ORM\ManyToOne(targetEntity="Developpeur")
     * @ORM\JoinColumn(name="id_developpeur", referencedColumnName="id_developpeur")
     */
    protected $developpeur;	
	
    /**
	 * @ORM\ManyToMany(targetEntity="Plateforme")
	 * @ORM\JoinTable(name="bddjv_autre_plateforme_jeu",
     *      joinColumns={@ORM\JoinColumn(name="id_jeu", referencedColumnName="id_jeu")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_plateforme", referencedColumnName="id_plateforme")}
     *      )
	 */
    protected $autre_plateformes;
	
    /**
	 * @ORM\ManyToMany(targetEntity="Commande")
	 * @ORM\JoinTable(name="bddjv_commande_jeu",
     *      joinColumns={@ORM\JoinColumn(name="id_jeu", referencedColumnName="id_jeu")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_commande", referencedColumnName="id_commande")}
     *      )
	 */
    protected $commandes;	
	
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_joueurs", type="integer")
     */
    private $nombre_joueurs;
	
	 /**
     * @ORM\Column(name="jeu_valide", type="boolean")
     */
	protected $valide;
	
	 /**
     * @ORM\Column(name="remarque_jeu",  type="string", length=255, nullable=true)
     */
	protected $remarque_jeu;
	
    /**
     * @ORM\OneToMany(targetEntity="VersionJeu", mappedBy="jeu", cascade={"persist", "remove"})
     */
    protected $versions;	

	public function __construct()
	{
        $this->versions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->commandes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->autre_plateformes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->valide = 0;
        $this->nombre_joueurs = 0;
        $this->remarque_jeu = "";
	}
	
	public function __toString()
	{
		return $this->getName()." (".$this->getPlateforme()->getName().")";
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
	
	public function getRemarqueJeu()			
	{	
		return $this->remarque_jeu;	
	}
	public function setRemarqueJeu($r)		
	{
		$this->remarque_jeu = $r;	
	}
	
	public function getNombreJoueurs()			
	{	
		return $this->nombre_joueurs;	
	}
	public function setNombreJoueurs($n)		
	{
		$this->nombre_joueurs = $n;	
	}
	
	public function getCommandes()			
	{	
		return $this->commandes;	
	}
	public function setCommandes($c)		
	{
		$this->commandes = $c;	
	}
	public function addCommande($c)		
	{
		$this->commandes[] = $c;	
	}
	public function removeCommande($c)		
	{
		$key = array_search($c, $this->commandes);
		if($key!==false){
			unset($this->commandes[$key]);
		}
	}
	
	public function getAutresPlateformes()			
	{	
		return $this->autre_plateformes;	
	}
	public function setAutresPlateformes($p)		
	{
		$this->autre_plateformes = $p;	
	}
	public function addAutrePlateforme($p)		
	{
		$this->autre_plateformes[] = $p;	
	}
	
	public function getDeveloppeur()			
	{	
		return $this->developpeur;	
	}
	public function setDeveloppeur($d)		
	{
		$this->developpeur = $d;	
	}
	public function getPlateforme()			
	{	
		return $this->plateforme;	
	}
	public function setPlateforme($p)		
	{
		$this->plateforme = $p;	
	}
	public function getType()			
	{	
		return $this->type;	
	}
	public function setType($t)		
	{
		$this->type = $t;	
	}
	public function getGroupe()			
	{	
		return $this->groupe;	
	}
	public function setGroupe($g)		
	{
		$this->groupe = $g;	
	}

}
