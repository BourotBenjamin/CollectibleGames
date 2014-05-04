<?php

namespace CollectibleGames\CollectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Album
 *
 * @ORM\Table(name="collection_album")
 * @ORM\Entity
 */
class Album
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_album", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description_album", type="string", length=255)
     */
    private $description;
	
    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="album", cascade={"persist", "remove"})
     */
    protected $photos;
	
    /**
     * @ORM\OneToOne(targetEntity="Photo", cascade={"persist", "remove"})
     */
    protected $cover;
	
    /**
     * @ORM\ManyToOne(targetEntity="\CollectibleGames\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    protected $user;

	public function __construct()
	{
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param string $name
     * @return NomJeu
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return NomJeu
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * @return string 
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }
	
	public function getPhotos()			
	{	
		return $this->photos;	
	}
	public function setPhotos($p)		
	{
		$this->photos = $j;	
	}
	public function addPhotos($p)		
	{
		$this->photos[] = $p;	
	}
}
