<?php

namespace CollectibleGames\CollectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Photo
 *
 * @ORM\Table(name="collection_photo")
 * @ORM\Entity
 */
class Photo
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
     * @ORM\Column(name="nom_photo", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description_photo", type="string", length=255)
     */
    private $description;
	
	 /**
     * @ORM\Column(name="photo_url", type="string", length=255)
     */
	protected $photoUrl;
	protected $photo;
	
    /**
     * @ORM\ManyToOne(targetEntity="Album")
     * @ORM\JoinColumn(name="id_album", referencedColumnName="id")
     */
    protected $album;
	
	protected $cover;

	public function __construct()
	{
		$this->photoUrl = 'img/inconnu.png';
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

    public function setCover($cover)
    {
        $this->cover = $cover;
        return $this;
    }

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
     * @param string $album
     */
    public function setAlbum($album)
    {
        $this->album = $album;
        return $this;
    }

    /**
     * @return string 
     */
    public function getAlbum()
    {
        return $this->album;
    }
	
	public function getPhoto()			
	{	
		return $this->photo;	
	}
	public function setPhoto($p)		
	{
		$this->photo = $p;	
	}
	
	public function getPhotoUrl()			
	{	
		return $this->photoUrl;	
	}
	public function setPhotoUrl($p)		
	{
		$this->photoUrl = $p;	
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
	
	public function updatePhotosUrls()		
	{
		if(!is_dir($this->getUploadRootDir().'img/collection/'.$this->getAlbum()->getId().'/'))
		{
			mkdir($this->getUploadRootDir().'img/collection/'.$this->getAlbum()->getId().'/', 0777, true);
		}
		$i=0;
		while(is_file($this->getUploadRootDir().'img/collection/'.$this->getAlbum()->getId().'/'.$i.'.png'))
		{
			$i++;
		}
		$folder =  'img/collection/'.$this->getAlbum()->getId().'/';
		if (null === $this->photo) { if(!$this->photo) { $this->photoUrl = 'img/inconnu.png'; } } else {
		$this->photo->move($this->getUploadRootDir().$folder, $i.'.png');
		$this->photoUrl = $folder.$i.'.png'; }
	}
}
