<?php

class Album {


  private $id_album; 
  private $titre_album;
  private $description_album;
  private $couverture_album; 
  private $user_id; 

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_album : ". $this->id_album . "
					titre_album : ". $this->titre_album . "
					description_album : ". $this->description_album . "
				   couverture_album ". $this->couverture_album. "
				   user_id ". $this->user_id;
  }

  
  public function getAttr($attr_name) {
    if (property_exists( __CLASS__, $attr_name)) { 
      return $this->$attr_name;
    } 
    $emess = __CLASS__ . ": unknown member $attr_name (getAttr)";
    throw new Exception($emess, 45);
  }
   

  public function setAttr($attr_name, $attr_val) {
    if (property_exists( __CLASS__, $attr_name)) {
      $this->$attr_name=$attr_val; 
      return $this->$attr_name;
    } 
    $emess = __CLASS__ . ": unknown member $attr_name (setAttr)";
    throw new Exception($emess, 45);
    
  }


  public function save() {
    if (!isset($this->id_album)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    if (!isset($this->id_album)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update collection_album_photos set titre_album=".(isset($this->titre_album) ? "'$this->titre_album'" : "").",
	".(isset($this->description_album) ?'description_album="'.$this->description_album.'",':"")."
	".(isset($this->couverture_album) ?'couverture_album="'.$this->couverture_album.'",':"")."
	user_id=".(isset($this->user_id) ? "'$this->user_id'" : "'0'")."
				where id_album=$this->id_album";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }
  
    public static function validate($id) {
    $save_query = "update collection_album_photos set user_id='1' where id_album=$id;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }
  
    public static function remplace($old, $new) {
    $obj = self::findById($old);
	if($obj!=null)
	{
		$img = $obj->getAttr('description_album');
		if($img!='' && $img!='img/inconnu.png')
		{
			unlink($img);
		}
	}
    $save_query = "update bddjv_jeu set id_album=$new where id_album=$old;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	$save_query = "update collection_album_photos set couverture_album=$new where couverture_album=$old;";
    $nb+=$pdo->exec($save_query);
	$save_query ="DELETE FROM collection_album_photos WHERE id_album=$old";
    $pdo->exec($save_query);
	return $nb;
    
  }

  public function delete() {
     $query = "DELETE FROM collection_album_photos WHERE id_album =".$this->id_album;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
	if($this->description_album=="")
	{
		$this->description_album='img/inconnu.png';
	}
  	$query = "INSERT INTO collection_album_photos VALUES (null, '".$this->titre_album."', '".$this->description_album."', '".$this->couverture_album."', '".$this->user_id."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_album' , $db->LastInsertId() );
	return  $db->LastInsertId();
  }
		

    public static function getById($id_album)
	{
		$query = "select * from collection_album_photos NATURAL JOIN phpbb_users where id_album=".$id_album;
		$db = Base::getConnection();
		$album = new Album();
		foreach($db->query($query) as $row)
		{
			$album->setAttr('id_album',$row['id_album']);
			$album->setAttr('titre_album',$row['titre_album']);
			$album->setAttr('description_album',$row['description_album']);
			$album->setAttr('couverture_album',$row['couverture_album']);
			$album->setAttr('user_id',$row['user_id']);
		}
		return $album;  
	}
	
	
    public static function findById($id_album)
	{
		$query = "select * from collection_album_photos NATURAL JOIN phpbb_users where id_album=".$id_album;
		$db = Base::getConnection();
		$album = array();
		foreach($db->query($query) as $row)
		{
			$album['id_album']=$row['id_album'];
			$album['titre_album']=$row['titre_album'];
			$album['description_album']=$row['description_album'];
			$album['couverture_album']=$row['couverture_album'];
			$album['user_id']=$row['user_id'];
			$album['username']=$row['username'];
		}
		$album['photos'] = array();
		$query = "select * from collection_album_photos NATURAL JOIN collection_photos where id_album=".$id_album;
		foreach($db->query($query) as $row)
		{
			$photo=array();
			$photo['id_photo']=$row['id_photo'];
			$photo['nom_photo']=$row['nom_photo'];
			$photo['description_photo']=$row['description_photo'];
			$photo['url_photo']=$row['url_photo'];
			$album['photos'][] = $photo;
		}
		return $album;  
	}
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM collection_album_photos ORDER BY titre_album';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp['id_album']=$row['id_album'];
			$temp['titre_album']=$row['titre_album'];
			$temp['description_album']=$row['description_album'];
			$temp['couverture_album']=$row['couverture_album'];
			$temp['user_id']=$row['user_id'];
			$album['username']=$row['username'];
			$temp['photos'] = array();
			$query = "select * from collection_album_photos NATURAL JOIN collection_photos where id_album=".$row['id_album'];
			foreach($db->query($query) as $row)
			{
				$photo=array();
				$photo['id_photo']=$row['id_photo'];
				$photo['nom_photo']=$row['nom_photo'];
				$photo['description_photo']=$row['description_photo'];
				$photo['url_photo']=$row['url_photo'];
				$temp['photos'][] = $photo;
			}
			$tab[] = $temp;
		}
		return $tab;
    }
	
	public static function findByName($titre_album) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from collection_album_photos where titre_album='".$titre_album."'" ;
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp['id_album']=$row['id_album'];
			$temp['titre_album']=$row['titre_album'];
			$temp['description_album']=$row['description_album'];
			$temp['couverture_album']=$row['couverture_album'];
			$temp['user_id']=$row['user_id'];
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findAllByUser($id) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from collection_album_photos where user_id=".$id ;
	
		foreach($db->query($query) as $row)
		{
			$temp = array();
	  		$temp['id_album']=$row['id_album'];
			$temp['titre_album']=$row['titre_album'];
			$temp['description_album']=$row['description_album'];
			$temp['couverture_album']=$row['couverture_album'];
			$temp['user_id']=$row['user_id'];
			$temp['photos'] = array();
			$query = "select * from collection_album_photos NATURAL JOIN collection_photos where id_album=".$row['id_album'];
			foreach($db->query($query) as $row)
			{
				$photo=array();
				$photo['id_photo']=$row['id_photo'];
				$photo['nom_photo']=$row['nom_photo'];
				$photo['description_photo']=$row['description_photo'];
				$photo['url_photo']=$row['url_photo'];
				$temp['photos'][] = $photo;
			}
			$tab[] = $temp;
		}
		return $tab;
	}
}
?>