<?php

namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionConsole
 *
 * @ORM\Table(name="bddjv_version_console")
 * @ORM\Entity(repositoryClass="CollectibleGames\DatabaseBundle\Entity\VersionConsoleRepository")
 */
class VersionConsole
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_version_console", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
	
    /**
     * @ORM\ManyToOne(targetEntity="Console", inversedBy="versions")
     * @ORM\JoinColumn(name="id_console", referencedColumnName="id_console")
     */
    protected $console;
	
    /**
     * @ORM\ManyToOne(targetEntity="Region")
     * @ORM\JoinColumn(name="id_region", referencedColumnName="id_region")
     */
    protected $region;
	
	 /**
     * @ORM\Column(name="photo_console", type="string", length=255)
     */
	protected $photoUrl;
	protected $photo;
	
	 /**
     * @ORM\Column(name="remarque_version_console",  type="string", length=255, nullable=true)
     */
	protected $remarque_version_console;
	
	 /**
     * @ORM\Column(name="date_sortie_console",  type="string", nullable=true)
     */
	protected $date_sortie_console;	
	
	 /**
     * @ORM\Column(name="prix_console",  type="integer", nullable=true)
     */
	protected $prix;
	
	 /**
     * @ORM\Column(name="ref_console",  type="string", length=30, nullable=true)
     */
	protected $reference_console;
	
	 /**
     * @ORM\Column(name="code_barre_console",  type="string", length=30, nullable=true)
     */
	protected $code_barre_console;
	
	 /**
     * @ORM\Column(name="version_console_valide", type="boolean")
     */
	protected $valide;
	
    /**
	 * @ORM\ManyToMany(targetEntity="Jeu")
	 * @ORM\JoinTable(name="bddjv_console_inclus_jeu",
     *      joinColumns={@ORM\JoinColumn(name="id_version_console", referencedColumnName="id_version_console")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_jeu", referencedColumnName="id_jeu")}
     *      )
	 */
    protected $jeux;	
	
    /**
	 * @ORM\ManyToMany(targetEntity="Accessoire")
	 * @ORM\JoinTable(name="bddjv_console_inclus_accessoire",
     *      joinColumns={@ORM\JoinColumn(name="id_version_console", referencedColumnName="id_version_console")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_accessoire", referencedColumnName="id_accessoire")}
     *      )
	 */
    protected $accessoires;	
	
    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return "Region : ".$this->region->getName();
    }

	public function __construct()
	{
		$this->photoUrl = 'img/inconnu.png';
		$this->valide = 0;
        $this->remarque_version_console = "";
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
	
	public function getRegion()			
	{	
		return $this->region;	
	}
	public function setRegion($r)		
	{
		$this->region = $r;	
	}
	
	public function getPrix()			
	{	
		return $this->prix;	
	}
	public function setPrix($p)		
	{
		$this->prix = $p;	
	}
	
	public function getRemarqueVersionConsole()			
	{	
		return $this->remarque_version_console;	
	}
	public function setRemarqueVersionConsole($r)		
	{
		$this->remarque_version_console = $r;	
	}
	
	public function getDateSortieConsole()			
	{	
		return $this->date_sortie_console;	
	}
	public function setDateSortieConsole($d)		
	{
		$this->date_sortie_console = $d;	
	}
	
	public function getReferenceConsole()			
	{	
		return $this->reference_console;	
	}
	public function setReferenceConsole($r)		
	{
		$this->reference_console = $r;	
	}
	
	public function getCodeBarreConsole()			
	{	
		return $this->code_barre_console;	
	}
	public function setCodeBarreConsole($c)		
	{
		$this->code_barre_console = $c;	
	}
	
	public function getPhotoUrl()			
	{	
		return $this->photoUrl;	
	}
	public function setPhotoUrl($p)		
	{
		$this->photoUrl = $p;	
	}
	public function getPhoto()			
	{	
		return $this->photo;	
	}
	public function setPhoto($p)		
	{
		$this->photo = $p;	
	}
	public function updatePhotosUrls()		
	{
		if(!is_dir($this->getUploadRootDir().'/img/consoles/'.$this->getConsole()->getPlateforme()->getId().'/'))
		{
			mkdir($this->getUploadRootDir().'/img/consoles/'.$this->getConsole()->getPlateforme()->getId().'/', 0777, true);
		}
		$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/","°");
		$name = str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($this->console->getName())))).'-'.$this->getId();
		$folder =  'img/consoles/'.$this->getConsole()->getPlateforme()->getId().'/';
		if (null === $this->photo) { if(!$this->photoUrl) {$this->photoUrl = 'img/inconnu.png';} } else {
		$this->photo->move($this->getUploadRootDir().$folder, $name.'.png');
		$this->photoUrl = $folder.$name.'.png'; }
	}
	
	public function getValide()			
	{	
		return $this->valide;	
	}
	public function setValide($v)		
	{
		$this->valide = $v;	
	}
	public function getConsole()			
	{	
		return $this->console;	
	}
	public function setConsole($c)		
	{
		$this->console = $c;	
	}

	public function getUploadDir()
	{
		// On retourne le chemin relatif vers l'image pour un navigateur
		return './';
	}

	protected function getUploadRootDir()
	{
		// On retourne le chemin relatif vers l'image pour notre code PHP
		return __DIR__.'/../../../../'.$this->getUploadDir();
	}
}
