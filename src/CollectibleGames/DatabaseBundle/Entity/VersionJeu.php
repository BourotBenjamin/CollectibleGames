<?php

namespace CollectibleGames\DatabaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionJeu
 *
 * @ORM\Table(name="bddjv_version_jeu")
 * @ORM\Entity(repositoryClass="CollectibleGames\DatabaseBundle\Entity\VersionJeuRepository")
 */
class VersionJeu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_version_jeu", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
	
    /**
     * @ORM\ManyToOne(targetEntity="Jeu", inversedBy="versions")
     * @ORM\JoinColumn(name="id_jeu", referencedColumnName="id_jeu")
     */
    protected $jeu;
	
    /**
     * @ORM\ManyToOne(targetEntity="Region")
     * @ORM\JoinColumn(name="id_region", referencedColumnName="id_region")
     */
    protected $region;
	
    /**
     * @ORM\ManyToOne(targetEntity="Edition")
     * @ORM\JoinColumn(name="id_edition", referencedColumnName="id_edition")
     */
    protected $edition;
	
	 /**
     * @ORM\Column(name="photo_boite", type="string", length=255)
     */
	protected $photoBoiteUrl;
	protected $photoBoite;
	
	 /**
     * @ORM\Column(name="photo_dos_boite", type="string", length=255)
     */
	protected $photoDosBoiteUrl;
	protected $photoDosBoite;
	
	 /**
     * @ORM\Column(name="photo_loose", type="string", length=255)
     */
	protected $photoLooseUrl;
	protected $photoLoose;
	
	 /**
     * @ORM\Column(name="photo_notice", type="string", length=255)
     */
	protected $photoNoticeUrl;
	protected $photoNotice;
	
	 /**
     * @ORM\Column(name="photo_misc", type="string", length=255)
     */
	protected $photoMiscUrl;
	protected $photoMisc;
	
    /**
     * @ORM\ManyToOne(targetEntity="Editeur")
     * @ORM\JoinColumn(name="id_editeur", referencedColumnName="id_editeur")
     */
    protected $editeur;
	
    /**
     * @ORM\ManyToOne(targetEntity="Support")
     * @ORM\JoinColumn(name="id_support", referencedColumnName="id_support")
     */
    protected $support;
	
    /**
     * @ORM\ManyToOne(targetEntity="Format")
     * @ORM\JoinColumn(name="id_format", referencedColumnName="id_format")
     */
    protected $format;
	
	 /**
     * @ORM\Column(name="remarque_version_jeu",  type="string", length=255, nullable=true)
     */
	protected $remarque_version_jeu;
	
	 /**
     * @ORM\Column(name="date_sortie_jeu",  type="string", nullable=true)
     */
	protected $date_sortie_jeu;
	
	 /**
     * @ORM\Column(name="reference_jeu",  type="string", length=30, nullable=true)
     */
	protected $reference_jeu;
	
	 /**
     * @ORM\Column(name="code_barre_jeu",  type="string", length=30, nullable=true)
     */
	protected $code_barre_jeu;
	
	 /**
     * @ORM\Column(name="version_jeu_valide", type="boolean")
     */
	protected $valide;
	
    /**
     * @ORM\Column(name="autre_nom_jeu",  type="string", length=255, nullable=true)
	 */
    protected $autre_nom_jeu;
	
    /**
	 * @ORM\ManyToMany(targetEntity="Langue")
	 * @ORM\JoinTable(name="bddjv_langue_jeu",
     *      joinColumns={@ORM\JoinColumn(name="id_version_jeu", referencedColumnName="id_version_jeu")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_langue", referencedColumnName="id_langue")}
     *      )
	 */
    protected $langues_jeu;	
	
    /**
	 * @ORM\ManyToMany(targetEntity="Accessoire")
	 * @ORM\JoinTable(name="bddjv_jeu_inclus_accessoire",
     *      joinColumns={@ORM\JoinColumn(name="id_version_jeu", referencedColumnName="id_version_jeu")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_accessoire", referencedColumnName="id_accessoire")}
     *      )
	 */
    protected $accessoires;	

	public function __construct()
	{
        $this->langues_jeu = new \Doctrine\Common\Collections\ArrayCollection();
		$this->photoBoiteUrl = 'img/inconnu.png';
		$this->photoMiscUrl = 'img/inconnu.png';
		$this->photoNoticeUrl = 'img/inconnu.png';
		$this->photoLooseUrl = 'img/inconnu.png';
		$this->photoDosBoiteUrl = 'img/inconnu.png';
		$this->valide = 0;
        $this->remarque_version_jeu = "";
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
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return "Region : ".$this->region->getName()." - Edition : ".$this->edition->getName();
    }
	
	public function getRegion()			
	{	
		return $this->region;	
	}
	public function setRegion($r)		
	{
		$this->region = $r;	
	}
	
	public function getEdition()			
	{	
		return $this->edition;	
	}
	public function setEdition($e)		
	{
		$this->edition = $e;	
	}
	
	public function getEditeur()			
	{	
		return $this->editeur;	
	}
	public function setEditeur($e)		
	{
		$this->editeur = $e;	
	}
	
	public function getSupport()			
	{	
		return $this->support;	
	}
	public function setSupport($s)		
	{
		$this->support = $s;	
	}
	
	public function getFormat()			
	{	
		return $this->format;	
	}
	public function setFormat($f)		
	{
		$this->format = $f;	
	}
	public function getLanguesJeu()			
	{	
		return $this->langues_jeu;	
	}
	public function setLanguesJeu($l)		
	{
		$this->langues_jeu = $l;	
	}
	public function addLangueJeu($l)		
	{
		$this->langues_jeu[] = $l;	
	}
	
	public function getRemarqueVersionJeu()			
	{	
		return $this->remarque_version_jeu;	
	}
	public function setRemarqueVersionJeu($r)		
	{
		$this->remarque_version_jeu = $r;	
	}
	
	public function getDateSortieJeu()			
	{	
		return $this->date_sortie_jeu;	
	}
	public function setDateSortieJeu($d)		
	{
		$this->date_sortie_jeu = $d;	
	}
	
	public function getReferenceJeu()			
	{	
		return $this->reference_jeu;	
	}
	public function setReferenceJeu($r)		
	{
		$this->reference_jeu = $r;	
	}
	
	public function getCodeBarreJeu()			
	{	
		return $this->code_barre_jeu;	
	}
	public function setCodeBarreJeu($c)		
	{
		$this->code_barre_jeu = $c;	
	}
	
	public function getAutreNomJeu()			
	{	
		return $this->autre_nom_jeu;	
	}
	public function setAutreNomJeu($n)		
	{
		$this->autre_nom_jeu = $n;	
	}
	
	public function getPhotoDosBoiteUrl()			
	{	
		return $this->photoDosBoiteUrl;	
	}
	public function setPhotoDosBoiteUrl($p)		
	{
		$this->photoDosBoiteUrl = $p;	
	}
	public function getPhotoLooseUrl()			
	{	
		return $this->photoLooseUrl;	
	}
	public function setPhotoLooseUrl($p)		
	{
		$this->photoLooseUrl = $p;	
	}
	public function getPhotoNoticeUrl()			
	{	
		return $this->photoNoticeUrl;	
	}
	public function setPhotoNoticeUrl($p)		
	{
		$this->photoNoticeUrl = $p;	
	}
	public function getPhotoMiscUrl()			
	{	
		return $this->photoMiscUrl;	
	}
	public function setPhotoMiscUrl($p)		
	{
		$this->photoMiscUrl = $p;	
	}
	public function getPhotoBoiteUrl()			
	{	
		return $this->photoBoiteUrl;	
	}
	public function setPhotoBoiteUrl($p)		
	{
		$this->photoBoiteUrl = $p;	
	}
	
	public function getPhotoDosBoite()			
	{	
		return $this->photoDosBoite;	
	}
	public function setPhotoDosBoite($p)		
	{
		$this->photoDosBoite = $p;	
	}
	public function getPhotoLoose()			
	{	
		return $this->photoLoose;	
	}
	public function setPhotoLoose($p)		
	{
		$this->photoLoose = $p;	
	}
	public function getPhotoNotice()			
	{	
		return $this->photoNotice;	
	}
	public function setPhotoNotice($p)		
	{
		$this->photoNotice = $p;	
	}
	public function getPhotoMisc()			
	{	
		return $this->photoMisc;	
	}
	public function setPhotoMisc($p)		
	{
		$this->photoMisc = $p;	
	}
	public function getPhotoBoite()			
	{	
		return $this->photoBoite;	
	}
	public function setPhotoBoite($p)		
	{
		$this->photoBoite = $p;	
	}
	public function updatePhotosUrls()		
	{
		if(!is_dir($this->getUploadRootDir().'/img/jeux/'.$this->getJeu()->getPlateforme()->getId().'/'))
		{
			mkdir($this->getUploadRootDir().'/img/jeux/'.$this->getJeu()->getPlateforme()->getId().'/', 0777, true);
		}
		$caracteres_interdits = array("'", '"', ",", ".", ";", ":", "-", "é", "&", "ù", "à", "@", "è", "ê", "â", "ï", "ö", "ô", "$", "*", "µ", "%", "ç", "~", "§", "!", "?", "/","°");
		$name = str_replace($caracteres_interdits, "", str_replace(" ", "_", strtolower(strip_tags($this->jeu->getName())))).'-'.$this->getId();
		$folder =  'img/jeux/'.$this->getJeu()->getPlateforme()->getId().'/';
		if (null === $this->photoDosBoite) { if(!$this->photoDosBoiteUrl) { $this->photoDosBoiteUrl = 'img/inconnu.png'; } } else {
		$this->photoDosBoite->move($this->getUploadRootDir().$folder, $name.'_dos_boite.png');
		$this->photoDosBoiteUrl = $folder.$name.'_dos_boite.png'; }
		if (null === $this->photoLoose) { if(!$this->photoLooseUrl) {  $this->photoLooseUrl = 'img/inconnu.png'; } } else {
		$this->photoLoose->move($this->getUploadRootDir().$folder, $name.'_loose.png');
		$this->photoLooseUrl = $folder.$name.'_loose.png'; }
		if (null === $this->photoNotice) { if(!$this->photoNoticeUrl) {  $this->photoNoticeUrl = 'img/inconnu.png'; } } else {
		$this->photoNotice->move($this->getUploadRootDir().$folder, $name.'_notice.png');
		$this->photoNoticeUrl = $folder.$name.'_notice.png'; }
		if (null === $this->photoMisc) { if(!$this->photoMiscUrl) {  $this->photoMiscUrl = 'img/inconnu.png'; } } else {
		$this->photoMisc->move($this->getUploadRootDir().$folder, $name.'_misc.png');
		$this->photoMiscUrl = $folder.$name.'_misc.png'; }
		if (null === $this->photoBoite) { if(!$this->photoBoiteUrl) {  $this->photoBoiteUrl = 'img/inconnu.png'; } } else {
		$this->photoBoite->move($this->getUploadRootDir().$folder, $name.'_boite.png');
		$this->photoBoiteUrl = $folder.$name.'_boite.png'; }
	}
	
	public function getValide()			
	{	
		return $this->valide;	
	}
	public function setValide($v)		
	{
		$this->valide = $v;	
	}
	public function getJeu()			
	{	
		return $this->jeu;	
	}
	public function setJeu($j)		
	{
		$this->jeu = $j;	
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
}
