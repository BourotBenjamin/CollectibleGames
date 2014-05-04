<?php

namespace CollectibleGames\CollectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CollectionAccessoire
 *
 * @ORM\Table(name="collection_possede_accessoire")/
 * @ORM\Entity
 */
class CollectionAccessoire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_possede_accessoire", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
    /**
     * @ORM\ManyToOne(targetEntity="\CollectibleGames\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    protected $user;
	
    /**
     * @ORM\ManyToOne(targetEntity="\CollectibleGames\DatabaseBundle\Entity\Accessoire")
     * @ORM\JoinColumn(name="id_accessoire", referencedColumnName="id_accessoire")
     */
    protected $accessoire;
	
    /**
     * @ORM\ManyToOne(targetEntity="\CollectibleGames\DatabaseBundle\Entity\VersionAccessoire")
     * @ORM\JoinColumn(name="id_version_accessoire", referencedColumnName="id_version_accessoire")
     */
    protected $version;
	
    /**
     *
     * @ORM\Column(name="etat_accessoire", type="integer")
     */
    private $etat;
	
	 /**
     * @ORM\Column(name="boite_accessoire", type="boolean")
     */
	protected $boite;
	
	 /**
     * @ORM\Column(name="notice_accessoire", type="boolean")
     */
	protected $notice;
	
	 /**
     * @ORM\Column(name="materiel_accessoire", type="boolean")
     */
	protected $materiel;
	
	 /**
     * @ORM\Column(name="cale_accessoire", type="boolean")
     */
	protected $cale;
	
	 /**
     * @ORM\Column(name="blister_souple_accessoire", type="boolean")
     */
	protected $blister_souple;
	
	 /**
     * @ORM\Column(name="blister_rigide_accessoire", type="boolean")
     */
	protected $blister_rigide;
	
	 /**
     * @ORM\Column(name="commentaire_accessoire",  type="string", length=255, nullable=true)
     */
	protected $commentaire;

	public function __construct()
	{
        $this->commentaire_accessoire = "";
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

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
	
    public function getUser()
    {
        return $this->user;
    }

    public function setAccessoire($accessoire)
    {
        $this->accessoire = $accessoire;
        return $this;
    }
	
    public function getAccessoire()
    {
        return $this->accessoire;
    }

    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }
	
    public function getVersion()
    {
        return $this->version;
    }

    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
        return $this;
    }
	
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    public function setEtat($etat)
    {
        $this->etat = $etat;
        return $this;
    }
	
    public function getEtat()
    {
        return $this->etat;
    }

    public function setNotice($notice)
    {
        $this->notice = $notice;
        return $this;
    }
	
    public function getNotice()
    {
        return $this->notice;
    }

    public function setBoite($boite)
    {
        $this->boite = $boite;
        return $this;
    }
	
    public function getBoite()
    {
        return $this->boite;
    }

    public function setMateriel($materiel)
    {
        $this->materiel = $materiel;
        return $this;
    }
	
    public function getMateriel()
    {
        return $this->materiel;
    }

    public function setCale($cale)
    {
        $this->cale = $cale;
        return $this;
    }
	
    public function getCale()
    {
        return $this->cale;
    }

    public function setBlisterSouple($blister_souple)
    {
        $this->blister_souple = $blister_souple;
        return $this;
    }
	
    public function getBlisterSouple()
    {
        return $this->blister_souple;
    }

    public function setBlisterRigide($blister_rigide)
    {
        $this->blister_rigide = $blister_rigide;
        return $this;
    }
	
    public function getBlisterRigide()
    {
        return $this->blister_rigide;
    }

}
