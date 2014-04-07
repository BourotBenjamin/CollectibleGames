<?php

class photo {


  private $id_photo; 
  private $nom_photo;
  private $description_photo;
  private $url_photo; 
  private $id_album; 

  public function __construct() {}


  public function __toString() {
        return "[". __CLASS__ . "] id_photo : ". $this->id_photo . "
					nom_photo : ". $this->nom_photo . "
					description_photo : ". $this->description_photo . "
				   url_photo ". $this->url_photo. "
				   id_album ". $this->id_album;
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
    if (!isset($this->id_photo)) {
      return $this->insert();
    } else {
      return $this->update();
    }
  }


  public function update() {
    if (!isset($this->id_photo)) {
      throw new Exception(__CLASS__ . ": Primary Key undefined : cannot update");
    } 
    
    $save_query = "update collection_photos set nom_photo=".(isset($this->nom_photo) ? "'$this->nom_photo'" : "").",
	".(isset($this->description_photo) ?'description_photo="'.$this->description_photo.'",':"")."
	".(isset($this->url_photo) ?'url_photo="'.$this->url_photo.'",':"")."
	id_album=".(isset($this->id_album) ? "'$this->id_album'" : "'0'")."
				where id_photo=$this->id_photo";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
    
	return $nb;
    
  }
  
    public static function validate($id) {
    $save_query = "update collection_photos set id_album='1' where id_photo=$id;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	return $nb;
    
  }
  
    public static function remplace($old, $new) {
    $obj = self::findById($old);
	if($obj!=null)
	{
		$img = $obj->getAttr('description_photo');
		if($img!='' && $img!='img/inconnu.png')
		{
			unlink($img);
		}
	}
    $save_query = "update bddjv_jeu set id_photo=$new where id_photo=$old;";
	$pdo = Base::getConnection();
    $nb=$pdo->exec($save_query);
	$save_query = "update collection_photos set url_photo=$new where url_photo=$old;";
    $nb+=$pdo->exec($save_query);
	$save_query ="DELETE FROM collection_photos WHERE id_photo=$old";
    $pdo->exec($save_query);
	return $nb;
    
  }

  public function delete() {
	 unlink('../'.$this->url_photo);
     $query = "DELETE FROM collection_photos WHERE id_photo =".$this->id_photo;
	 $db = Base::getConnection();
	 $db->exec($query);
  }
		
								
  public function insert() {
  	$query = "INSERT INTO collection_photos VALUES (null, '".$this->nom_photo."', '".$this->description_photo."', '".$this->url_photo."', '".$this->id_album."');";
	$db = Base::getConnection();
	$db->query($query);
	$this->setAttr( 'id_photo' , $db->LastInsertId() );
	return  $db->LastInsertId();
  }
		

    public static function findById($id_photo) {
	  
	  $query = "select * from collection_photos where id_photo=".$id_photo;
      $pdo = Base::getConnection();
      $dbres = $pdo->query($query);
      
      $d=$dbres->fetch(PDO::FETCH_OBJ) ;
	  
	  $b = new self();
	  $b->setAttr('id_photo', $id_photo);
	  $b->setAttr('nom_photo', $d->nom_photo);
	  $b->setAttr('description_photo', $d->description_photo);
	  $b->setAttr('url_photo', $d->url_photo);
	  $b->setAttr('id_album', $d->id_album);
	  
	  return $b;
    }
	
    public static function findAll() {
	

    $tab = array();
	$db = Base::getConnection();
	$query = 'SELECT * FROM collection_photos ORDER BY nom_photo';
	
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_photo',$row['id_photo']);
			$temp->setAttr('nom_photo',$row['nom_photo']);
			$temp->setAttr('description_photo',$row['description_photo']);
			$temp->setAttr('url_photo',$row['url_photo']);
			$temp->setAttr('id_album',$row['id_album']);
			$tab[] = $temp;
		}
		return $tab;

    }
	
	public static function findByName($nom_photo) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from collection_photos where nom_photo='".$nom_photo."'" ;
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_photo',$row['id_photo']);
			$temp->setAttr('nom_photo',$row['nom_photo']);
			$temp->setAttr('description_photo',$row['description_photo']);
			$temp->setAttr('url_photo',$row['url_photo']);
			$temp->setAttr('id_album',$row['id_album']);
			$tab[] = $temp;
		}
		return $tab;
	}
	
	public static function findByUser($id) {
		
	 $tab = array();
	 $db = Base::getConnection();
	 $query = "select * from collection_photos where id_album=".$id ;
	
		foreach($db->query($query) as $row)
		{
			$temp = new self();
	  		$temp->setAttr('id_photo',$row['id_photo']);
			$temp->setAttr('nom_photo',$row['nom_photo']);
			$temp->setAttr('description_photo',$row['description_photo']);
			$temp->setAttr('url_photo',$row['url_photo']);
			$temp->setAttr('id_album',$row['id_album']);
			$tab[] = $temp;
		}
		return $tab;
	}
}
?>