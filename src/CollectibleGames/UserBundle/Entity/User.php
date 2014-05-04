<?php
namespace CollectibleGames\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="symfony_user")
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser
{
  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;
  
    /**
     * @ORM\OneToMany(targetEntity="CollectibleGames\CollectionBundle\Entity\CollectionJeu", mappedBy="user", cascade={"persist", "remove"})
     */
    protected $jeux;
    /**
     * @ORM\OneToMany(targetEntity="CollectibleGames\CollectionBundle\Entity\CollectionAccessoire", mappedBy="user", cascade={"persist", "remove"})
     */
    protected $accessoires;
    /**
     * @ORM\OneToMany(targetEntity="CollectibleGames\CollectionBundle\Entity\CollectionConsole", mappedBy="user", cascade={"persist", "remove"})
     */
    protected $consoles;
	
	 /**
     * @ORM\Column(name="avatar_url", type="string", length=255, options={"default"="img/inconnu.png"})
     */
	protected $avatarUrl;
	protected $avatar;
  
	public function __construct()
	{
		parent::__construct();
		$this->avatarUrl = 'img/inconnu.png';
        $this->jeux = new \Doctrine\Common\Collections\ArrayCollection();
        $this->accessoires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->consoles = new \Doctrine\Common\Collections\ArrayCollection();
    }
  
	public function getJeux()			
	{	
		return $this->jeux;	
	}
	public function getJeuxIdList()			
	{	
		$j = array();
		foreach($this->jeux as $jeu)
		{
			$j[] = $jeu->getJeu()->getId();
		}
		return $j;	
	}
	public function setJeux($p)		
	{
		$this->jeux = $j;	
	}
	public function addJeux($p)		
	{
		$this->jeux[] = $p;	
	}
	
	public function getAccessoires()			
	{	
		return $this->accessoires;	
	}
	public function getAccessoiresIdList()			
	{	
		$a = array();
		foreach($this->accessoires as $accessoire)
		{
			$a[] = $accessoire->getAccessoire()->getId();
		}
		return $a;	
	}
	public function setAccessoires($p)		
	{
		$this->accessoires = $j;	
	}
	public function addAccessoires($p)		
	{
		$this->accessoires[] = $p;	
	}
	
	public function getConsoles()			
	{	
		return $this->consoles;	
	}
	public function getConsolesIdList()			
	{	
		$c = array();
		foreach($this->consoles as $console)
		{
			$c[] = $console->getConsole()->getId();
		}
		return $c;	
	}
	public function setConsoles($p)		
	{
		$this->consoles = $j;	
	}
	public function addConsoles($p)		
	{
		$this->consoles[] = $p;	
	}
	
	public function getStats()
	{
		return count($this->jeux)." Jeux, ".count($this->consoles)." Consoles et ".count($this->accessoires)." Accessoires";
	}
	
	
	public function getAvatar()			
	{	
		return $this->avatar;	
	}
	public function setAvatar($a)		
	{
		$this->avatar = $a;	
		$this->updatePhotosUrls();
	}
	
	public function getAvatarUrl()			
	{	
		return $this->avatarUrl;	
	}
	public function setAvatarUrl($a)		
	{
		$this->avatarUrl = $a;	
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
		$name = preg_replace('/[^A-Za-z0-9\-]/', '', $this->username);
		if(!is_dir($this->getUploadRootDir().'img/users/'))
		{
			mkdir($this->getUploadRootDir().'img/users/', 0777, true);
		}
		$folder =  'img/users/';
		if (null === $this->avatar) { if(!$this->avatarUrl) { $this->avatarUrl = 'img/inconnu.png'; } } else {
		$this->avatar->move($this->getUploadRootDir().$folder, $name.'.png');
		$this->avatarUrl = $folder.$name.'.png'; }
	}
}
?>