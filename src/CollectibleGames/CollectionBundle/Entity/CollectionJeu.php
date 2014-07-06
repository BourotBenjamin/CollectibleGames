<?php

namespace CollectibleGames\CollectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CollectionJeu
 *
 * @ORM\Table(name="collection_possede_jeu")/
 * @ORM\Entity(repositoryClass="CollectibleGames\CollectionBundle\Entity\CollectionJeuRepository")
 */
class CollectionJeu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_possede_jeu", type="integer")
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
     * @ORM\ManyToOne(targetEntity="\CollectibleGames\DatabaseBundle\Entity\Jeu")
     * @ORM\JoinColumn(name="id_jeu", referencedColumnName="id_jeu")
     */
    protected $jeu;
	
    /**
     * @ORM\ManyToOne(targetEntity="\CollectibleGames\DatabaseBundle\Entity\VersionJeu")
     * @ORM\JoinColumn(name="id_version_jeu", referencedColumnName="id_version_jeu")
     */
    protected $version;
	
    /**
     *
     * @ORM\Column(name="etat_jeu", type="integer")
     */
    private $etat;
	
	 /**
     * @ORM\Column(name="boite_jeu", type="boolean")
     */
	protected $boite;
	
	 /**
     * @ORM\Column(name="notice_jeu", type="boolean")
     */
	protected $notice;
	
	 /**
     * @ORM\Column(name="cartouche_jeu", type="boolean")
     */
	protected $cartouche;
	
	 /**
     * @ORM\Column(name="cale_jeu", type="boolean")
     */
	protected $cale;
	
	 /**
     * @ORM\Column(name="blister_souple_jeu", type="boolean")
     */
	protected $blister_souple;
	
	 /**
     * @ORM\Column(name="blister_rigide_jeu", type="boolean")
     */
	protected $blister_rigide;
	
	 /**
     * @ORM\Column(name="commentaire_jeu",  type="string", length=255, nullable=true)
     */
	protected $commentaire;

	public function __construct()
	{
        $this->commentaire_jeu = "";
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

    public function setJeu($jeu)
    {
        $this->jeu = $jeu;
        return $this;
    }
	
    public function getJeu()
    {
        return $this->jeu;
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

    public function setCartouche($cartouche)
    {
        $this->cartouche = $cartouche;
        return $this;
    }
	
    public function getCartouche()
    {
        return $this->cartouche;
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
