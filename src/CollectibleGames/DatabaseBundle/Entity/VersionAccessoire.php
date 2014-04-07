<?php

namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionAccessoire
 *
 * @ORM\Table(name="bddjv_version_accessoire")
 * @ORM\Entity
 */
class VersionAccessoire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_version_accessoire", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
	
    /**
     * @ORM\ManyToOne(targetEntity="Accessoire", inversedBy="versions")
     * @ORM\JoinColumn(name="id_accessoire", referencedColumnName="id_accessoire")
     */
    protected $accessoire;
	
    /**
     * @ORM\ManyToOne(targetEntity="Region")
     * @ORM\JoinColumn(name="id_region", referencedColumnName="id_region")
     */
    protected $region;
	
	 /**
     * @ORM\Column(name="photo_accessoire", type="string", length=255)
     */
	protected $photoUrl;
	protected $photo;
	
	 /**
     * @ORM\Column(name="remarque_version_accessoire",  type="string", length=255, nullable=true)
     */
	protected $remarque_version_accessoire;
	
	 /**
     * @ORM\Column(name="date_sortie_accessoire",  type="string", nullable=true)
     */
	protected $date_sortie_accessoire;	
	
	 /**
     * @ORM\Column(name="prix_accessoire",  type="integer", nullable=true)
     */
	protected $prix;
	
	 /**
     * @ORM\Column(name="ref_accessoire",  type="string", length=30, nullable=true)
     */
	protected $reference_accessoire;
	
	 /**
     * @ORM\Column(name="code_barre_accessoire",  type="string", length=30, nullable=true)
     */
	protected $code_barre_accessoire;
	
	 /**
     * @ORM\Column(name="version_accessoire_valide", type="boolean")
     */
	protected $valide;

	public function __construct()
	{
		$this->photoUrl = 'img/inconnu.png';
		$this->valide = 0;
        $this->remarque_version_accessoire = "";
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
	
	public function getRemarqueVersionAccessoire()			
	{	
		return $this->remarque_version_accessoire;	
	}
	public function setRemarqueVersionAccessoire($r)		
	{
		$this->remarque_version_accessoire = $r;	
	}
	
	public function getDateSortieAccessoire()			
	{	
		return $this->date_sortie_accessoire;	
	}
	public function setDateSortieAccessoire($d)		
	{
		$this->date_sortie_accessoire = $d;	
	}
	
	public function getReferenceAccessoire()			
	{	
		return $this->reference_accessoire;	
	}
	public function setReferenceAccessoire($r)		
	{
		$this->reference_accessoire = $r;	
	}
	
	public function getCodeBarreAccessoire()			
	{	
		return $this->code_barre_accessoire;	
	}
	public function setCodeBarreAccessoire($c)		
	{
		$this->code_barre_accessoire = $c;	
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
		if(!is_dir($this->getUploadRootDir().'/img/accessoires/'.$this->getAccessoire()->getPlateforme()->getId().'/'))
		{
			mkdir($this->getUploadRootDir().'/img/accessoires/'.$this->getAccessoire()->getPlateforme()->getId().'/');
		}
		$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/","°");
		$name = str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($this->accessoire->getName())))).'-'.$this->getId();
		$folder =  'img/accessoires/'.$this->getAccessoire()->getPlateforme()->getId().'/';
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
	public function getAccessoire()			
	{	
		return $this->accessoire;	
	}
	public function setAccessoire($c)		
	{
		$this->accessoire = $c;	
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
