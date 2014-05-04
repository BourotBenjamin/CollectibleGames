<?php

namespace CollectibleGames\CollectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CollectionConsole
 *
 * @ORM\Table(name="collection_possede_console")/
 * @ORM\Entity
 */
class CollectionConsole
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_possede_console", type="integer")
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
     * @ORM\ManyToOne(targetEntity="\CollectibleGames\DatabaseBundle\Entity\Console")
     * @ORM\JoinColumn(name="id_console", referencedColumnName="id_console")
     */
    protected $console;
	
    /**
     * @ORM\ManyToOne(targetEntity="\CollectibleGames\DatabaseBundle\Entity\VersionConsole")
     * @ORM\JoinColumn(name="id_version_console", referencedColumnName="id_version_console")
     */
    protected $version;
	
    /**
     *
     * @ORM\Column(name="etat_console", type="integer")
     */
    private $etat;
	
	 /**
     * @ORM\Column(name="boite_console", type="boolean")
     */
	protected $boite;
	
	 /**
     * @ORM\Column(name="notice_console", type="boolean")
     */
	protected $notice;
	
	 /**
     * @ORM\Column(name="machine_console", type="boolean")
     */
	protected $machine;
	
	 /**
     * @ORM\Column(name="cale_console", type="boolean")
     */
	protected $cale;
	
	 /**
     * @ORM\Column(name="console_scelle", type="boolean")
     */
	protected $console_scelle;
	
	 /**
     * @ORM\Column(name="commentaire_console",  type="string", length=255, nullable=true)
     */
	protected $commentaire;

	public function __construct()
	{
        $this->commentaire_console = "";
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

    public function setConsole($console)
    {
        $this->console = $console;
        return $this;
    }
	
    public function getConsole()
    {
        return $this->console;
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

    public function setMachine($machine)
    {
        $this->machine = $machine;
        return $this;
    }
	
    public function getMachine()
    {
        return $this->machine;
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

    public function setConsoleScelle($console_scelle)
    {
        $this->console_scelle = $console_scelle;
        return $this;
    }
	
    public function getConsoleScelle()
    {
        return $this->console_scelle;
    }

}
